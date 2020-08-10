<?php

namespace App\Http\Controllers\Customer\BookPitchs;

use App\Http\Controllers\Controller;
use App\Model\Customer\Pitch;
use App\Model\Customer\Time;
use App\Model\Customer\Date;
use App\Model\Customer\Bill;
use App\Model\Customer\DetailBill;
use App\Model\Customer\SpecialDateTime;
use App\Model\Helper;
use Illuminate\Http\Request;

class BillBookPitchsController extends Controller
{
    public function __construct(Pitch $pitch, Time $time, Date $date, Bill $bill, DetailBill $detail_bill, SpecialDateTime $special_datetime)
    {
		$this->pitch       = $pitch;
		$this->time        = $time;
		$this->date        = $date;
		$this->bill        = $bill;
		$this->detail_bill = $detail_bill;
		$this->special_datetime = $special_datetime;
    }

	public function addVisualDetailBill(Request $request)
	{
		$array_bill = array();
		$data        = $request->all();
		$visual_bill = $request->cookie('visual_detail_bills');
		if($visual_bill)
			$array_bill = json_decode($visual_bill);
		$date   = $data['date'];
		$pitch  = intval($data['pitch']);
		$time   = intval($data['time']);
		$amount = intval($data['amount']);

		$series = $this->series([
			'date'  => $date,
			'time'  => $time,
			'pitch' => $pitch
		]);
		$result = (object) array(
			'date'   => $date,
			'time'   => $time,
			'pitch'  => $pitch,
			'amount' => $amount
		);
		$data_bill = (object) array(
			'series' => $series,
			'result' => $result
		);
		array_push($array_bill, $data_bill);
		$array_bill = $this->unsetElementUniqueArray($array_bill);
		$array_bill = json_encode($array_bill);
		$this->setCookie('visual_detail_bills', $array_bill, 60);

		return $array_bill;
	}

	public function removeVisualDetailBill(Request $request)
	{
		$array_bill     = array();
		$new_array_bill = array();
		$data        = $request->all();
		$visual_bill = $request->cookie('visual_detail_bills');
		if($visual_bill)
			$array_bill = json_decode($visual_bill);
		$date   = $data['date'];
		$pitch  = intval($data['pitch']);
		$time   = intval($data['time']);
		$amount = intval($data['amount']);

		$series = $this->series([
			'date'  => $date,
			'time'  => $time,
			'pitch' => $pitch
		]);

		$array_bill = $this->unsetSeriesElementArray($array_bill, $series);
		foreach ($array_bill as $element)
			array_push($new_array_bill, $element);
		$new_array_bill = json_encode($new_array_bill);
		$this->setCookie('visual_detail_bills', $new_array_bill, 60);

		return $new_array_bill;
	}

	public function confirmBills(Request $request)
	{
		# get visual detail bill
		# save visual bill to queue bills( where confirm wating bill )
		# total bill
		# detail bill
		$check_customer = $this->checkPhoneCustomer();

		if(!$check_customer)
			return redirect()->route('customer.home', '#row-title-notice')
				->with('warning', 'Thêm số điện thoại để được đặt sân');
		$total_bill        = array();
		$total_series      = 0;
		$total_dates       = array();
		$total_time_slots  = array();
		$total_pitchs      = array();
		$total_amount      = 0;
		$total_detail_bill = array();
		$visual_bill = $request->cookie('visual_detail_bills');
		if($visual_bill){
			$visual_bill = json_decode($visual_bill);
			foreach ($visual_bill as $bill) {
				$result_bill       = $bill->result;
				$total_series      += $bill->series;
				$total_amount      += $result_bill->amount;
				$total_dates       = $this->pushDateBill($total_dates, $result_bill->date);
				$total_time_slots  = $this->pushTimeBill($total_time_slots, $result_bill->time);
				$total_pitchs      = $this->pushPitchBill($total_pitchs, $result_bill->pitch);
				$total_detail_bill = $this->pushDetailBill($total_detail_bill, $bill->result);
			}
		}

		if($total_series)
			$total_bill = (object) array(
				'total_series'      => $total_series,
				'total_dates'       => $total_dates,
				'total_time_slots'  => $total_time_slots,
				'total_pitchs'      => $total_pitchs,
				'total_amount'      => $total_amount,
				'total_detail_bill' => $total_detail_bill,
			);

		return view('User.Customer.BookPitchs.book', [
			'total_bill' => $total_bill,
			'visual_bill' => $visual_bill
		]);
	}

