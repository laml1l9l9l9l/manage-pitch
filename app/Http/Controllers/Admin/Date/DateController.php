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
		
		$offset     = 5;
		$start_page = 1;
		$page       = $request->get('page');
		$page_date  = $this->indexTable($page, $offset);

        $dates = $model_date->paginate($offset);
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
		$date_request['increase_price'] = preg_replace('/[^0-9]/', '', $date_request['increase_price']);

        if($date_request['date_special'] == MANUALLY)
        {
            $this->validatorManually($date_request)->validate();
        }
        elseif($date_request['date_special'] == INCREASE_PRICE)
        {
            $this->validatorIncreasePrice($date_request)->validate();
        }
        else
        {
            return redirect()->route('admin.date.add')
                ->with('error', 'Bạn phải chọn đúng loại menu');
        }


        if ($date_request['date_special'] == MANUALLY) {
        	$date_request['increase_price'] = 0;
        }


		$date                 = $this->date;
		$date->date           = $date_request['date'];
		$date->name           = $date_request['name'];
		$date->date_special   = $date_request['date_special'];
		$date->increase_price = $date_request['increase_price'];
		$date->status         = $date_request['status'];
		$date->created_at     = Helper::getCurrentDateTime();
		$date->updated_at     = Helper::getCurrentDateTime();
		$date->save();

        return redirect()->route('admin.date')
            ->with('success', 'Bạn đã thêm mới khoảng thời gian');
    }


    private $array_validate = [
		'name'         => ['required', 'string', 'min:2', 'max:25'],
		'status'       => ['required', 'string', 'min:1', 'max:1'],
		'date'         => ['required', 'date_format:Y-m-d'],
		'date_special' => ['required', 'string', 'min:1', 'max:1']
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
