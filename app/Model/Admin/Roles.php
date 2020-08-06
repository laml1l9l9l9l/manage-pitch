<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    public function arrayRole()
    {
    	$array_role = array();
    	$roles = Roles::all();
    	foreach ($roles as $role) {
    		$array_role[$role->id] = $role->name;
    	}

    	return $array_role;
    }
}
