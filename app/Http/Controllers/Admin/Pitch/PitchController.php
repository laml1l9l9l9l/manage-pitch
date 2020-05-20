<?php

namespace App\Http\Controllers\Admin\Pitch;

use App\Http\Controllers\Controller;
use App\Model\Admin\Menu;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    public function index()
    {
    	return view('User.Admin.Pitch.index');
    }

    public function add()
    {
        $model_menu = $this->menu;
    	return view('User.Admin.Pitch.add');
    }

    public function store()
    {
    	return view('User.Admin.Pitch.add');
    }

}
