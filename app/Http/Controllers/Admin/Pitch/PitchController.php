<?php

namespace App\Http\Controllers\Admin\Pitch;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    public function index()
    {
    	return view('User.Admin.Pitch.index');
    }

}
