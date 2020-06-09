<?php

namespace App\Http\Controllers\Customer\Bill;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Bill;
use Illuminate\Http\Request;

class ListBillController extends CustomerController
{
    public function __construct(Bill $bill)
    {
		$this->bill = $bill;
    }

    public function bill(Request $request)
    {
		$account    = $this->guard()->user();
		$model_bill = $this->bill;
		$offset     = 4;

        $bills = $model_bill->where('id_customer', $account->id)
        	->orderBy('created_at', 'desc')
        	->paginate($offset);
        $count_bills = $this->countBill();

        return view('User.Customer.Bill.index', [
			'account'     => $account,
			'model_bill'  => $model_bill,
			'bills'       => $bills,
			'count_bills' => $count_bills,
        ]);
    }

    public function countBill()
    {
		$account     = $this->guard()->user();
		$model_bill  = $this->bill;
		$array_count = array();

        $count_bills = $model_bill->where('id_customer', $account->id)
        	->count();
		$count_unpaid_bills    = $model_bill->where('id_customer', $account->id)
			->where('status', UNPAID)
			->count();
		$count_deposited_bills = $model_bill->where('id_customer', $account->id)
			->where('status', DEPOSITED)
			->count();
		$count_paid_bills      = $model_bill->where('id_customer', $account->id)
			->where('status', PAID)
        	->count();

        $array_count = array(
			'count_bills'           => $count_bills,
			'count_unpaid_bills'    => $count_unpaid_bills,
			'count_deposited_bills' => $count_deposited_bills,
			'count_paid_bills'      => $count_paid_bills,
        );
        return $array_count;
    }
}
