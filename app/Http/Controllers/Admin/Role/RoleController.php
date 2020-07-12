<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Model\Admin\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class RoleController extends Controller
{
    public function __construct(Roles $role)
    {
		$this->role = $role;
    }

    public function index(Request $request)
    {
		$model_role = $this->role;

		$offset     = 5;
		$start_page = 1;
		$page       = $request->get('page');
		$page_role  = $this->indexTable($page, $offset);

        $roles = $model_role->paginate($offset);
        $roles->setPath(URL::current());

    	return view('User.Admin.Role.index', [
			'roles'      => $roles,
			'page_role'  => $page_role
        ]);
    }
}
