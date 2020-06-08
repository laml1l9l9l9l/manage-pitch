<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Customer;
use App\Model\Admin\Pitch;
use App\Model\Admin\Time;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(Customer $customer, Pitch $pitch, Time $time)
    {
        $this->customer = $customer;
        $this->pitch    = $pitch;
        $this->time     = $time;
    }

    public function home()
    {
        $customer_statistical   = $this->statisticalCustomer();
        $pitch_statistical      = $this->statisticalPitch();
        $time_slots_statistical = $this->statisticalTimeSlots();

    	return view('User.Admin.home', [
            'customer_statistical'   => $customer_statistical,
            'pitch_statistical'      => $pitch_statistical,
            'time_slots_statistical' => $time_slots_statistical
    	]);
    }

    public function statisticalCustomer()
    {
    	$statistical = array();
    	$count = 0;
    	$percent = 0;
    	$percent_status = DECREASE;
    	$model_customer = $this->customer;

        $count        = $model_customer->count();
        $count_acitve = $model_customer->where('status', ACTIVE)->count();
        $count_lock   = $model_customer->where('status', LOCK)->count();

    	// account sign up percent
    	

    	$statistical = array(
            'count'          => $count,
            'percent'        => $percent,
            'percent_status' => $percent_status,
            'count_acitve'   => $count_acitve,
            'count_lock'     => $count_lock,
    	);

    	return $statistical;
    }

    public function statisticalPitch()
    {
        $statistical = array();
        $count = 0;
        $model_pitch = $this->pitch;

        $count        = $model_pitch->count();
        $count_acitve = $model_pitch->where('status', ACTIVE)->count();
        $count_lock   = $model_pitch->where('status', LOCK)->count();

        // account sign up percent
        

        $statistical = array(
            'count'          => $count,
            'count_acitve'   => $count_acitve,
            'count_lock'     => $count_lock,
        );

        return $statistical;
    }

    public function statisticalTimeSlots()
    {
        $statistical = array();
        $count = 0;
        $model_time = $this->time;

        $count        = $model_time->count();
        $count_acitve = $model_time->where('status', ACTIVE)->count();
        $count_lock   = $model_time->where('status', LOCK)->count();

        // account sign up percent
        

        $statistical = array(
            'count'          => $count,
            'count_acitve'   => $count_acitve,
            'count_lock'     => $count_lock,
        );

        return $statistical;
    }
}
