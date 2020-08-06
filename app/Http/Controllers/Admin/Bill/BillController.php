<?php

namespace App\Http\Controllers\Admin\Bill;

use App\Http\Controllers\Controller;
use App\Model\Admin\Bill;
use App\Model\Admin\DetailBill;
use App\Model\Admin\HistoryBill;
use App\Model\Admin\SpecialDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function __construct(Bill $bill, DetailBill $detail_bill, HistoryBill $history_bill,SpecialDateTime $special_datetime)
    {
        $this->bill             = $bill;
        $this->detail_bill      = $detail_bill;
        $this->history_bill     = $history_bill;
        $this->special_datetime = $special_datetime;
    }

    public function index(Request $request)
    {
        $request_bill = $request->bill;
        $model_bill   = $this->bill;

		$offset     = 10;
		$start_page = 1;
		$page       = $request->get('page');
		$page_bill  = $this->indexTable($page, $offset);

        $bills = !empty($request_bill) ? $this->search($request_bill, $offset) : $model_bill;
        $bills = $bills->orderBy('created_at', 'desc')
            ->paginate($offset);
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

        return $bills;
    }

    public function detail($id, Request $request)
    {
        $model_bill             = $this->bill;
        $model_detail_bill      = $this->detail_bill;
        $model_history_bill     = $this->history_bill;
        $model_special_datetime = $this->special_datetime;
        $offset = 6;

        $bill         = $model_bill->join('customers', 'customers.id', '=', 'bills.id_customer')
            ->where('bills.id', $id)
            ->select('bills.*', 'customers.id as id_customer', 'customers.name')
            ->first();
        $detail_bills = $model_detail_bill->join('time_slots', 'time_slots.id', '=', 'detail_bills.id_time_slot')
            ->join('pitchs', 'pitchs.id', '=', 'detail_bills.id_pitch')
            ->where('id_bill', $id)
            ->orderBy('created_at', 'desc')
            ->select('detail_bills.*', 'time_slots.name as name_time_slot', 'pitchs.name as name_pitch', 'pitchs.price as price_pitch')
            ->paginate($offset);
        $history_bill = $model_history_bill->where('id_bill', $id)
            ->join('admins', 'admins.id', '=', 'bill_history.id_admin')
            ->select('bill_history.*', 'admins.email as email_admin')
            ->get();
        return view('User.Admin.Bill.detail', [
            'model_bill'             => $model_bill,
            'model_detail_bill'      => $model_detail_bill,
            'model_special_datetime' => $model_special_datetime,
            'bill'                   => $bill,
            'detail_bills'           => $detail_bills,
            'history_bill'           => $history_bill
        ]);
    }

    public function delete($id)
    {
        $model_bill        = $this->bill;
        $model_detail_bill = $this->detail_bill;

        $bill         = $model_bill->find($id);
        $detail_bills = $model_detail_bill->where('id_bill', $id)
            ->get();
        foreach ($detail_bills as $detail_bill) {
            $detail_bill->delete();
        }
        $bill->delete();

        return redirect()->route('admin.bill')
            ->with('success', 'Bạn đã xóa hóa đơn');
    }
}
