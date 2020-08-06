<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
    protected $table = 'admin_roles';

    public function arrayRoleAdmin($id_admin)
    {
    	$array_role_admin = array();
    	$roles_admin = AdminRoles::where('admin_roles.id_admin', $id_admin)
            ->join('roles', 'roles.id', 'admin_roles.id_role')
            ->select('admin_roles.*', 'roles.name')
            ->get();
    	foreach ($roles_admin as $role) {
    		$array_role_admin[$role->id_role] = $role->name;
    	}

    	return $array_role_admin;
    }
}
