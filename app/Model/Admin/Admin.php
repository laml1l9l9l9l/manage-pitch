<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    public function buildPassLender($password = ''){
        return (trim($password) != '')? md5($password.'_'.env('KEY_PASS_ADMIN')): '';
    }
}
