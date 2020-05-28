<?php

namespace App\Http\Controllers\Customer\Bill;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Bill;
use App\Model\Customer\DetailBill;
use App\Model\Customer\Date;
use App\Model\Customer\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends CustomerController
{
    public function __construct(Bill $bill, DetailBill $detail_bill, Date $date, Time $time)
    {
		$this->bill        = $bill;
		$this->detail_bill = $detail_bill;
		$this->date        = $date;
		$this->time        = $time;
    }

    public function createBill(Request $request)
    {
    	$request_bill = $request->get('bill');
    	$type_rent = $request->get('type_rent');

		$customer   = $this->guard()->user();
		$request_bill['customer'] = $customer;


		$model_bill = $this->bill;

        if($type_rent == SIMPLE)
        {
        	$this->createBillSimpleRent($request_bill);
		}
		else if($type_rent == MULTIPLE)
		{
			$this->createBillMultipleRent($request_bill);
		}
		else
		{
			return redirect()->route('customer.home')->with('error', 'Xảy ra lỗi, vui lòng thử lại');
		}
		dd('ok');

		// Function process price each pitch
		// Function process into money
    }

    public function createBillSimpleRent(array $data)
    {
    	$customer = $data['customer'];

		$model_detail_bill = $this->detail_bill;
		$model_date        = $this->date;
		$model_time_slot   = $this->time;


		$increase_price_date = 0;

		$date = $model_date->where('date', '=', $data['date'])->first();
		if(!empty($date)){
			$increase_price_date = $date->increase_price;
		}

		$time = $model_time_slot->where('date', '=', $data['date'])->first();
		if(!empty($date)){
			$increase_price_date = $date->increase_price;
		}
		dd($date);
    }

    public function createBillMultipleRent(array $data)
    {
    	dd('ok');
    }
}
