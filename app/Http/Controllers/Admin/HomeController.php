<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Bill;
use App\Model\Admin\Customer;
use App\Model\Admin\Pitch;
use App\Model\Admin\Time;
use App\Model\Admin\Date;
use App\Model\Admin\SpecialDateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(Bill $bill, Customer $customer, Pitch $pitch, Time $time, Date $date, SpecialDateTime $special_date_time)
    {
        $this->bill     = $bill;
        $this->customer = $customer;
        $this->pitch    = $pitch;
        $this->time     = $time;
        $this->date     = $date;
        $this->special_date_time = $special_date_time;
    }

    public function home()
    {
        $bill_statistical       = $this->statisticalBill();
        $customer_statistical   = $this->statisticalCustomer();
        $pitch_statistical      = $this->statisticalPitch();
        $time_slots_statistical = $this->statisticalTimeSlots();
        $date_statistical       = $this->statisticalDate();
        $special_date_time_statistical = $this->statisticalSpecialDateTime();

    	return view('User.Admin.home', [
            'bill_statistical'       => $bill_statistical,
            'customer_statistical'   => $customer_statistical,
            'pitch_statistical'      => $pitch_statistical,
            'time_slots_statistical' => $time_slots_statistical,
            'date_statistical'       => $date_statistical,
            'special_date_time_statistical' => $special_date_time_statistical,
    	]);
    }

    public function statisticalBill()
    {
        $statistical      = array();
        $count            = 0;
        $percent          = 0;
        $percent_status   = DECREASE;
        $amount_unpaid    = 0;
        $amount_deposited = 0;
        $amount_paid      = 0;

    	$model_bill = $this->bill;

        $count           = $model_bill->count();
        $count_unpaid    = $model_bill->where('status', UNPAID)->count();
        $count_deposited = $model_bill->where('status', DEPOSITED)->count();
        $count_paid      = $model_bill->where('status', PAID)->count();

    	// percent
        $current_month = date('m'); 
        $last_month    = date('m', strtotime('-1 months')); 
        $count_current_month = $model_bill->whereMonth('created_at', '=', $current_month)->count();
        $count_last_month    = $model_bill->whereMonth('created_at', '=', $last_month)->count();

        if($count_current_month == $count_last_month)
        {
            $percent_status = KEEP_STABLE;
        }
        else{
            $percent = $count_last_month ? $this->percent($count_current_month, $count_last_month) : null;
            if($count_current_month > $count_last_month)
            {
                $percent_status = INCREASE;
            }
        }
        $color_statistical = $model_bill->class_color_status_statistical[$percent_status];

        // Count money
        $bill_unpaids    = $model_bill->where('status', UNPAID)->get();
        $bill_depositeds = $model_bill->where('status', DEPOSITED)->get();
        $bill_paids      = $model_bill->where('status', PAID)->get();
        foreach ($bill_unpaids as $bill_unpaid) {
            $amount_unpaid += $bill_unpaid->into_money;
        }
        foreach ($bill_depositeds as $bill_deposited) {
            $amount_deposited += $bill_deposited->into_money;
        }
        foreach ($bill_paids as $bill_paid) {
            $amount_paid += $bill_paid->into_money;
        }

    	$statistical = array(
            'count'             => $count,
            'percent'           => $percent,
            'percent_status'    => $percent_status,
            'count_unpaid'      => $count_unpaid,
            'count_deposited'   => $count_deposited,
            'count_paid'        => $count_paid,
            'color_statistical' => $color_statistical,
            'amount_unpaid'     => $amount_unpaid,
            'amount_deposited'  => $amount_deposited,
            'amount_paid'       => $amount_paid,
    	);

    	return $statistical;
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
            'count'        => $count,
            'count_acitve' => $count_acitve,
            'count_lock'   => $count_lock,
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
            'count'        => $count,
            'count_acitve' => $count_acitve,
            'count_lock'   => $count_lock,
        );

        return $statistical;
    }

    public function statisticalDate()
    {
        $statistical = array();
        $count = 0;
        $model_date = $this->date;
        
        $count        = $model_date->count();
        $count_acitve = $model_date->where('status', ACTIVE)->count();
        $count_lock   = $model_date->where('status', LOCK)->count();

        $statistical = array(
            'count'        => $count,
            'count_acitve' => $count_acitve,
            'count_lock'   => $count_lock,
        );

        return $statistical;
    }

    public function statisticalSpecialDateTime()
    {
        $statistical = array();
        $count = 0;
        $model_special_date_time = $this->special_date_time;
        
        $count        = $model_special_date_time->count();
        $count_acitve = $model_special_date_time->where('status', ACTIVE)->count();
        $count_lock   = $model_special_date_time->where('status', LOCK)->count();

        $statistical = array(
            'count'        => $count,
            'count_acitve' => $count_acitve,
            'count_lock'   => $count_lock,
        );

        return $statistical;
    }

    public function percent($final, $initial)
    {
        $result = abs($final - $initial) / $initial * 100;
        return $result;
    }
}
