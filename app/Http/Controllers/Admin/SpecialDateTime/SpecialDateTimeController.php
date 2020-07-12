<?php

namespace App\Http\Controllers\Admin\SpecialDateTime;

use App\Http\Controllers\Controller;
use App\Model\Admin\SpecialDateTime;
use App\Model\Admin\Time;
use App\Model\Admin\Date;
use App\Model\Admin\DetailBill;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;

class SpecialDateTimeController extends Controller
{
    public function __construct(SpecialDateTime $special_datetime, Time $time, Date $date, DetailBill $detail_bill)
    {
        $this->special_datetime = $special_datetime;
        $this->time             = $time;
        $this->date             = $date;
        $this->detail_bill      = $detail_bill;
    }

    public function index(Request $request)
    {
        $request_special_datetime = $request->special_datetime;
        $model_special_datetime   = $this->special_datetime;
		
		$offset     = 10;
		$start_page = 1;
		$page                  = $request->get('page');
		$page_special_datetime = $this->indexTable($page, $offset);

        $special_datetime = !empty($request_special_datetime) ? $this->search($request_special_datetime) : $model_special_datetime;
        $special_datetime = $special_datetime->orderBy('date', 'desc')->paginate($offset);
        $special_datetime->setPath(URL::current());

    	return view('User.Admin.SpecialDateTime.index',[
            'special_datetime'         => $special_datetime,
            'model_special_datetime'   => $model_special_datetime,
            'page_special_datetime'    => $page_special_datetime,
            'request_special_datetime' => $request_special_datetime,
            'request'                  => $request->all()
    	]);
    }

    public function search($request_special_datetime)
    {
        $special_datetime = $this->special_datetime;
        $special_datetime = $special_datetime->join('time_slots', 'time_slots.id', 'special_datetime.id_time_slot')
            ->select('special_datetime.*', 'time_slots.time_start', 'time_slots.time_end');

        !empty($request_special_datetime['time_start']) ? $special_datetime = $special_datetime->where('time_slots.time_start', '>=', $request_special_datetime['time_start']) : '';
        !empty($request_special_datetime['time_end']) ? $special_datetime = $special_datetime->where('time_slots.time_end', '<=', $request_special_datetime['time_end']) : '';
        (isset($request_special_datetime['status']) && $request_special_datetime['status'] !== null) ? $special_datetime = $special_datetime->where('special_datetime.status', $request_special_datetime['status']) : '';
        !empty($request_special_datetime['start_created_at']) ? $special_datetime = $special_datetime->where('special_datetime.created_at', '>=', $request_special_datetime['start_created_at'].' 00:00:00') : '';
        !empty($request_special_datetime['end_created_at']) ? $special_datetime = $special_datetime->where('special_datetime.created_at', '<=', $request_special_datetime['end_created_at'].' 23:59:59') : '';

        return $special_datetime;
    }

    public function addSpecialHour()
    {
        $model_special_datetime = $this->special_datetime;

        // Create array time slot
        $array_time_slot = array();
        $array_time_slot = $this->arrayTimeSlot();
        
    	return view('User.Admin.SpecialDateTime.add_special_time', [
            'model_special_datetime' => $model_special_datetime,
            'array_time_slot'        => $array_time_slot
    	]);
    }

    public function storeSpecialHour(Request $request)
    {
        $time_request = $request->get('time');
        if(!empty($datetime_request['time_slot_start'])){
            $datetime_request['time_slot_start'] = intval($datetime_request['time_slot_start']);
        }
        if(!empty($datetime_request['time_slot_end'])){
            $datetime_request['time_slot_end'] = intval($datetime_request['time_slot_end']);
        }
        $time_request['increase_price']  = preg_replace('/[^0-9]/', '', $time_request['increase_price']);

        $this->validatorSpecialTime($time_request)->validate();

        $model_special_datetime = $this->special_datetime;
        $model_time = $this->time;
        $array_time = array();
        for ($time=$time_request['time_slot_start']; $time <= $time_request['time_slot_end']; $time++) { 
            $isset_time = $model_special_datetime->where('id_time_slot', '=', $time)
                ->whereNull('date')->count();
            if($isset_time > 0){
                continue;
            }
            array_push($array_time, $time);
        }

        $name_route = 'admin.specialdatetime';
        // Return if array null
        if(empty($array_time)){
            return redirect()->route($name_route)
                ->with('error', 'Giờ bạn chọn đã tồn tại');
        }

        // Save all dates
        foreach ($array_time as $id_time_slot) {
            $time_slot = $model_time->where('id', '=', $id_time_slot)->first();
            $special_date                 = new SpecialDateTime();
            $special_date->id_time_slot   = $id_time_slot;
            $special_date->name_time_slot = $time_slot->name;
            $special_date->date           = null;
            $special_date->increase_price = $time_request['increase_price'];
            $special_date->status         = ACTIVE;
            $special_date->created_at     = Helper::getCurrentDateTime();
            $special_date->updated_at     = Helper::getCurrentDateTime();
            $special_date->save();
        }

        return redirect()->route($name_route)
            ->with('success', 'Bạn đã thêm mới khoảng thời gian tăng giá');
    }