	public function createBill(Request $request)
	{
		$array_bill   = array();
		$total_bill   = array();
		$total_amount = 0;
		$model_bill  = $this->bill;
		$visual_bill = $request->cookie('visual_detail_bills');
		if($visual_bill) {
			$array_bill = json_decode($visual_bill);
			// Check isset detail bill
			foreach ($array_bill as $bill) {
				$isset_bill = false;
				$array_data = (array)$bill->result;
				$isset_bill = $this->checkBookingInformation($array_data);
				if($isset_bill){
					return redirect()->route('customer.check.book.pitchs', '#row-title-notice')
						->with('error', 'Thời gian đã được thuê. Vui lòng thử lại');
				}
			}
			$id_bill    = $this->storeBill();
		} else {
			return redirect()->route('customer.check.book.pitchs', '#row-title-notice')
				->with('error', 'Xảy ra lỗi, vui lòng thử lại');
		}

		// Save bill
		foreach ($array_bill as $detail_bill) {
			$result_bill            = (array)$detail_bill->result;
			$result_bill['id_bill'] = $id_bill;
			$this->storeDetailBill($result_bill);
			$total_amount += $result_bill['amount'];
		}

		// Update amount
		$bill = $model_bill->find($id_bill);
		$bill->into_money = $total_amount;
		$bill->updated_at = Helper::getCurrentDateTime();
		$bill->save();

		return redirect()->route('customer.bill', '#row-title-notice')
			->with('success', 'Đặt giải thành công');
	}

    protected function storeBill()
    {
		$customer = $this->guard()->user();
		$model_bill = $this->bill;
		$model_bill->code         = 'HĐ_'.strtotime('now');
		$model_bill->down_payment = 0;
		$model_bill->into_money   = 0;
		$model_bill->status       = UNPAID;
		$model_bill->id_customer  = $customer->id;
		$model_bill->created_at   = Helper::getCurrentDateTime();
		$model_bill->updated_at   = Helper::getCurrentDateTime();
		$model_bill->save();
		$id_bill = $model_bill->id;

		return $id_bill;
    }

    protected function storeDetailBill(array $data)
    {
		$model_detail_bill = new DetailBill;

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

	protected function series(array $data)
	{
		$model_pitch = $this->pitch;
		$model_time  = $this->time;
		$pitch  = $model_pitch->find($data['pitch']);
		$time   = $model_time->find($data['time']);
		$series = strtotime($data['date']) + (int)$data['time'] + (int)$data['pitch'] + strtotime($time->created_at) + strtotime($pitch->created_at);
		return $series;
	}

    protected function unsetElementUniqueArray(array $array){
	    $duplicate_keys = array();
	    $tmp = array();

	    foreach ($array as $key => $val){
	        // convert objects to arrays, in_array() does not support objects
	        if (is_object($val))
	            $val = (array)$val;

	        if (!in_array($val['series'], $tmp))
	            $tmp[] = $val['series'];
	        else
	            $duplicate_keys[] = $key;
	    }

	    foreach ($duplicate_keys as $key)
	        unset($array[$key]);

	    return $array;
	}

    protected function unsetSeriesElementArray(array $array, $unset_series){
	    foreach ($array as $key => $val){
	        // convert objects to arrays, in_array() does not support objects
	        if (is_object($val))
	            $val = (array)$val;

	        if ($val['series'] === $unset_series)
	        	unset($array[$key]);
	    }

	    return $array;
	}

	protected function pushDateBill(array $array, $date)
	{
		if(!in_array($date, $array))
			array_push($array, $date);
		return $array;
	}

	protected function pushTimeBill(array $array, $time)
	{
		if(!in_array($time, $array))
			array_push($array, $time);
		return $array;
	}

	protected function pushPitchBill(array $array, $pitch)
	{
		if(!in_array($pitch, $array))
			array_push($array, $pitch);
		return $array;
	}

	protected function pushDetailBill(array $array, $bill)
	{
		$model_special_datetime = $this->special_datetime;
		$model_time             = $this->time;
		$model_pitch            = $this->pitch;
		$array_information = array();

        // Get informations
		$pitch = $model_pitch->find($bill->pitch);
		$time  = $model_time->find($bill->time);
		$array_information = array(
			'name_pitch'  => $pitch->name,
			'price_pitch' => $pitch->price,
			'name_time'   => $time->name
		);
        
        // Get increase price
		$price_special_date_time = $model_special_datetime->getPriceSpecialDateTime($bill->time, $bill->date);

		// Add value to bill
		$bill = (array)$bill;
		$bill = array_merge($bill, $array_information);
		$bill = array_merge($bill, $price_special_date_time);
		$bill = (object) $bill;

		array_push($array, $bill);
		return $array;
	}

    protected function checkBookingInformation(array $data)
    {
    	$result = true;
		$model_detail_bill = $this->detail_bill;

    	$bill = $model_detail_bill->where('id_pitch', $data['pitch'])
    		->where('id_pitch', $data['pitch'])
    		->where('id_time_slot', $data['time'])
    		->where('soccer_day', $data['date'])
    		->count();
    	
    	if(!$bill)
    		$result = false;

	    return $result;
    }

    protected function checkPhoneCustomer()
    {
		$customer = $this->guard()->user();
		$result   = false;

    	if(!empty($customer->phone))
    		$result = true;

    	return $result;
    }
}