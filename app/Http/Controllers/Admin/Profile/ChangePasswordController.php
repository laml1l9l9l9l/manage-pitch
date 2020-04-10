<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function changePassword()
    {
    	return view('User.Admin.Profile.change_password');
    }

}
