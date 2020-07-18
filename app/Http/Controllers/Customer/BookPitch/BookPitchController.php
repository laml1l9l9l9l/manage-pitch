<?php

namespace App\Http\Controllers\Customer\BookPitch;

use App\Http\Controllers\Controller;
use App\Model\Customer\Bill;
use App\Model\Customer\DetailBill;
use App\Model\Customer\Date;
use App\Model\Customer\Time;
use App\Model\Customer\Pitch;
use App\Model\Customer\SpecialDateTime;
use Illuminate\Http\Request;

class BookPitchController extends Controller
{
    public function __construct(Bill $bill, DetailBill $detail_bill, Date $date, Time $time, Pitch $pitch, SpecialDateTime $special_datetime)
    {
		$this->bill        = $bill;
		$this->detail_bill = $detail_bill;
		$this->date        = $date;
		$this->time        = $time;
		$this->pitch       = $pitch;
		$this->special_datetime = $special_datetime;
    }

	public function confirmBill(Request $request)
	{
		$array_bill    = array();
		$data_result   = null;
		$data_response = null;
		$model_time  = $this->time;
		$model_pitch = $this->pitch;

		$request_bill = $request->get('bill');
		$visual_bill  = $request->cookie('visual_bill');
		if($visual_bill)
			$array_bill = json_decode($visual_bill);

		$data_bill   = $this->checkBill($request_bill);
		$data_result = $data_bill->result;

		if($data_result){
			array_push($array_bill, $data_bill);
			$date = date('d-m-Y', strtotime($data_result->date));
			$time = $model_time->find($data_result->time);
			$pitch = $model_pitch->find($data_result->pitch);
			$data_response = (object) array(
				'date'   => $date,
				'time'   => $time->name,
				'pitch'  => $pitch->name,
				'amount' => $data_result->amount
			);
		}
		$array_bill    = $this->arrayUnique($array_bill);
		$array_bill    = json_encode($array_bill);
		$data_new_bill = json_encode($data_bill);
		$this->setCookie('visual_bill', $array_bill, 60); // set cookie visual bill
		$this->setCookie('new_bill', $data_new_bill, 60); // set cookie new bill


		return view('User.Customer.BookPitch.book', [
			'data_response' => $data_response,
			'data_suggest'  => $data_bill->suggest
		]);
	}

    public function getAmountBill(array $data)
    {
		$model_pitch            = $this->pitch;
		$model_special_datetime = $this->special_datetime;
    	$amount = 0;
    	$pitch = $model_pitch->find($data['pitch']);
    	$amount += $pitch->price;
    	$special_date = $model_special_datetime->where('date', '=', $data['date'])
			->whereNull('id_time_slot')->first();
		if($special_date)
			$amount += $special_date->increase_price;
    	$special_time = $model_special_datetime->where('id_time_slot', '=', $data['time'])
			->whereNull('date')->first();
		if($special_time)
			$amount += $special_time->increase_price;
    	$special_datetime = $model_special_datetime->where('date', '=', $data['date'])
			->where('id_time_slot', '=', $data['time'])->first();
		if($special_datetime)
			$amount += $special_datetime->increase_price;
    	return $amount;
    }

    public function checkBill(array $data)
    {
		$model_detail_bill = $this->detail_bill;
		$model_time  = $this->time;
		$model_pitch = $this->pitch;
		$code    = null; // 00: success, 01: error
		$message = null;
		$series  = null;
		$result  = null;
		$suggest = array();
		$amount      = 0;
		$data_amount = array();

		$count_detail_bill = $model_detail_bill->where('soccer_day', '=', $data['date'])
			->where('id_time_slot', '=', $data['time_slot'])
			->where('id_pitch', '=', $data['pitch'])
			->count();

		if($count_detail_bill > 0){
			$object_suggest = '';
			$array_blank_pitch = $this->getBlankPitch($data);
			foreach ($array_blank_pitch as $blank_pitch) {
				$data_amount = array(
					'date'  => $data['date'],
					'time'  => $data['time_slot'],
					'pitch' => $blank_pitch
				);
				$amount = $this->getAmountBill($data_amount);
				$date   = date('d-m-Y', strtotime($data['date']));
				$time   = $model_time->find($data['time_slot']);
				$pitch  = $model_pitch->find($blank_pitch);
				$object_suggest = (object) array(
					'date'          => $data['date'],
					'date_response' => $date,
					'time'          => $data['time_slot'],
					'time_name'     => $time->name,
					'pitch'         => $blank_pitch,
					'pitch_name'    => $pitch->name,
					'amount'        => $amount
				);
				array_push($suggest, $object_suggest);
			}

			$code    = '01';
			$message = 'error';
		}
		else{
			$data_amount = array(
				'date'  => $data['date'],
				'time'  => $data['time_slot'],
				'pitch' => $data['pitch']
			);
			$amount = $this->getAmountBill($data_amount);
			$code    = '00';
			$message = 'success';
			$result  = (object) array(
				'date'   => $data['date'],
				'time'   => $data['time_slot'],
				'pitch'  => $data['pitch'],
				'amount' => $amount
			);
			$series = strtotime($result->date) + (int)$result->time + (int)$result->pitch;
		}


		return (object) array(
			'code'    => $code,
			'message' => $message,
			'series'  => $series,
			'result'  => $result,
			'suggest' => $suggest
		);
    }

    public function getBlankPitch(array $data)
    {
		$model_detail_bill = $this->detail_bill;
		$model_pitch       = $this->pitch;
		$array_pitch       = array();
		$array_blank_pitch = array();

		// Get array pitch
		$type_pitch = $model_pitch->where('id', $data['pitch'])
			->first();
		$pitchs = $model_pitch->where('type', $type_pitch->type)
			->where('status', ACTIVE)
			->get();
		foreach ($pitchs as $pitch)
			array_push($array_pitch, $pitch->id);

		foreach ($array_pitch as $pitch) {
			$count_detail_bill = $model_detail_bill->where('soccer_day', '=', $data['date'])
				->where('id_time_slot', '=', $data['time_slot'])
				->where('id_pitch', '=', $pitch)
				->count();

			if($count_detail_bill <= 0)
				array_push($array_blank_pitch, $pitch); //pitch is id
		}

		return $array_blank_pitch;
    }

    function arrayUnique(array $array){
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
}