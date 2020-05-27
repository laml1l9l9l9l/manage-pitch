<?php

namespace App\Model\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'customers';

    protected $fillable = [
    	'name', 'email', 'password', 'phone', 'status'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function buildPassLender($password = ''){
        return (trim($password) != '')? md5($password.'_'.env('KEY_PASS_ADMIN')): '';
    }
}
