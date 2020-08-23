<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Flash;
use Validator;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role_management');
    }

    /**
     * Show all roles in /roles
     *
     * @return View;
     **/
    public function show()
    {
    	$roles = Role::all();

    	return view('settings.users.roles', compact('roles'));
    }

    /**
     * Get data for one role as json
     *
     * @param string
     *
     * @return App\Models\Role;
     **/
    public function getRole($roleId)
    {
        // see if user has permission to view another user
        if (!hasPermission('role_management', true)) return redirect('/');

        return Role::find($roleId);
    }

    /**
     * Create a role
     *
     * @param App\Http\Requests\CreateRoleRequest
     *
     * @return Void;
     **/
    public function create(CreateRoleRequest $request)
    {
        Role::create($request->all());

        Flash::success(trans('Tạo mới thành công nhóm quyền', ['modelname' => trans('VNPCMS.models.role')]));

        return back();
    }

    /**
     * Update a role
     *
     * @param App\Http\Requests\UpdateRoleRequest
     * @param integer
     *
     * @return Void;
     **/
    public function update(UpdateRoleRequest $request, $roleId)
    {
        $role = Role::find($roleId);

        if (is_null($role)) {
            Flash::info(trans('Không tìm thấy dữ liệu', ['modelname' => trans('VNPCMS.models.role')]));
            return redirect('/');
        }

        $role->setTranslation('label', getCurrentSessionAppLocale(), $request->input('label'));
        $role->save();

        Flash::success(trans('Cập nhật thông tin thành công', ['modelname' => trans('VNPCMS.models.role')]));
        return back();
    }

    /**
     * Delete a role
     *
     * @param integer
     *
     * @return Void;
     **/
    public function delete($roleId)
    {
        if (!hasPermission('role_management')) return redirect('/');

        $role = Role::find($roleId);

        if (is_null($role)) {
            Flash::warning(trans('Không tìm thấy dữ liệu nhóm quyền', ['modelname' => trans('VNPCMS.models.role')]));
            return back();
        }

        if ($role->name == 'administrator') {
            Flash::warning(trans('Không thể xóa nhóm quyền này!'));
            return back();
        }

        $role->delete();

        Flash::success(trans('Xóa thành công nhóm quyền', ['modelname' => trans('VNPCMS.models.role')]));

        return back();

    }

    /**
     * Get user roles as json
     *
     * @param string
     * @return array;
     **/
    public function getUserRoles(Request $request, $username)
    {

        if (!$request->wantsJson()) {
            return redirect('/');
        }

        $user = User::whereUsername($username)->first();

        if (is_null($user)) {
            Flash::info(trans('VNPCMS.messages.models.notfound', ['modelname' => trans('VNPCMS.models.user')]));
            return back();
        }

        return $user->getRoles();
    }

    /**
     * Update Roles for a given user
     *
     * @param App\Http\Requests\Request
     * @param string
     *
     * @return Void;
     **/
    public function updateUserRoles(Request $request, $username)
    {
        if (!hasPermission('role_management', true)) return redirect('/');

        $user = User::whereUsername($username)->first();

        $role = $request->roles;
        $user->type='admin';
        if($role=='customer'){
            $user->type='customer';
        }
        $user->save();
        // Check if user exists
        if (is_null($user)) {
            Flash::info(trans('VNPCMS.messages.models.notfound', ['modelname' => trans('VNPCMS.models.user')]));
            return back();
        }

        // Check if trying to change CRM Administrator's roles
        if ($user->username == crminfo('admin_username')){
            Flash::info(trans('VNPCMS.messages.notallowed'));
            return back();
        }

        // Validate request
        $validator = Validator::make($request->all(), [
            'roles' => 'exists:roles,name',
        ]);

        if ($validator->fails()) {
            Flash::error('Roles could not be assigned to user: '.$username.'. Wrong input data sent.');
            return back();
        }

        $roles = $request->input('roles');

        // If no roles sent in request, revoke all roles
        if (is_null($roles)) {
            $user->revokeAllRoles();

        // else, sync roles with the new ones
        } else {
            $user->revokeAllRoles();
            $roleId = Role::where('name',$role)->first()->id;
            $roles = array();
            $roles[$roleId]=$request->roles;
            $user->syncRoles(array_keys($roles));
        }

        Flash::success(trans('VNPCMS.messages.models.update.success', ['modelname' => trans('VNPCMS.models.roles')]));

        return back();
        
    }
}
