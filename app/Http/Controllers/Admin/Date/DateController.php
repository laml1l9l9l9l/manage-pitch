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
		$model_date = $this->date;
		
		$offset     = 10;
		$start_page = 1;
		$page       = $request->get('page');
		$page_date  = $this->indexTable($page, $offset);

        $dates = $model_date->orderBy('date', 'desc')->paginate($offset);
        $dates->setPath(URL::current());

    	return view('User.Admin.Date.index',[
			'dates'      => $dates,
			'model_date' => $model_date,
			'page_date'  => $page_date
    	]);
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
        $array_date = array();
        $date_period = new \DatePeriod(
             new \DateTime($date_request['date_start']),
             new \DateInterval('P1D'),
             new \DateTime($date_request['date_end'])
        );
        foreach ($date_period as $date) {
            $date = $date->format('Y-m-d');
            array_push($array_date, $date);
        }
        // Add date end to array
        array_push($array_date, $date_request['date_end']);


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

        return redirect()->route('admin.date')
            ->with('success', 'Bạn đã thêm mới khoảng thời gian');
    }


    private $array_validate = [
        'name'       => ['required', 'string', 'min:2', 'max:25'],
        'date_start' => ['required', 'date_format:Y-m-d'],
        'date_end'   => ['required', 'date_format:Y-m-d'],
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
			'date_special.max' => 'Sai định dạng',
			'date_special.min' => 'Sai định dạng',
        ];
    }

}
