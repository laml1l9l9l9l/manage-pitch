<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
    	return view('User.Admin.Profile.index');
    }

    public function logout()
    {
    	return redirect()->route('admin.login');
    }
}
