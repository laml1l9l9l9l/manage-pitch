<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class SpecialDateTime extends Model
{
    protected $table = 'special_datetime';

    public $status_model = array(
		ACTIVE => 'Hoạt động',
		LOCK   => 'Nghỉ'
    );
}
