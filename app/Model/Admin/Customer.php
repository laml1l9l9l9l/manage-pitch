<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public $status_model = array(
		ACTIVE => 'Kích hoạt',
		LOCK   => 'Khóa'
    );
}