    public function addSpecialDate()
    {
		$model_special_datetime = $this->special_datetime;
    	return view('User.Admin.SpecialDateTime.add_special_date', [
    		'model_special_datetime' => $model_special_datetime
    	]);
    }

    public function storeSpecialDate(Request $request)
    {
        $date_request = $request->get('date');
        $date_request['increase_price'] = preg_replace('/[^0-9]/', '', $date_request['increase_price']);

        $this->validatorSpecialDate($date_request)->validate();

        // Get all dates between two dates
        $model_special_datetime = $this->special_datetime;
        $model_date = $this->date;
        $array_date = array();
        $date_start = new \DateTime($date_request['date_start']);
        $interval   = new \DateInterval('P1D');
        $date_end   = new \DateTime($date_request['date_end']);
        $date_end->setTime(0,0,1);
        $date_period = new \DatePeriod($date_start, $interval, $date_end);
        foreach ($date_period as $date) {
            $date = $date->format('Y-m-d');
            $isset_date = $model_special_datetime->where('date', '=', $date)
                ->whereNull('id_time_slot')->count();
            if($isset_date > 0){
                continue;
            }
            array_push($array_date, $date);
        }


        $name_route = 'admin.specialdatetime';
        // Return if array null
        if(empty($array_date)){
            return redirect()->route($name_route)
                ->with('error', 'Ngày bạn chọn đã tồn tại');
        }


        // Save all dates
        foreach ($array_date as $value_date) {
            $special_date                 = new SpecialDateTime();
            $special_date->id_time_slot   = null;
            $special_date->name_time_slot = null;
            $special_date->date           = $value_date;
            $special_date->increase_price = $date_request['increase_price'];
            $special_date->status         = ACTIVE;
            $special_date->created_at     = Helper::getCurrentDateTime();
            $special_date->updated_at     = Helper::getCurrentDateTime();
            $special_date->save();
        }

        return redirect()->route($name_route)
            ->with('success', 'Bạn đã thêm mới khoảng thời gian tăng giá');
    }

    public function addSelectSpecialDateTime()
    {
        $model_special_datetime = $this->special_datetime;

        // Create array time slot
        $array_time_slot = array();
        $array_time_slot = $this->arrayTimeSlot();

    	return view('User.Admin.SpecialDateTime.add_special_datetime', [
            'model_special_datetime' => $model_special_datetime,
            'array_time_slot'        => $array_time_slot
    	]);
    }

