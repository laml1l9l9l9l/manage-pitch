<?php

namespace App\Http\Controllers\Customer\Bill;

use App\Http\Controllers\Controller;
use App\Model\Customer\Bill;
use App\Model\Customer\DetailBill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct(Bill $bill, DetailBill $detail_bill)
    {
		$this->bill        = $bill;
		$this->detail_bill = $detail_bill;
    }

    public function createBill(Request $request)
    {
    	$request_bill = $request->get('bill');

        dd($request_bill);
		$model_bill = $this->bill;
		$model_detail_bill = $this->detail_bill;
		$customer   = $this->guard()->user();

		// Function process price each pitch
		// Function process into money
    }
}
