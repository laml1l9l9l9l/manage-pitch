<?php

namespace App\Http\Controllers\Admin\Bill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
    	return view('User.Admin.Bill.index');
    }

}
