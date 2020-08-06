<?php

namespace App\Http\Controllers\Customer\Bill;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Bill;
use Illuminate\Http\Request;

class ListQueueBillController extends CustomerController
{
    public function __construct(Bill $bill)
    {
		$this->bill = $bill;
    }

    public function queueBill(Request $request)
    {
    	$visual_bill = array();
		$account    = $this->guard()->user();
		$model_bill = $this->bill;
		$queue_bill = $request->cookie('queue_bill');
		if($queue_bill)
			$visual_bill = json_decode($queue_bill);

        return view('User.Customer.Bill.queue_bill', [
			'account'     => $account,
			'model_bill'  => $model_bill,
			'visual_bill' => $visual_bill
        ]);
    }
}
