<?php

namespace App\Http\Controllers\Admin\SpecialDateTime;

use App\Http\Controllers\Controller;
use App\Model\Admin\SpecialDateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SpecialDateTimeController extends Controller
{
    public function __construct(SpecialDateTime $special_datetime)
    {
		$this->special_datetime = $special_datetime;
    }

    public function index(Request $request)
    {
		$model_special_datetime = $this->special_datetime;
		
		$offset     = 10;
		$start_page = 1;
		$page                  = $request->get('page');
		$page_special_datetime = $this->indexTable($page, $offset);

        $special_datetime = $model_special_datetime->paginate($offset);
        $special_datetime->setPath(URL::current());

    	return view('User.Admin.SpecialDateTime.index',[
			'special_datetime'       => $special_datetime,
			'model_special_datetime' => $model_special_datetime,
			'page_special_datetime'  => $page_special_datetime
    	]);
    }

    public function addSpecialHour()
    {
		$model_special_datetime = $this->special_datetime;
    	return view('User.Admin.Time.add', [
    		'model_special_datetime' => $model_special_datetime
    	]);
    }

    public function addSpecialDate()
    {
		$model_special_datetime = $this->special_datetime;
    	return view('User.Admin.SpecialDateTime.add_special_date', [
    		'model_special_datetime' => $model_special_datetime
    	]);
    }

    public function addSelectSpecialDateTime()
    {
        $model_time = $this->time;
    	return view('User.Admin.Time.add', [
    		'model_time' => $model_time
    	]);
    }
}
