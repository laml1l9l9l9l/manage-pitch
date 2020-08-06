<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use App\Model\Admin\Roles;
use App\Model\Admin\AdminRoles;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(Admin $admin, Roles $roles, AdminRoles $admin_roles)
    {
        $this->admin = $admin;
        $this->roles = $roles;
        $this->admin_roles = $admin_roles;
    }

    public function index()
    {
        $model_admin       = $this->admin;
        $model_roles       = $this->roles;
        $model_admin_roles = $this->admin_roles;

        $show_add_role = false;
        $account = $this->guardAdmin()->user();
        $array_role_admin = $model_admin_roles->arrayRoleAdmin($account->id);
        $account->array_role_admin = $array_role_admin; // add role admin to admin information

        $show_add_role = $this->showAddRole($array_role_admin);
    	return view('User.Admin.Profile.index', [
            'account'       => $account,
            'model_roles'   => $model_roles,
            'show_add_role' => $show_add_role
        ]);
    }

    public function update(Request $request)
    {
        $this->validateUpdateProfile($request);
        $profile = $request['profile'];
        $account = $this->guardAdmin()->user();

        $model_admin = $this->admin;
        $model_roles = $this->roles;
        $model_admin_roles = $this->admin_roles;

        $admin       = $model_admin->find($account->id);
        $admin->name = $profile['name'];
        $admin->save();
        
        if(!empty($profile['id_role'])){
            $role       = $model_roles->find($profile['id_role']);
            $admin_role = $model_admin_roles->where('id_admin', $account->id)
                ->where('id_role', $profile['id_role'])
                ->first();
            if($role && !$admin_role){
                $model_admin_roles->id_admin = $account->id;
                $model_admin_roles->id_role = $profile['id_role'];
                $model_admin_roles->created_at = Helper::getCurrentDateTime();
                $model_admin_roles->updated_at = Helper::getCurrentDateTime();
                $model_admin_roles->save();
            }
        }
        
        return redirect()->route('admin.profile')
            ->with('success', 'Cập nhật thông tin các nhân thành công');
    }

    public function logout(Request $request)
    {
        $this->guardAdmin()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    	return redirect()->route('admin.login');
    }

    protected function showAddRole(array $array_role)
    {
        if(count($array_role) > 0){
            foreach ($array_role as $id_role => $name_role) {
                if(strval($id_role) == ROLE_SUPER_ADMIN)
                    return true;
            }
        }

        return false;
    }

    protected function guardAdmin()
    {
        return Auth::guard('admin');
    }

    private function validateUpdateProfile(Request $request)
    {
        $request->validate([
            'profile.name' => 'required|min:3|max:100'
        ], $this->messages());
    }

    private function messages()
    {
        return [
            'required' => 'Không được để trống',
            'string'   => 'Sai định dạng',
            'profile.name.max' => 'Họ tên dài hơn :max ký tự',
            'profile.name.min' => 'Họ tên ngắn hơn :min ký tự',
        ];
    }
}
