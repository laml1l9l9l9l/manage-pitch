<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'time_slots';

    public $status_model = array(
    	LOCK => 'Khóa',
    	ACTIVE => 'Hoạt động'
    );

    public $time_special_model = array(
		MANUALLY       => 'Bình thường',
		INCREASE_PRICE => 'Tăng giá'
    );
}
