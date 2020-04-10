<?php

namespace App\Http\Controllers\Admin\Date;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index()
    {
    	return view('User.Admin.Date.index');
    }

}
