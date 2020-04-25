<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Model\Admin\GroupMenu;
use App\Model\Helper;
use Illuminate\Http\Request;
use Validator;

class GroupMenuController extends Controller
{
    public function __construct(GroupMenu $group_menu, Helper $helper)
    {
        $this->group_menu = $group_menu;
        $this->helper     = $helper;
    }

    public function add()
    {
    	return view('User.Admin.GroupMenu.add');
    }

    public function store(Request $request)
    {
    	$group_menu_request = $request->get('group_menu');

    	$this->validator($group_menu_request)->validate();

        $group_menu = $this->group_menu;
        $helper     = $this->helper;

        $group_menu->name       = $group_menu_request['name'];
        $group_menu->created_at = $helper->getCurrentDateTime();
        $group_menu->updated_at = $helper->getCurrentDateTime();
        $group_menu->save();

        return redirect()->route('admin.menu')
            ->with('success', 'Bạn đã thêm mới một nhóm cho menu');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required','string', 'min:2', 'max:25'],
        ], $this->messages());
    }

    protected function messages()
    {
        return [
            'required' => 'Không được để trống',
            'string'   => 'Sai định dạng',
            'name.max' => 'Tên dài hơn :max ký tự',
            'name.min' => 'Tên ngắn hơn :min ký tự'
        ];
    }
}
