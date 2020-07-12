<?php

namespace App\Model\Admin;

use App\Model\Admin\Roles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'admins';

    protected $fillable = [
    	'name', 'email', 'password'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_roles');
    }

    public function buildPassAdmin($password = ''){
        return (trim($password) != '')? md5($password.'_'.env('KEY_PASS_ADMIN')): '';
    }
}
