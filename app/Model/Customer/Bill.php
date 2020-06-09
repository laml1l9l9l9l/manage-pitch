<?php

namespace App\Model\Customer;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';

    public $status_model = array(
		UNPAID    => 'Chưa đặt cọc',
		DEPOSITED => 'Đã đặt cọc',
		PAID      => 'Đã thanh toán',
    );

    public $class_color_status_model = array(
        UNPAID    => 'text-danger',
        DEPOSITED => 'text-warning',
        PAID      => 'text-success',
    );
}