    public function storeSpecialDateTime(Request $request)
    {
        $datetime_request = $request->get('datetime');
        if(!empty($datetime_request['time_slot_start'])){
            $datetime_request['time_slot_start'] = intval($datetime_request['time_slot_start']);
        }
        if(!empty($datetime_request['time_slot_end'])){
            $datetime_request['time_slot_end'] = intval($datetime_request['time_slot_end']);
        }
        $datetime_request['increase_price']  = preg_replace('/[^0-9]/', '', $datetime_request['increase_price']);
        
        $this->validatorSpecialDateTime($datetime_request)->validate();

        $model_special_datetime = $this->special_datetime;
        $model_time = $this->time;
        $model_date = $this->date;
        $array_time = array();
        $array_date = array();
        $array_datetime = array();
        $array_value_datetime = array();
        // Get all times between two times
        for ($time = $datetime_request['time_slot_start']; $time <= $datetime_request['time_slot_end']; $time++) {
            array_push($array_time, $time);
        }
        // Get all dates between two dates
        $date_start = new \DateTime($datetime_request['date_start']);
        $interval   = new \DateInterval('P1D');
        $date_end   = new \DateTime($datetime_request['date_end']);
        $date_end->setTime(0,0,1);
        $date_period = new \DatePeriod($date_start, $interval, $date_end);
        foreach ($date_period as $date) {
            $date = $date->format('Y-m-d');
            array_push($array_date, $date);
        }

        foreach ($array_date as $date) {
            foreach ($array_time as $time) {
                $isset_datetime = $model_special_datetime->where('date', '=', $date)
                    ->where('id_time_slot', '=', $time)->count();
                if($isset_datetime > 0){
                    continue;
                }
                $array_value_datetime = array(
                    'date'         => $date,
                    'id_time_slot' => $time,
                );
                array_push($array_datetime, $array_value_datetime);
            }
        }

        $name_route = 'admin.specialdatetime';
        // Return if array null
        if(empty($array_datetime)){
            return redirect()->route($name_route)
                ->with('error', 'Khoảng thời gian bạn chọn đã tồn tại');
        }

        // Save all dates
        foreach ($array_datetime as $datetime) {
            $time_slot = $model_time->where('id', '=', $datetime['id_time_slot'])->first();
            $special_date                 = new SpecialDateTime();
            $special_date->id_time_slot   = $time_slot->id;
            $special_date->name_time_slot = $time_slot->name;
            $special_date->date           = $datetime['date'];
            $special_date->increase_price = $datetime_request['increase_price'];
            $special_date->status         = ACTIVE;
            $special_date->created_at     = Helper::getCurrentDateTime();
            $special_date->updated_at     = Helper::getCurrentDateTime();
            $special_date->save();
        }

        return redirect()->route($name_route)
            ->with('success', 'Bạn đã thêm mới khoảng thời gian tăng giá');
    }

    public function edit($id)
    {
        $model_special_datetime = $this->special_datetime;
        $special_datetime       = $model_special_datetime->find($id);
        $type_special_datetime  = '';

        // Create array time slot
        $array_time_slot = array();
        $array_time_slot = $this->arrayTimeSlot();

        if(!empty($special_datetime->id_time_slot) && !empty($special_datetime->date))
        {
            $type_special_datetime = ENOUGH;
        }
        elseif(!empty($special_datetime->id_time_slot))
        {
            $type_special_datetime = EMPTY_HOUR;
        }
        elseif(!empty($special_datetime->date))
        {
            $type_special_datetime = EMPTY_DATE;
        }

        return view('User.Admin.SpecialDateTime.edit', [
            'special_datetime'       => $special_datetime,
            'type_special_datetime'  => $type_special_datetime,
            'array_time_slot'        => $array_time_slot,
            'model_special_datetime' => $model_special_datetime,
        ]);
    }

    public function update($id, Request $request)
    {
        $model_special_datetime   = $this->special_datetime;
        $model_detail_bill        = $this->detail_bill;
        $special_datetime_request = $request->special_datetime;
        $name_route               = 'admin.specialdatetime.edit';
        $isset_special_datetime_in_bill = false;
        $isset_special_datetime         = false;

        $special_datetime_request['increase_price']  = preg_replace('/[^0-9]/', '', $special_datetime_request['increase_price']);

        switch ($special_datetime_request['type_special_datetime']) {
            case ENOUGH:
                $this->validatorEditSpecialDateTime($special_datetime_request)->validate();
                break;
            case EMPTY_HOUR:
                $this->validatorEditSpecialTime($special_datetime_request)->validate();
                break;
            case EMPTY_DATE:
                $this->validatorEditSpecialDate($special_datetime_request)->validate();
                break;
            
            default:
                return redirect()->route($name_route, ['id' => $id])
                ->with('error', 'Xảy ra lỗi vui lòng thử lại');
        }
            
        $special_datetime = $model_special_datetime->find($id);
        $special_datetime_request['special_datetime'] = $special_datetime;

        // Check isset time slot in bill
        $isset_special_datetime_in_bill = $this->checkDataRequestIssetSpecialDateTime($special_datetime_request);
        $isset_special_datetime = $this->checkSameSpecialDateTime($special_datetime_request);

        // Get pitch
        if(!$isset_special_datetime && !$isset_special_datetime_in_bill)
        {
            if(!empty($special_datetime_request['time_slot']))
            {
                $model_time = $this->time;
                $time_slot  = $model_time->find($special_datetime_request['time_slot']);

                $special_datetime->id_time_slot   = $special_datetime_request['time_slot'];
                $special_datetime->name_time_slot = $time_slot->name;
            }
            if(!empty($special_datetime_request['date']))
            {
                $special_datetime->date           = $special_datetime_request['date'];
            }
            $special_datetime->increase_price = $special_datetime_request['increase_price'];
            $special_datetime->status         = $special_datetime_request['status'];
            $special_datetime->updated_at     = Helper::getCurrentDateTime();
            $special_datetime->save();

            return redirect()->route($name_route, ['id' => $id])
                ->with('success', 'Bạn đã sửa khoảng thời gian tăng giá');
        }

        return redirect()->route($name_route, ['id' => $id])
                ->with('error', 'Khoảng thời gian đã được sử dụng, không thể chỉnh sửa');
    }

