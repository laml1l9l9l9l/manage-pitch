<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\AdminRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RemoveAdminController extends Controller
{
    public function __construct(AdminRoles $admin_roles)
    {
        $this->admin_roles = $admin_roles;
    }

	public function index(Request $request)
	{
		try {
			$model_admin_roles = $this->admin_roles;
        	$admin_request = $request->admin;
			$delete  = $model_admin_roles->where('id_admin', $admin_request['id'])
				->where('id_role', $admin_request['id_role'])
				->delete();

			return redirect()->route('admin.admin.edit', ['id' => $admin_request['id']])
				->with('success', 'Xóa quyền thành công');
		} catch(\Exception $err) {
			return redirect()->route('admin.admin.edit', ['id' => $admin_request['id']])
				->with('error', 'Xảy ra lỗi, vui lòng thử lại');
		}
	}
}