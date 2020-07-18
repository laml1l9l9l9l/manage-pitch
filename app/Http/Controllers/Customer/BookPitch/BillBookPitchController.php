<?php

namespace App\Http\Controllers\Customer\BookPitch;

use App\Http\Controllers\Controller;
use App\Model\Customer\Bill;
use App\Model\Customer\DetailBill;
use App\Model\Helper;
use Illuminate\Http\Request;

class BillBookPitchController extends Controller
{
    public function __construct(Bill $bill, DetailBill $detail_bill)
    {
		$this->bill        = $bill;
		$this->detail_bill = $detail_bill;
    }

    public function createBill(Request $request)
    {
    	// Kiểm tra trong cookie visual bill tồn tại series hóa đơn thì unset
    	// Tiến hành tạo hóa đơn
		$array_data = array();
		$data_bill   = json_decode($request->cookie('new_bill'));
		$visual_bill = json_decode($request->cookie('visual_bill'));
		if($data_bill->code == '00')
			$array_data = (array) $data_bill->result;

		// Unset element in visual bill
		$new_visual_bill = $this->unsetElementArray($visual_bill, $data_bill->series);
		$new_visual_bill = json_encode($new_visual_bill);
		$this->setCookie('visual_bill', $new_visual_bill, 60); // set cookie visual bill

		// Create bill then create detail bill
		$id_bill = $this->storeBill($array_data);
		$array_data['id_bill'] = $id_bill;
        $this->storeDetailBill($array_data);

		return redirect()->route('customer.bill', '#row-title-notice')->with('success', 'Thuê sân thành công');
    }

    public function storeBill(array $data)
    {
		$customer = $this->guard()->user();
		$model_bill = $this->bill;
		$model_bill->code         = 'HĐ_'.strtotime('now');
		$model_bill->down_payment = 0;
		$model_bill->into_money   = $data['amount'];
		$model_bill->status       = UNPAID;
		$model_bill->id_customer  = $customer->id;
		$model_bill->created_at   = Helper::getCurrentDateTime();
		$model_bill->updated_at   = Helper::getCurrentDateTime();
		$model_bill->save();
		$id_bill = $model_bill->id;

		return $id_bill;
    }

    public function storeDetailBill(array $data)
    {
		$model_detail_bill = $this->detail_bill;

		// Create deatil bill
		$model_detail_bill->id_bill      = $data['id_bill'];
		$model_detail_bill->id_pitch     = $data['pitch'];
		$model_detail_bill->id_time_slot = $data['time'];
		$model_detail_bill->soccer_day   = $data['date'];
		$model_detail_bill->price        = $data['amount'];
		$model_detail_bill->created_at   = Helper::getCurrentDateTime();
		$model_detail_bill->updated_at   = Helper::getCurrentDateTime();
		$model_detail_bill->save();

		return true;
    }

    function unsetElementArray(array $array, $unset_series){
	    foreach ($array as $key => $val){
	        // convert objects to arrays, in_array() does not support objects
	        if (is_object($val))
	            $val = (array)$val;

	        if ($val['series'] === $unset_series)
	        	unset($array[$key]);
	    }

	    return $array;
	}
}