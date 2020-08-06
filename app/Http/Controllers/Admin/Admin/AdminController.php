<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use App\Model\Admin\Roles;
use App\Model\Admin\AdminRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

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
        $date_request = $request->date;

        return view('User.Admin.Admin.edit', [
            'admin'       => $admin,
            'model_admin' => $model_admin,
        ]);
    }

    private $array_validate = [
        'name'       => ['required', 'string', 'min:2', 'max:25'],
        'date_start' => ['required', 'date_format:Y-m-d', 'after:today'],
        'date_end'   => ['required', 'date_format:Y-m-d', 'after_or_equal:date_start'],
    ];

    private function validatorManually(array $data)
    {
        return Validator::make($data, $this->array_validate, $this->messages());
    }

    private function messages()
    {
        return [
            'required'                => 'Không được để trống',
            'string'                  => 'Sai định dạng',
            'max'                     => 'Sai định dạng, dài hơn :max ký tự',
            'min'                     => 'Sai định dạng, ngắn hơn :min ký tự',
            'status.max'              => 'Sai định dạng',
            'status.min'              => 'Sai định dạng',
            'date_format'             => 'Sai định dạng',
            'date_start.after'        => 'Ngày bắt đầu phải lớn hơn ngày hiện tại',
            'date_end.after_or_equal' => 'Ngày không hợp lệ',
            'date_special.max'        => 'Sai định dạng',
            'date_special.min'        => 'Sai định dạng',
        ];
    }
}
