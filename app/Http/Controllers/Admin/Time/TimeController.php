<?php

namespace App\Http\Controllers\Admin\Time;

use App\Http\Controllers\Controller;
use App\Model\Admin\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function __construct(Time $time)
    {
		$this->time = $time;
    }

    public function index(Request $request)
    {
    	return view('User.Admin.Time.index');
    }

    public function add()
    {
        $model_time = $this->time;
    	return view('User.Admin.Time.add', [
    		'model_time' => $model_time
    	]);
    }

}
