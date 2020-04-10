<?php

namespace App\Http\Controllers\Admin\Time;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index()
    {
    	return view('User.Admin.Time.index');
    }

}
