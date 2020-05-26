<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $table = 'dates';

    public $status_model = array(
		ACTIVE => 'Hoạt động',
		LOCK   => 'Khóa'
    );

    public $date_special_model = array(
		MANUALLY       => 'Bình thường',
		INCREASE_PRICE => 'Tăng giá'
    );
}
