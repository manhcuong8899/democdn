<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Auth;
use Flash;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use VNPCMS\Catearticle\CateArticles;

class ProfilesController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all profiles in /members
     *
     * @return View;
     **/
    public function all()
    {
        Flash::info('Page not created yet');

        return redirect('/');
    }

    /**
     * Show a members profile
     *
     * @param $username
     *
     * @return View
     */
    public function show($email)
    {
        $user = User::where('email',$email)->first();

        if ( is_null($user) || ! $user->hasProfile() ) {
            Flash::info(trans('VNPCMS.messages.models.notfound',
                ['modelname' => trans('VNPCMS.models.profile') . '/' . trans('VNPCMS.models.user')])
            );

            return redirect('/');
        }

        $user->load('profile.user');
        /* Danh mục ngân hàng */
        $cates = CateArticles::where('group','banks')->get();

        $cities = Province::orderBy('name','asc')->get();

		$bussinessmanrole = \App\Models\Role::where('name','=','bussinessman')->first();
		$users  = \App\Models\User::whereIn('id', function($query) use ($bussinessmanrole) {
			$query->select('user_id')->from('role_user')->where('role_id','=',$bussinessmanrole->id);
		});
        $handles = $users->lists('username', 'id')->toArray();
        return view('profiles.show', compact('user','cates','cities','handles'));
    }


    public function update(UpdateProfileRequest $request, $username)
    {
        $user = User::with('profile')->whereUsername($username)->first();
        if (is_null($user) || !$user->hasProfile()) {
            Flash::info(trans('VNPCMS.messages.models.notfound',
                ['modelname' => trans('VNPCMS.models.profile') . '/' . trans('VNPCMS.models.user')])
            );

            return redirect('order/online');
        }

        $user->profile->update($request->all());

        Flash::success(trans('VNPCMS.messages.models.update.success',
            ['modelname' => trans('VNPCMS.models.profile')])
        );

        return back();
    }

    /**
     * Delete user profile
     *
     * @param string $username
     *
     * @return Void;
     **/
    public function delete($username)
    {
        if ( ! hasPermission('user_management', true) )
            return redirect('/');

        $user = User::with('profile')->whereUsername($username)->first();

        if ( is_null($user) || ! $user->hasProfile() ) {
            Flash::info(trans('VNPCMS.messages.models.notfound',
                ['modelname' => trans('VNPCMS.models.profile') . '/' . trans('VNPCMS.models.user')])
            );

            return redirect('/');
        }

        $user->profile->delete();

        Flash::success(trans('VNPCMS.messages.models.delete.success',
            ['modelname' => trans('VNPCMS.models.profile')])
        );

        return back();
    }

    /**
     * Show create profile form for a user
     *
     * @param string $username
     *
     * @return View;
     **/
    public function showCreateForm($username)
    {
        $user = User::whereUsername($username)->first();

        if ( is_null($user) ) {
            Flash::info(trans('VNPCMS.messages.models.notfound',
                ['modelname' => trans('VNPCMS.models.user')])
            );

            return redirect('/');
        }

        // check if user has permission to create profile, or if a member, create his/her own profile
        if (!(hasPermission('user_management') || (Auth::user()->hasRole('customer') && Auth::user()->username == $username)) ) {
            Flash::warning(trans('VNPCMS.messages.nopermission'));

            return redirect('/');
        }

        // if already has profile, redirect to it
        if ( $user->hasProfile() ) {
            return redirect($user->profilePath());
        }

        return view('profiles.create', compact('user'));
    }

    public function create(CreateProfileRequest $request, $username)
    {
        $user = User::whereUsername($username)->first();

        if ( is_null($user) ) {
            Flash::info(trans('VNPCMS.messages.models.notfound',
                ['modelname' => trans('VNPCMS.models.user')])
            );

            return redirect('/');
        }

        if ( $user->hasProfile() ) {
            return redirect($user->profilePath());
        }

        $profile = new Profile($request->all());
        $profile->user_id = $user->id;

        $user->profile()->save($profile);

        Flash::success(trans('VNPCMS.messages.models.create.success',
            ['modelname' => trans('VNPCMS.models.profile')])
        );

        return redirect($user->fresh()->profilePath());

    }
}