    public function delete($id)
    {
        $model_special_datetime = $this->special_datetime;
        $isset_special_datetime = false;
        $name_route  = 'admin.specialdatetime';

        $special_datetime = $model_special_datetime->find($id);

        // Check isset special date time in bill
        $isset_special_datetime = $this->checkIssetSpecialDateTime($special_datetime);
        if(!$isset_special_datetime)
        {
            $special_datetime->delete();

            return redirect()->route($name_route)
                ->with('success', 'Bạn đã xóa sân bóng');
        }

        return redirect()->route($name_route)
            ->with('error', 'Khoảng thời gian tăng giá đã được sử dụng, không thể xóa');
    }

    public function arrayTimeSlot()
    {
        $model_time      = $this->time;
        $array_time_slot = array();

        $time_slots = $model_time->all();
        foreach ($time_slots as $time_slot) {
            $array_time_slot[$time_slot->id] = $time_slot->name;
        }

        return $array_time_slot;
    }

    public function checkIssetSpecialDateTime($special_datetime)
    {
        $model_detail_bill      = $this->detail_bill;
        $isset_special_datetime = false;
        $detail_bill = '';

        if(!empty($special_datetime->id_time_slot) && !empty($special_datetime->date))
        {
            $detail_bill = $model_detail_bill->where('id_time_slot', $special_datetime->id_time_slot)
                ->where('soccer_day', $special_datetime->date)
                ->where('created_at', '>=', $special_datetime->created_at)
                ->first();
        }
        elseif(!empty($special_datetime->id_time_slot))
        {
            $detail_bill = $model_detail_bill->where('id_time_slot', $special_datetime->id_time_slot)
                ->where('created_at', '>=', $special_datetime->created_at)
                ->first();
        }
        elseif(!empty($special_datetime->date))
        {
            $detail_bill = $model_detail_bill->where('soccer_day', $special_datetime->date)
                ->where('created_at', '>=', $special_datetime->created_at)
                ->first();
        }

        $isset_special_datetime = !empty($detail_bill) ? true : false;

        return $isset_special_datetime;
    }

    public function checkDataRequestIssetSpecialDateTime(array $data_request)
    {
        $model_detail_bill      = $this->detail_bill;
        $isset_special_datetime = false;
        $special_datetime       = $data_request['special_datetime'];
        $detail_bill = '';

        if(!empty($data_request['time_slot']) && !empty($data_request['date']))
        {
            $detail_bill = $model_detail_bill->where('id_time_slot', $data_request['time_slot'])
                ->where('soccer_day', $data_request['date'])
                ->where('created_at', '>=', $special_datetime->created_at)
                ->first();
        }
        elseif(!empty($data_request['time_slot']))
        {
            $detail_bill = $model_detail_bill->where('id_time_slot', $data_request['time_slot'])
                ->where('created_at', '>=', $special_datetime->created_at)
                ->first();
        }
        elseif(!empty($data_request['date']))
        {
            $detail_bill = $model_detail_bill->where('soccer_day', $data_request['date'])
                ->where('created_at', '>=', $special_datetime->created_at)
                ->first();
        }

        $isset_special_datetime = !empty($detail_bill) ? true : false;

        return $isset_special_datetime;
    }

