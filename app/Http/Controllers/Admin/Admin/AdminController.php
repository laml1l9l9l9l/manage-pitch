<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use App\Model\Admin\Roles;
use App\Model\Admin\AdminRoles;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;

class AdminController extends Controller
{
    public function __construct(Admin $admin, Roles $roles, AdminRoles $admin_roles)
    {
		$this->admin = $admin;
        $this->roles = $roles;
        $this->admin_roles = $admin_roles;
    }

    public function index(Request $request)
    {
		$model_admin = $this->admin;

        $offset     = 5;
        $start_page = 1;
        $page       = $request->get('page');
        $page_admin = $this->indexTable($page, $offset);

        $admins = $model_admin->paginate($offset);
        $admins->setPath(URL::current());

    	return view('User.Admin.Admin.index', [
            'admins'     => $admins,
            'page_admin' => $page_admin
        ]);
    }

    public function edit($id)
    {
        $model_admin       = $this->admin;
        $model_roles       = $this->roles;
        $model_admin_roles = $this->admin_roles;

        $admin = $model_admin->find($id);
        $array_role_admin = $model_admin_roles->arrayRoleAdmin($admin->id);
        $admin->array_role_admin = $array_role_admin; // add role admin to admin information

        return view('User.Admin.Admin.edit', [
            'admin'             => $admin,
            'model_admin'       => $model_admin,
            'model_roles'       => $model_roles
        ]);
    }

    public function update($id, Request $request)
    {
        $model_admin = $this->admin;
        $model_roles = $this->roles;
        $model_admin_roles = $this->admin_roles;
        $admin_request = $request->admin;

        $this->validatorManually($admin_request)->validate();

        $admin       = $model_admin->find($id);
        $admin->name = $admin_request['name'];
        if(!empty($admin_request['password'])) {
            $new_password = $model_admin->buildPassAdmin($admin_request['password']);
            $admin->password = $new_password;
        }
        $admin->save();
        
        if(!empty($admin_request['id_role'])){
            $role       = $model_roles->find($admin_request['id_role']);
            $admin_role = $model_admin_roles->where('id_admin', $id)
                ->where('id_role', $admin_request['id_role'])
                ->first();
            if($role && !$admin_role){
                $model_admin_roles->id_admin   = $id;
                $model_admin_roles->id_role    = $admin_request['id_role'];
                $model_admin_roles->created_at = Helper::getCurrentDateTime();
                $model_admin_roles->updated_at = Helper::getCurrentDateTime();
                $model_admin_roles->save();
            }
        }

        return redirect()->route('admin.admin.edit', ['id' => $id])
            ->with('success', 'Chỉnh sửa thành công');
    }

    private $array_validate = [
        'name' => 'required|string|min:3|max:100',
        'password' => 'nullable|string|min:5|max:100'
    ];

    private function validatorManually(array $data)
    {
        return Validator::make($data, $this->array_validate, $this->messages());
    }

    private function messages()
    {
        return [
            'required' => 'Không được để trống',
            'string'   => 'Sai định dạng',
            'max'      => 'Sai định dạng, dài hơn :max ký tự',
            'min'      => 'Sai định dạng, ngắn hơn :min ký tự',
        ];
    }
}
