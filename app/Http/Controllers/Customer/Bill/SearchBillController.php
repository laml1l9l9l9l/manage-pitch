<?php

namespace App\Http\Controllers\Customer\Bill;

use App\Http\Controllers\Customer\Bill\ListBillController;
use App\Model\Customer\Bill;
use Illuminate\Http\Request;

class SearchBillController extends ListBillController
{
    public function __construct(Bill $bill)
    {
		$this->bill = $bill;
    }

    public function search(Request $request)
    {
    	$status_bill = $request->status;

		$account    = $this->guard()->user();
		$model_bill = $this->bill;
		$offset     = 4;

        $bills = $model_bill->where('id_customer', $account->id)
        	->where('status', $status_bill)
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
}
