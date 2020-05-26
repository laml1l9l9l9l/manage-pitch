<?php

namespace App\Http\Controllers\Admin\Time;

use App\Http\Controllers\Controller;
use App\Model\Admin\Time;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;

class TimeController extends Controller
{
    public function __construct(Time $time)
    {
		$this->time = $time;
    }

    public function index(Request $request)
    {
		$model_time = $this->time;
		
		$offset     = 5;
		$start_page = 1;
		$page       = $request->get('page');
		$page_time  = $this->indexTable($page, $offset);

        $time_slots = $model_time->paginate($offset);
        $time_slots->setPath(URL::current());

    	return view('User.Admin.Time.index',[
			'time_slots' => $time_slots,
			'model_time' => $model_time,
			'page_time'  => $page_time
    	]);
    }

    public function add()
    {
        $model_time = $this->time;
    	return view('User.Admin.Time.add', [
    		'model_time' => $model_time
    	]);
    }

    public function store(Request $request)
    {
		$time_request = $request->get('time');
		$time_request['increase_price'] = preg_replace('/[^0-9]/', '', $time_request['increase_price']);

        if($time_request['time_special'] == MANUALLY)
        {
            $this->validatorManually($time_request)->validate();
        }
        elseif($time_request['time_special'] == INCREASE_PRICE)
        {
            $this->validatorIncreasePrice($time_request)->validate();
        }
        else
        {
            return redirect()->route('admin.time.add')
                ->with('error', 'Bạn phải chọn đúng loại menu');
        }


        if ($time_request['time_special'] == MANUALLY) {
        	$time_request['increase_price'] = 0;
        }


		$time_slot                 = $this->time;
		$time_slot->time_start     = $time_request['time_start'];
		$time_slot->time_end       = $time_request['time_end'];
		$time_slot->name           = $time_request['name'];
		$time_slot->time_special   = $time_request['time_special'];
		$time_slot->increase_price = $time_request['increase_price'];
		$time_slot->status         = $time_request['status'];
		$time_slot->created_at     = Helper::getCurrentDateTime();
		$time_slot->updated_at     = Helper::getCurrentDateTime();
		$time_slot->save();

        return redirect()->route('admin.time')
            ->with('success', 'Bạn đã thêm mới khoảng thời gian');
    }


    private $array_validate = [
		'name'         => ['required', 'string', 'min:2', 'max:25'],
		'status'       => ['required', 'string', 'min:1', 'max:1'],
		'time_start'   => ['required', 'date_format:H:i'],
		'time_end'     => ['required', 'date_format:H:i', 'after:time_start'],
		'time_special' => ['required', 'string', 'min:1', 'max:1']
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

    private function messages()
    {
        return [
			'required'         => 'Không được để trống',
			'string'           => 'Sai định dạng',
			'max'              => 'Sai định dạng, dài hơn :max ký tự',
			'min'              => 'Sai định dạng, ngắn hơn :min ký tự',
			'status.max'       => 'Sai định dạng',
			'status.min'       => 'Sai định dạng',
			'date_format'      => 'Sai định dạng',
			'time_end.after'   => 'Ngày không hợp lệ',
			'time_special.max' => 'Sai định dạng',
			'time_special.min' => 'Sai định dạng',
        ];
    }
}
