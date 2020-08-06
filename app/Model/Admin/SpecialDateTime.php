<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class SpecialDateTime extends Model
{
    protected $table = 'special_datetime';

    public $status_model = array(
		ACTIVE => 'Hoạt động',
		LOCK   => 'Nghỉ'
    );

    public function getPriceSpecialDateTime($id_time_slot, $soccer_day)
    {
        $price_special_date_time  = array();
        $increase_price_date      = 0;
        $increase_price_time      = 0;
        $increase_price_date_time = 0;
        $model_special_datetime   = $this;

        $date = $model_special_datetime->where('date', '=', $soccer_day)
            ->whereNull('id_time_slot')
            ->where('status', ACTIVE)
            ->first();
        if(!empty($date)){
            $increase_price_date += $date->increase_price;
        }

        $time = $model_special_datetime->where('id_time_slot', '=', $id_time_slot)
            ->whereNull('date')
            ->where('status', ACTIVE)
            ->first();
        if(!empty($time)){
            $increase_price_time += $time->increase_price;
        }

        $datetime = $model_special_datetime->where('date', '=', $soccer_day)
            ->where('id_time_slot', '=', $id_time_slot)
            ->where('status', ACTIVE)
            ->first();
        if(!empty($datetime)){
            $increase_price_date_time += $datetime->increase_price;
        }

        $price_special_date_time  = array(
            'increase_price_date'      => $increase_price_date,
            'increase_price_time'      => $increase_price_time,
            'increase_price_date_time' => $increase_price_date_time,
        );

        return $price_special_date_time;
    }
}
