<?php

namespace App\Model\Admin;

use App\Model\Admin\Admin;
use App\Model\Admin\Permissions;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    public function users()
    {
    	return $this->belongsToMany(Admin::class,'admin_roles');
    }

    public function permissions()
    {
    	return $this->belongsToMany(Permissions::class,'role_permission');
    }
}
