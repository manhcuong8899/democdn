<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Flash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use VNPCMS\Mailers\UserMailer as Mailer;


class UsersController extends Controller
{

    protected $mailer;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->middleware('auth');
    }

    /**
     * Show all users in /users
     *
     * @return View;
     **/
    public function all()
    {
        if (!hasPermission('user_management', true))
            return redirect('admin');

        $users = User::where('type','admin')->get();

        if (request()->wantsJson()) {
            return $users;
        }

        return view('settings.users.all')->with('users', $users);
    }

    /**
     * Show all users in /users
     *
     * @return View;
     **/
    public function showUpdateUserForm($username)
    {
        // see if user has permission to update user
        if (!(Auth::user()->username == $username || hasPermission('user_update', true)))
            return redirect('/');

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info(trans('VNPCMS.messages.models.notfound', ['modelname' => trans('VNPCMS.models.user')]));

            return redirect('/');
        }

        if ($user->hasProfile()) {
            return redirect($user->profilePath());
        }

        return view('settings.users.edit')->with(compact('user'));
    }

    /**
     * Get data for one user as json
     *
     * @param $username string
     *
     * @return App\Models\User;
     **/
    public function getUser($username)
    {
        // see if user has permission to view another user
        if (!(hasPermission('user_management', true) || Auth::user()->username == $username))
            return redirect('/');

        if (!request()->wantsJson()) {
            return redirect('/');
        }

        return User::whereUsername($username)->first();
    }

    /**
     * Create user
     *
     * @param $request App\Http\Requests\CreateUserRequest
     * @param string
     *
     * @return Void;
     **/
    public function create(CreateUserRequest $request)
    {
        $user = User::create([
            'full_name' => $request->input('full_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $user->verified = 1;
        $user->type = 'admin';
        $user->locale ='vn';
        $user->email_token = null;
        $user->save();

        $user->assignRole(crminfo('new_user_role'));

        if ($request->wantsJson()) {
            return $user;
        }

        Flash::success(trans('VNPCMS.messages.models.update.success', ['modelname' => trans('VNPCMS.models.user')]));

        return back();
    }

    /**
     * Update user data
     *
     * @param $request App\Http\Requests\UpdateUserRequest
     * @param $username string
     *
     * @return Void;
     **/
    public function update(UpdateUserRequest $request)
    {
        $user = User::whereUsername($request->username)->first();
        if (is_null($user)) {
            Flash::info(trans('VNPCMS.messages.models.notfound', ['modelname' => trans('VNPCMS.models.user')]));
            return redirect('/');
        }
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->user_handle_id = $request->input('user_handle_id');
        $user->save();

        Flash::success(trans('VNPCMS.messages.models.update.success', ['modelname' => trans('VNPCMS.models.user')]));

        return back();
    }

    /**
     * Verify user
     *
     * @param $username string
     *
     * @return Void;
     **/
    public function verify($email)
    {
        if (!hasPermission('user_management', true))
            return redirect('/');

        $user = User::where('email',$email)->first();

        if (is_null($user)) {
            Flash::info(trans('VNPCMS.messages.models.notfound', ['modelname' => trans('VNPCMS.models.user')]));

            return redirect('/');
        }

        $user->verified = 1;
        $user->email_token = null;
        $user->save();

        Flash::success(trans('VNPCMS.messages.models.update.success', ['modelname' => trans('VNPCMS.models.user')]));

        return back();
    }

    /**
     * Delete user
     *
     * @param string
     *
     * @return Void;
     **/
    public function delete($username)
    {
        // see if authenticated user has permission to delete users
        if (!hasPermission('user_management', true))
            return redirect('/');

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info(trans('VNPCMS.messages.models.notfound', ['modelname' => trans('VNPCMS.models.user')]));

            return back();
        }

        if ($username == crminfo('admin_username')) {
            Flash::error(trans('VNPCMS.messages.notallowed'));

            return back();
        }

        $user->delete();

        Flash::success(trans('VNPCMS.messages.models.delete.success', ['modelname' => trans('VNPCMS.models.user')]));

        return back();
    }

    /**
     * Change password for user
     *
     * @param $request App\Http\Requests\UpdateUserPasswordRequest
     * @param $username string
     *
     * @return Void;
     **/
    public function changePassword(UpdateUserPasswordRequest $request, $username)
    {
        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info(trans('VNPCMS.messages.models.notfound', ['modelname' => trans('VNPCMS.models.user')]));

            return redirect('/');
        }

        $user->password = $this->encryptPassword($request->input('password'));

        $user->save();

        Flash::success(trans('VNPCMS.messages.models.update.success', ['modelname' => trans('VNPCMS.models.user')]));

        return back();
    }

    /**
     * Encrypt password
     *
     * @param string
     *
     * @return string;
     **/
    public function encryptPassword($password)
    {
        return bcrypt($password);
    }
}
