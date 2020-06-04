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
        $request_bill = $request->bill;
    	$model_bill = $this->bill;


		$offset     = 10;
		$start_page = 1;
		$page       = $request->get('page');
		$page_bill  = $this->indexTable($page, $offset);

        !empty($request_bill) ? $bills = $this->search($request_bill, $offset) : $bills = $model_bill->paginate($offset);
        $bills->setPath(URL::current());

    	return view('User.Admin.Bill.index', [
            'bills'        => $bills,
            'page_bill'    => $page_bill,
            'model_bill'   => $model_bill,
            'request_bill' => $request_bill,
            'request'      => $request->all()
    	]);
    }

    public function search($request_bill, $offset)
    {
        $model_bill = $this->bill;
        $bills      = $model_bill->join('customers', 'customers.id', 'bills.id_customer')
            ->select('bills.*','customers.name');

        !empty($request_bill['name']) ? $bills->where('customers.name', 'like', '%'.$request_bill['name'].'%') : '';
        (isset($request_bill['status']) && $request_bill['status'] !== null) ? $bills->where('bills.status', $request_bill['status']) : '';
        !empty($request_bill['start_created_at']) ? $bills->where('bills.created_at', '>=', $request_bill['start_created_at'].' 00:00:00') : '';
        !empty($request_bill['end_created_at']) ? $bills->where('bills.created_at', '<=', $request_bill['end_created_at'].' 23:59:59') : '';

        $bills = $bills->paginate($offset);

        return $bills;
    }
}
