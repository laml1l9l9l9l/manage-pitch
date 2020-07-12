<?php

namespace App\Model\Admin;

use App\Model\Admin\Customer;
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

    public $class_color_status_statistical = array(
        DECREASE    => 'label-danger',
        KEEP_STABLE => 'label-warning',
        INCREASE    => 'label-success',
    );

    public function getCustomer($id_customer)
    {
    	$model_customer = new Customer;
    	$customer = $model_customer->find($id_customer);
    	return $customer;
    }
}
