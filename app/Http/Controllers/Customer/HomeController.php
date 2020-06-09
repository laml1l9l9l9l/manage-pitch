<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Model\Customer\Pitch;
use App\Model\Customer\Time;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(Pitch $pitch, Time $time)
    {
		$this->pitch = $pitch;
		$this->time  = $time;
    }

    public function home()
    {
		$model_pitch = $this->pitch;
		$model_time  = $this->time;

		$pitchs     = $model_pitch->get();
		$time_slots = $model_time->get();

    	return view('User.Customer.home',[
			'model_pitch' => $model_pitch,
			'model_time'  => $model_time,
			'pitchs'      => $pitchs,
			'time_slots'  => $time_slots
    	]);
    }
}
