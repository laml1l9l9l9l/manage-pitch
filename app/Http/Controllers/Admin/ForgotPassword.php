<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;

class ForgotPassword extends Controller
{
    public function index()
    {
    	return view('NotUser.Admin.forgot_password');
    }
}
