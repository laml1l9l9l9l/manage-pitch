<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Model\Admin\Permissions;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PermissionController extends Controller
{
    public function __construct(Permissions $permissions)
    {
		$this->permission = $permissions;
    }

    public function index(Request $request)
    {
		$model_permission = $this->permission;

		$offset          = 5;
		$start_page      = 1;
		$page            = $request->get('page');
		$page_permission = $this->indexTable($page, $offset);

        $permission = $model_permission->paginate($offset);
        $permission->setPath(URL::current());

    	return view('User.Admin.Permission.index', [
			'permissions'      => $permission,
			'page_permission'  => $page_permission
        ]);
    }
}
