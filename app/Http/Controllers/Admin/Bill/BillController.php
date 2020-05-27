<?php

namespace App\Http\Controllers\Admin\Bill;

use App\Http\Controllers\Controller;
use App\Model\Admin\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct(Bill $bill)
    {
		$this->bill = $bill;
    }

    public function index()
    {
    	return view('User.Admin.Bill.index');
    }
}
