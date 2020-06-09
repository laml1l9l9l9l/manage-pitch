<?php

namespace App\Http\Controllers\Customer\Bill;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Bill;
use App\Model\Customer\DetailBill;
use App\Model\Customer\SpecialDateTime;
use Illuminate\Http\Request;

class DetailBillController extends CustomerController
{
    public function __construct(Bill $bill, DetailBill $detail_bill, SpecialDateTime $special_date_time)
    {
		$this->bill              = $bill;
		$this->detail_bill       = $detail_bill;
		$this->special_date_time = $special_date_time;
    }

    public function index($id, Request $request)
    {
        $model_bill             = $this->bill;
        $model_detail_bill      = $this->detail_bill;
        $model_special_datetime = $this->special_date_time;
        $offset = 6;

        $bill         = $model_bill->find($id);
        $detail_bills = $model_detail_bill->join('time_slots', 'time_slots.id', '=', 'detail_bills.id_time_slot')
            ->join('pitchs', 'pitchs.id', '=', 'detail_bills.id_pitch')
            ->where('id_bill', $id)
            ->orderBy('created_at', 'desc')
            ->select('detail_bills.*', 'time_slots.name as name_time_slot', 'pitchs.name as name_pitch', 'pitchs.price as price_pitch')
            ->paginate($offset);
    	return view('User.Customer.Bill.detail', [
            'model_bill'             => $model_bill,
            'model_detail_bill'      => $model_detail_bill,
            'model_special_datetime' => $model_special_datetime,
            'bill'                   => $bill,
            'detail_bills'           => $detail_bills,
        ]);
    }
}