    public function checkSameSpecialDateTime(array $data_request)
    {
        $model_special_datetime  = $this->special_datetime;
        $isset_special_datetime  = false;
        $special_datetime        = $data_request['special_datetime'];
        $detail_special_datetime = '';

        if(!empty($data_request['time_slot']) && !empty($data_request['date']))
        {
            $detail_special_datetime = $model_special_datetime->where('id_time_slot', $data_request['time_slot'])
                ->where('date', $data_request['date'])
                ->where('id', '!=', $special_datetime->id)
                ->first();
        }
        elseif(!empty($data_request['time_slot']))
        {
            $detail_special_datetime = $model_special_datetime->where('id_time_slot', $data_request['time_slot'])
                ->where('id', '!=', $special_datetime->id)
                ->first();
        }
        elseif(!empty($data_request['date']))
        {
            $detail_special_datetime = $model_special_datetime->where('date', $data_request['date'])
                ->where('id', '!=', $special_datetime->id)
                ->first();
        }

        $isset_special_datetime = !empty($detail_special_datetime) ? true : false;

        return $isset_special_datetime;
    }


    private $array_validate = [
        'increase_price' => ['required', 'string', 'min:5', 'max:7'],
    ];

    private $array_validate_edit = [
        'increase_price' => ['required', 'string', 'min:5', 'max:7'],
        'status'         => ['required', 'string', 'min:1', 'max:1'],
    ];

    private function validatorSpecialDate(array $data)
    {
        $array_validate = $this->array_validate;
        $array_validate['date_start'] = ['required', 'date_format:Y-m-d'];
        $array_validate['date_end']   = ['required', 'date_format:Y-m-d', 'after_or_equal:date_start'];
        return Validator::make($data, $array_validate, $this->messages());
    }

    private function validatorSpecialTime(array $data)
    {
        $array_validate = $this->array_validate;
        $array_validate['time_slot_start'] = ['required', 'integer'];
        $array_validate['time_slot_end']   = ['required', 'integer', 'gte:time_slot_start'];
        return Validator::make($data, $array_validate, $this->messages());
    }

    private function validatorSpecialDateTime(array $data)
    {
        $array_validate = $this->array_validate;
        $array_validate['date_start']      = ['required', 'date_format:Y-m-d'];
        $array_validate['date_end']        = ['required', 'date_format:Y-m-d', 'after_or_equal:date_start'];
        $array_validate['time_slot_start'] = ['required', 'integer'];
        $array_validate['time_slot_end']   = ['required', 'integer', 'gte:time_slot_start'];
        return Validator::make($data, $array_validate, $this->messages());
    }

    private function validatorEditSpecialDate(array $data)
    {
        $array_validate_edit = $this->array_validate_edit;
        $array_validate_edit['date'] = ['required', 'date_format:Y-m-d'];
        return Validator::make($data, $array_validate_edit, $this->messages());
    }

    private function validatorEditSpecialTime(array $data)
    {
        $array_validate_edit = $this->array_validate_edit;
        $array_validate_edit['time_slot'] = ['required', 'integer'];
        return Validator::make($data, $array_validate_edit, $this->messages());
    }

    private function validatorEditSpecialDateTime(array $data)
    {
        $array_validate_edit = $this->array_validate_edit;
        $array_validate_edit['date']      = ['required', 'date_format:Y-m-d'];
        $array_validate_edit['time_slot'] = ['required', 'integer'];
        return Validator::make($data, $array_validate_edit, $this->messages());
    }

    private function messages()
    {
        return [
            'required'    => 'Không được để trống',
            'string'      => 'Sai định dạng',
            'max'         => 'Sai định dạng, dài hơn :max ký tự',
            'min'         => 'Sai định dạng, ngắn hơn :min ký tự',
            'date_format' => 'Sai định dạng',
            'status.max'       => 'Sai định dạng',
            'status.min'       => 'Sai định dạng',
            'date_special.max' => 'Sai định dạng',
            'date_special.min' => 'Sai định dạng',
            'date_end.after_or_equal' => 'Ngày không hợp lệ',
            'time_slot_end.gte'       => 'Giờ không hợp lệ',
        ];
    }
}
