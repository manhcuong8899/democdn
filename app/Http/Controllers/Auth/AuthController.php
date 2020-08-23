<?php

namespace App\Http\Controllers\Auth;

use Flash;
use Validator;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use VNPCMS\Mailers\UserMailer as Mailer;
use Socialite;
use \Carbon\Carbon;
use App\Models\Profile;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller {

    public function authenticate() {

        // Get credentials from the request
        $credentials = Input::only('email', 'password');

        try {
			$email = Input::get('email');
            // Attempt to verify the credentials and create a token for the user.
            if (!$token = JWTAuth::attempt($credentials)) {
				return response()->json(['status' => 'ko', 'message' => 'Invalid credentials']);
            }
			$user = User::query()->where('email', '=', $email)->first();
			// Return success.
			return compact('token','user');
        } catch (JWTException $e) {
            // Something went wrong - let the app know.
			return response()->json(['status' => 'ko', 'message' => 'Could not create token']);
        }

    }
	

    public function validateToken() {
        return API::response()->array(['status' => 'success'])->statusCode(200);
    }

    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

    protected $mailer;

    use AuthenticatesAndRegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'cms';

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * Overwrited original method: Return user's profile path
     * or '/' if user has no profile
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath() {
        if (Auth::check()) {
            return Auth::user()->profilePath();
        }

        return 'login';
    }

    /**
     * Create a new authentication controller instance.
     */
    public function __construct(Mailer $mailer, Guard $auth) {
        $this->auth = $auth;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->mailer = $mailer;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'full_name' => 'required|max:255',
                    'username' => 'required|max:255|username|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'full_name' => $data['full_name'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Overwritten method: Added handling app locale via session (based on user settings)
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request) {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            $user = User::find(Auth::user()->id);
            $user->setLastLogin();

            if (!empty($user->locale)) {
                Session::put('locale', $user->locale);
            }
            session_start();
            $_SESSION['authentication'] = $user->type;

            Flash::success(trans('VNPCMS.messages.welcome', ['applicationname' => crminfo('name')]), true);

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.

        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Overwritten: check if login field is username or email
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function validateLogin(Request $request) {
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input('login')]);

        $this->validate($request, [
            $this->loginUsername($request) => 'required',
            'password' => 'required',
        ]);
    }

    /**
     * Overwritten: check if username or email sent in "login" input
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername(Request $request) {
        // return property_exists($this, 'username') ? $this->username : 'email';
        return $request->has('username') ? 'username' : 'email';
    }

    /**
     * Overwritten: Changed loginUsername() to 'login'
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request) {
        Flash::warning(trans('auth.failed'));

        return redirect()->back()->withInput($request->only('login', 'remember'))->withErrors([
                    'login' => $this->getFailedLoginMessage(),
                    'password' => $this->getFailedLoginMessage(),
        ]);
    }

    /**
     * Overwritten method: Added verified value
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function getCredentials(Request $request) {
        // return $request->only($this->loginUsername(), 'password');
        return [
            $this->loginUsername($request) => $request->only($this->loginUsername($request)),
            'password' => $request->input('password'),
            'verified' => true,
        ];
    }

    /**
     * In case we want to flush session after logout
     * Overwritten method: Added Session::flush();
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout() {
        Auth::guard($this->getGuard())->logout();

        Session::flush();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    /*
     * Overwriting original method
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request) {
        if (crminfo('enable_registration') == 0) {
            return redirect('/');
        }

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $user = $this->create($request->all());

        $data['confirmation_link'] = url('login/confirm/' . $user->email_token);
        $this->mailer->mail($user, 'confirmation', $data);

        Flash::info(trans('VNPCMS.messages.confirmemail'));

        return back();
    }

    /*
     * Overwriting original method
     * Disable or enable registration globally
     */

    public function showRegistrationForm() {
        if (crminfo('enable_registration') == 0) {
            return redirect('/');
        }

        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        return view('auth.register');
    }

    /*
     * Verify user account.
     *
     * @param  Email token $email_token
     * @return void
     */

    public function confirmEmail($email_token) {
        $user = User::where('email_token', $email_token)->first();

        if (is_null($user)) {
            Flash::warning(trans('VNPCMS.messages.tokennotfound'));

            return redirect('login');
        }

        $user->confirmEmail();
        $user->assignRole(crminfo('new_user_role'));

        Flash::success(trans('VNPCMS.messages.accountverified'));

        return redirect('login');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($social) {
        return \Socialite::driver($social)->redirect();
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function ajaxRedirectToProvider($social) {
        return \Socialite::driver($social)->with(['state' => 'ajax'])->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($social) {
        $user = $this->createOrGetUser($social, \Socialite::driver($social)->stateless()->user());
        
        $state = request()->input('state');
        if($state == 'ajax'){
//            dd($user);
            $token = JWTAuth::fromUser($user);
            return compact('token','user');
        }
        
        $this->auth->login($user);
        return redirect()->to('/');
    }

    public function createOrGetUser($social, \Laravel\Socialite\Two\User $providerUser) {
        $account = \App\Models\SocialAccount::query()
                ->where('provider', '=', $social)
                ->where('provider_user_id', '=', $providerUser->getId())
                ->first();


        if ($account) {
            return $account->user;
        } else {

            $account = new \App\Models\SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);

            $user = \App\Models\User::query()->where('email', '=', $providerUser->getEmail())->first();
            if (!$user) {
                $user = \App\Models\User::create([
                            'email' => $providerUser->getEmail(),
                            'username' => $providerUser->getEmail(),
                            'name' => $providerUser->getName(),
                            'type' => 'customer',
                            'locale' => 'vn',
                            'verified' => '1',
                            'full_name' => $providerUser->getName(),
                ]);
                $roleUser = \App\Models\Role::where('name', '=','customer')->first();
                $user->roles()->attach($roleUser->id); 
                $profile = array('facebook_username' => $providerUser->getName(),
                    'user_id' => $user->id);
                Profile::create($profile);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

}
