<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Model\Admin\AdminRoles;
use Illuminate\Support\Facades\Auth;

class RemoveRoleController extends Controller
{
    public function __construct(AdminRoles $admin_roles)
    {
        $this->admin_roles = $admin_roles;
    }

	public function index($id)
	{
		$model_admin_roles = $this->admin_roles;
		$account = $this->guardAdmin()->user();
		$delete  = $model_admin_roles->where('id_admin', $account->id)
			->where('id_role', $id)
			->delete();

		return redirect()->route('admin.profile')
			->with('success', 'Xóa quyền thành công');
	}

    protected function guardAdmin()
    {
        return Auth::guard('admin');
    }
}