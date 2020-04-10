<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Model\Admin\GroupMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(GroupMenu $group_menu)
    {
        $this->group_menu = $group_menu;
    }

    public function index()
    {
        $model_group_menu = $this->group_menu;

        $group_menu = $model_group_menu->paginate(5);

    	return view('User.Admin.Menu.index', [
            'group_menu' => $group_menu
        ]);
    }

    public function add()
    {
    	return view('User.Admin.Menu.add');
    }

    public function store(Request $request)
    {
    	$menu_request = $request->get('menu');
    }
}
