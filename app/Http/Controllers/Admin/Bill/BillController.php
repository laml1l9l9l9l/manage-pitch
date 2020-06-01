<?php

namespace App\Http\Controllers\Admin\Bill;

use App\Http\Controllers\Controller;
use App\Model\Admin\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct(Bill $bill)
    {
		$this->bill = $bill;
    }

    public function index(Request $request)
    {
    	$model_bill = $this->bill;

		$offset     = 10;
		$start_page = 1;
		$page       = $request->get('page');
		$page_bill  = $this->indexTable($page, $offset);

        $bills = $model_bill->paginate($offset);
        $bills->setPath(URL::current());

    	return view('User.Admin.Bill.index', [
			'bills'      => $bills,
			'page_bill'  => $page_bill,
			'model_bill' => $model_bill,
    	]);
    }
}
