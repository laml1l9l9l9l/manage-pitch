<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
    	return view('NotUser.Admin.login');
    }
}
