<?php

namespace App\Http\Controllers\Customer\Bill;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Bill;
use App\Model\Customer\DetailBill;
use App\Model\Customer\Date;
use App\Model\Customer\Time;
use App\Model\Customer\Pitch;
use App\Model\Customer\SpecialDateTime;
use App\Model\Helper;
use Illuminate\Http\Request;

class BillController extends CustomerController
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

    public function createBill(Request $request)
    {
		$request_bill = $request->get('bill');
		$type_rent    = $request->get('type_rent');

		$model_bill = $this->bill;
        $name_route = 'customer.home';
        $id_element = '#row-title-notice';

		$customer = $this->guard()->user();
		$request_bill['customer'] = $customer;
		$price = 0;

    	// check isset detail bill
    	$count_detail_bill = $this->checkIssetBillDetail($request_bill);

		if($count_detail_bill > 0){
			return redirect()->route($name_route, $id_element)->with('error', 'Khoảng thời gian bạn chọn đã được thuê, vui lòng thử lại');
		}

		// Create bill then create detail bill
		$id_bill = $this->storeBill($customer);

		$request_bill['id_bill'] = $id_bill;

        if($type_rent == SIMPLE)
        {
        	$price = $this->createBillSimpleRent($request_bill);
		}
		else if($type_rent == MULTIPLE)
		{
			$price = $this->createBillMultipleRent($request_bill);
		}
		else
		{
			return redirect()->route($name_route, $id_element)->with('error', 'Xảy ra lỗi, vui lòng thử lại');
		}

		// Update price bill
		$bill = $model_bill->find($id_bill);
		$bill->into_money = $price;
		$bill->save();

		return redirect()->route($name_route, $id_element)->with('success', 'Thuê sân thành công');
    }

    public function createBillSimpleRent(array $data)
    {    	
    	$customer = $data['customer'];

		$model_detail_bill = $this->detail_bill;
		$model_date        = $this->date;
		$model_time_slot   = $this->time;
		$model_pitch       = $this->pitch;
		$model_special_datetime = $this->special_datetime;


		$increase_price_date = 0;
		$into_money          = 0;


		$date = $model_special_datetime->where('date', '=', $data['date'])
			->whereNull('id_time_slot')->first();
		if(!empty($date)){
			$increase_price_date += $date->increase_price;
		}

		$time = $model_special_datetime->where('id_time_slot', '=', $data['time_slot'])
			->whereNull('date')->first();
		if(!empty($time)){
			$increase_price_date += $time->increase_price;
		}

		$datetime = $model_special_datetime->where('date', '=', $data['date'])
			->where('id_time_slot', '=', $data['time_slot'])->first();
		if(!empty($datetime)){
			$increase_price_date += $datetime->increase_price;
		}

		// Get price
		$pitch = $model_pitch->where('id', $data['pitch'])->first();
		$price = $pitch->price + $increase_price_date;


		// Create deatil bill
		$model_detail_bill->id_bill      = $data['id_bill'];
		$model_detail_bill->id_pitch     = $data['pitch'];
		$model_detail_bill->id_time_slot = $data['time_slot'];
		$model_detail_bill->soccer_day   = $data['date'];
		$model_detail_bill->price        = $price;
		$model_detail_bill->created_at   = Helper::getCurrentDateTime();
		$model_detail_bill->updated_at   = Helper::getCurrentDateTime();
		$model_detail_bill->save();

		return $price;
    }

    public function createBillMultipleRent(array $data)
    {
    	dd('ok');
    }

    public function storeBill($customer)
    {
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

    public function checkIssetBillDetail(array $data)
    {
		$model_detail_bill = $this->detail_bill;
		$count_detail_bill = $model_detail_bill->where('soccer_day', '=', $data['date'])
			->where('id_time_slot', '=', $data['time_slot'])
			->where('id_pitch', '=', $data['pitch'])
			->count();

		return $count_detail_bill;
    }
}
