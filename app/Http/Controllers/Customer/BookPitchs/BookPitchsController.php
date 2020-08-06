<?php

namespace App\Http\Controllers\Customer\BookPitchs;

use App\Http\Controllers\Controller;
use App\Model\Customer\Pitch;
use App\Model\Customer\Time;
use App\Model\Customer\Date;
use App\Model\Customer\DetailBill;
use App\Model\Customer\SpecialDateTime;
use Illuminate\Http\Request;
use Validator;

class BookPitchsController extends Controller
{
    public function __construct(Pitch $pitch, Time $time, Date $date, DetailBill $detail_bill, SpecialDateTime $special_datetime)
    {
		$this->pitch       = $pitch;
		$this->time        = $time;
		$this->date        = $date;
		$this->detail_bill = $detail_bill;
		$this->special_datetime = $special_datetime;
    }

    public function check()
    {
		$model_pitch = $this->pitch;
    	return view('User.Customer.BookPitchs.check', [
    		'model_pitch' => $model_pitch
    	]);
    }

    public function selectDateTimeRent(Request $request)
    {
		$array_bill   = array();				
		$book_request = $request->book;
        $this->validatorSelectDateTimeRent($book_request)->validate();

        // clear visual detail bill
		$array_bill = json_encode($array_bill);
		$this->setCookie('visual_detail_bills', $array_bill, 60);

		$date_time_booking = $this->suggestDateTimeBooking($book_request);
		$data_suggest      = $this->dataSuggestBooking($date_time_booking);

    	return view('User.Customer.BookPitchs.suggest', [
    		'data_suggest' => $data_suggest
    	]);
    }

    protected function dataSuggestBooking(array $data)
    {
		$model_time  = $this->time;
		$model_pitch = $this->pitch;
    	$array_data_suggest = array();

    	foreach ($data as $element) {
    		$array_information = array();
			$date         = $element->date ? $element->date : '';
			$informations = $element->informations ? $element->informations : [];
    		foreach ($informations as $information) {
    			$pitch_id = $information->pitch ? $information->pitch : '';
    			$pitch = $model_pitch->find($pitch_id);
    			$times = $information->times ? $information->times : '';
    			foreach ($times as $time) {
    				$time_slot_id = $time;
    				$time = $model_time->find($time_slot_id);

		    		$amount = $this->getAmountBill([
						'date'  => $date,
						'pitch' => $pitch_id,
						'time'  => $time_slot_id,
		    		]);

		    		$informations = (object) array(
						'pitch'      => $pitch_id,
						'pitch_name' => $pitch->name,
						'time'       => $time_slot_id,
						'time_name'  => $time->name,
						'amount'     => $amount,
		    		);
					array_push($array_information, $informations);
    			}
    		};
    		$data_result = (object) array(
				'date'         => $date,
				'informations' => $array_information
    		);
			array_push($array_data_suggest, $data_result);
    	}

    	return $array_data_suggest;
    }

    protected function suggestDateTimeBooking(array $date)
    {
		$model_detail_bill = $this->detail_bill;
		$model_date        = $this->date;
		$model_time        = $this->time;
		$model_pitch       = $this->pitch;
		$array_date  = array();
		$array_time  = array();
		$array_pitch = array();
		$code    = null; // 00: success, 01: error
		$message = null;
		$result  = array();

		// Get array date for period
		$date_start   = date('Y-m-d', strtotime($date['date_start'] . ' 0 day'));
		$date_end     = date('Y-m-d', strtotime($date['date_end'] . ' +1 day'));
		$period_dates = new \DatePeriod(
		     new \DateTime($date_start),
		     new \DateInterval('P1D'),
		     new \DateTime($date_end)
		);
		foreach($period_dates as $date_period){
            $isset_date = $model_date->where('date', $date_period)
                ->where('status', LOCK)
            	->first();
            if($isset_date)
            	continue;

            $date_period = $date_period->format('Y-m-d');
            array_push($array_date, $date_period);
		}

		// Get array time for period
		$time_slots = $model_time->where('status', ACTIVE)
			->get();
		$time_start = strtotime($date['time_start']);
		$time_end   = strtotime($date['time_end']);
		foreach($time_slots as $time_slot){
			$time_slot_start = strtotime($time_slot->time_start);
			$time_slot_end   = strtotime($time_slot->time_end);
            if($time_start > $time_slot_start || $time_end < $time_slot_end){
            	continue;
            }

            array_push($array_time, $time_slot->id);
		}

		// Get array pitch
		$pitchs = $model_pitch->where('status', ACTIVE)
			->where('type', $date['type_pitch'])
			->get();
		foreach ($pitchs as $pitch) {
			array_push($array_pitch, $pitch->id);
		}

		// Get result
		if(!$array_date || !$array_time || !$array_pitch) {
			$code = '01';
			$message = 'error';
		} else {
			foreach ($array_date as $a_date) {
				$informations  = array();
				$informations = $this->informationDate([
					'date'   => $a_date,
					'times'  => $array_time,
					'pitchs' => $array_pitch
				]);

				$data_result = (object) array(
					'date'         => $a_date,
					'informations' => $informations
				);

				array_push($result, $data_result);
			}
		}

		return $result;
    }

    protected function informationDate(array $data)
    {
		$model_detail_bill = $this->detail_bill;
		$date   = $data['date'];
		$times  = $data['times'];
		$pitchs = $data['pitchs'];

		$informations = array();

    	foreach ($pitchs as $pitch) {
			$object_information = null;
			$array_time = array();
    		foreach ($times as $time) {
    			$isset_detail_bill = $model_detail_bill->join('bills', 'detail_bills.id_bill', '=', 'bills.id')
    				->where('detail_bills.soccer_day', $date)
					->where('detail_bills.id_time_slot', $time)
					->where('detail_bills.id_pitch', $pitch)
					->where('bills.type', ACTIVE)
					->count();

				if($isset_detail_bill > 0)
					continue;

				array_push($array_time, $time);
    		}

    		if(!$array_time)
    			continue;

    		$object_information = (object) array(
    			'pitch' => $pitch,
    			'times' => $array_time
    		);

			array_push($informations, $object_information);
    	}

    	return $informations;
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

    protected function getSeriesVitualBill(array $data)
    {
    	$series = null;
    	return $series;
    }

    private $array_select_date_time_validate = [
		'time_start' => ['required', 'date_format:H:i'],
		'time_end'   => ['required', 'date_format:H:i', 'after_or_equal:time_start'],
		'date_start' => ['required', 'date_format:Y-m-d', 'after:today'],
		'date_end'   => ['required', 'date_format:Y-m-d', 'after_or_equal:date_start'],
		'type_pitch' => ['required', 'string', 'min:1', 'max:1'],
    ];


    private function validatorSelectDateTimeRent(array $data)
    {
        return Validator::make($data, $this->array_select_date_time_validate, $this->messages());
    }

    private function messages()
    {
        return [
			'required'                => 'Không được để trống',
			'string'                  => 'Sai định dạng',
			'max'                     => 'Sai định dạng',
			'min'                     => 'Sai định dạng',
			'date_format'             => 'Sai định dạng',
			'date_start.after'        => 'Ngày bắt đầu phải lớn hơn ngày hiện tại',
			'date_end.after_or_equal' => 'Ngày không hợp lệ',
			'time_end.after_or_equal' => 'Giờ không hợp lệ',
        ];
    }
}