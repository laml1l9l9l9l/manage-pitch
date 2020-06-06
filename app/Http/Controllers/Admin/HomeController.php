<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(Customer $customer)
    {
		$this->customer = $customer;
    }

    public function home()
    {
    	$account_customer_statistical = $this->statisticalAccountCustomer();

    	return view('User.Admin.home', [
    		'account_customer_statistical' => $account_customer_statistical
    	]);
    }

    public function statisticalAccountCustomer()
    {
    	$statistical = array();
    	$count = 0;
    	$percent = 0;
    	$percent_status = DECREASE;
    	$model_customer = $this->customer;

    	$count = $model_customer->count();

    	// account sign up percent
    	

    	$statistical = array(
    		'count' => $count,
    	);

    	return $statistical;
    }
}
