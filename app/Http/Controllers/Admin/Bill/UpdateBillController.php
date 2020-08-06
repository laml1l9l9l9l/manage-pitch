<?php

namespace App\Http\Controllers\Admin\Bill;

use App\Http\Controllers\Controller;
use App\Model\Admin\Bill;
use App\Model\Admin\HistoryBill;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateBillController extends Controller
{
    public function __construct(Bill $bill, HistoryBill $history_bill)
    {
		$this->bill         = $bill;
		$this->history_bill = $history_bill;
    }

    public function index($id, Request $request)
    {
        $request_bill = $request->bill;
		$model_bill         = $this->bill;
		$model_history_bill = $this->history_bill;

		$admin      = $this->guard()->user();
		$admin_name = $admin->name ? $admin->name : 'Chưa có tên';
		$new_status = (int) $request_bill['status'];
		$bill            = $model_bill->find($id);
		$old_status_bill = $model_bill->status_model[(string) $bill->status];
		$new_status_bill = $model_bill->status_model[$request_bill['status']];

       	if($bill){
			$bill->status     = $new_status;
			$bill->updated_at = Helper::getCurrentDateTime();
       		$bill->save();

       		if($old_status_bill != $new_status_bill){
				$model_history_bill->id_bill    = $id;
				$model_history_bill->id_admin   = $admin->id;
				$model_history_bill->log_change = "$admin_name: Thay đổi trạng thái $old_status_bill -> $new_status_bill";
				$model_history_bill->status 	= ACTIVE;
				$model_history_bill->created_at = Helper::getCurrentDateTime();
				$model_history_bill->updated_at = Helper::getCurrentDateTime();
				$model_history_bill->save();
	       	}
       	}

        return redirect()->route('admin.bill.detail', ['id' => $id])
        	->with('success', 'Cập nhật thành công');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}