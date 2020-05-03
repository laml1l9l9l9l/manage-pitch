<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    protected $fillable = ['email', 'password'];

    public function buildPassLender($password = ''){
        return (trim($password) != '')? md5($password.'_'.env('KEY_PASS_ADMIN')): '';
    }
}
