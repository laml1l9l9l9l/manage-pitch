<?php

namespace App\Http\Controllers\Customer\API;

use App\Http\Controllers\Controller;
use App\Model\Customer\Date;
use Illuminate\Http\Request;

class DateOffController extends Controller
{
    public function __construct(Date $date)
    {
		$this->date = $date;
    }

    public function getAllDateOff()
    {
		$array_date_off = array();
		$model_date     = $this->date;
		$dates_off      = $model_date->where('status', LOCK)
    		->get();
    	foreach ($dates_off as $date_off) {
    		array_push($array_date_off, $date_off->date);
    	}

    	return json_encode($array_date_off);
    }
}
