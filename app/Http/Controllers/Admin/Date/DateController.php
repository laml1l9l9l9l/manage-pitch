<?php

namespace App\Http\Controllers\Admin\Date;

use App\Http\Controllers\Controller;
use App\Model\Admin\Date;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;

class DateController extends Controller
{
    public function __construct(Date $date)
    {
		$this->date = $date;
    }

    public function index(Request $request)
    {
        $request_date = $request->date;
		$model_date = $this->date;
		
		$offset     = 10;
		$start_page = 1;
		$page       = $request->get('page');
		$page_date  = $this->indexTable($page, $offset);

        $dates = !empty($request_date) ? $this->search($request_date) : $model_date;
        $dates = $dates->orderBy('date', 'desc')->paginate($offset);
        $dates->setPath(URL::current());

    	return view('User.Admin.Date.index',[
            'dates'        => $dates,
            'model_date'   => $model_date,
            'page_date'    => $page_date,
            'request_date' => $request_date,
            'request'      => $request->all()
    	]);
    }

    public function search($request_date)
    {
        $dates = $this->date;

        !empty($request_date['name']) ? $dates = $dates->where('name', 'like', '%'.$request_date['name'].'%') : '';
        !empty($request_date['start_date']) ? $dates = $dates->where('date', '>=', $request_date['start_date'].' 00:00:00') : '';
        !empty($request_date['end_date']) ? $dates = $dates->where('date', '<=', $request_date['end_date'].' 23:59:59') : '';
        !empty($request_date['start_created_at']) ? $dates = $dates->where('created_at', '>=', $request_date['start_created_at'].' 00:00:00') : '';
        !empty($request_date['end_created_at']) ? $dates = $dates->where('created_at', '<=', $request_date['end_created_at'].' 23:59:59') : '';

        return $dates;
    }

    public function add()
    {
        $model_date = $this->date;
    	return view('User.Admin.Date.add', [
    		'model_date' => $model_date
    	]);
    }

    public function store(Request $request)
    {
		$date_request = $request->get('date');

        $this->validatorManually($date_request)->validate();

        // Get all dates between two dates
        $model_date = $this->date;
        $array_date = array();
        $date_start = new \DateTime($date_request['date_start']);
        $interval   = new \DateInterval('P1D');
        $date_end   = new \DateTime($date_request['date_end']);
        $date_end->setTime(0,0,1);
        $date_period = new \DatePeriod($date_start, $interval, $date_end);
        foreach ($date_period as $date) {
            $date = $date->format('Y-m-d');
            $isset_date = $model_date->where('date', '=', $date)
                ->where('status', '=', LOCK)
                ->count();
            if($isset_date > 0){
                continue;
            }
            array_push($array_date, $date);
        }
        

        $name_route = 'admin.date';
        // Return if array null
        if(empty($array_date)){
            return redirect()->route($name_route)
                ->with('error', 'Ngày bạn chọn đã tồn tại');
        }


        // Save all dates
        foreach ($array_date as $value_date) {
            $date             = new Date();
            $date->date       = $value_date;
            $date->name       = $date_request['name'];
            $date->status     = LOCK;
            $date->created_at = Helper::getCurrentDateTime();
            $date->updated_at = Helper::getCurrentDateTime();
            $date->save();
        }

        return redirect()->route($name_route)
            ->with('success', 'Bạn đã thêm mới khoảng thời gian');
    }

    public function edit($id)
    {
        $model_date = $this->date;
        $date       = $model_date->find($id);

        return view('User.Admin.Date.edit', [
            'date'       => $date,
            'model_date' => $model_date,
        ]);
    }

    public function update($id, Request $request)
    {
        $model_date = $this->date;
        $date_request = $request->date;

        $this->validatorEditDate($date_request)->validate();

        // Get pitch
        $date = $model_date->find($id);

        $date->name       = $date_request['name'];
        $date->date       = $date_request['date'];
        $date->status     = $date_request['status'];
        $date->updated_at = Helper::getCurrentDateTime();
        $date->save();

        return redirect()->route('admin.date.edit', ['id' => $id])
            ->with('success', 'Bạn đã sửa ngày nghỉ');
    }

    public function delete($id)
    {
        $model_date = $this->date;

        $date = $model_date->find($id);
        $date->delete();

        return redirect()->route('admin.date')
            ->with('success', 'Bạn đã xóa một ngày nghỉ');
    }


    private $array_validate = [
        'name'       => ['required', 'string', 'min:2', 'max:25'],
        'date_start' => ['required', 'date_format:Y-m-d'],
        'date_end'   => ['required', 'date_format:Y-m-d', 'after_or_equal:date_start'],
    ];

    private function validatorManually(array $data)
    {
        return Validator::make($data, $this->array_validate, $this->messages());
    }

    private function validatorIncreasePrice(array $data)
    {
    	$array_validate = $this->array_validate;
    	$array_validate['increase_price'] = ['required', 'string', 'min:5', 'max:7'];
        return Validator::make($data, $array_validate, $this->messages());
    }

    private function validatorEditDate(array $data)
    {
        return Validator::make($data, [
            'name'   => ['required', 'string', 'min:2', 'max:25'],
            'date'   => ['required', 'date_format:Y-m-d'],
            'status' => ['required', 'string', 'min:1', 'max:1'],
        ], $this->messages());
    }

    private function messages()
    {
        return [
            'required'                => 'Không được để trống',
            'string'                  => 'Sai định dạng',
            'max'                     => 'Sai định dạng, dài hơn :max ký tự',
            'min'                     => 'Sai định dạng, ngắn hơn :min ký tự',
            'status.max'              => 'Sai định dạng',
            'status.min'              => 'Sai định dạng',
            'date_format'             => 'Sai định dạng',
            'date_end.after_or_equal' => 'Ngày không hợp lệ',
            'date_special.max'        => 'Sai định dạng',
            'date_special.min'        => 'Sai định dạng',
        ];
    }

}
