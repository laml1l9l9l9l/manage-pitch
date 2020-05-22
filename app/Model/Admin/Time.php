<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'time_slots';

    public $status_model = array(
		ACTIVE => 'Hoạt động',
		LOCK   => 'Khóa'
    );

    public $time_special_model = array(
		MANUALLY       => 'Bình thường',
		INCREASE_PRICE => 'Tăng giá'
    );
}
