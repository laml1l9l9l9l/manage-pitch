<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Model\Admin\Menu;
use App\Model\Admin\GroupMenu;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;

class MenuController extends Controller
{
    public function __construct(GroupMenu $group_menu, Helper $helper, Menu $menu)
    {
        $this->menu       = $menu;
        $this->group_menu = $group_menu;
        $this->helper     = $helper;
    }

    public function index(Request $request)
    {
        $model_menu       = $this->menu;
        $model_group_menu = $this->group_menu;

        $offset     = 5;
        $start_page = 1;
        $page       = $request->get('page');
        if(empty($page))
        {
            $page = 1;
        }
        elseif($page > 1)
        {
            $page = ($page - 1) * $offset + 1;
        }


        $menu = $model_menu->paginate($offset);
        $menu->setPath(URL::current());

        $group_menu = $model_group_menu->paginate($offset);
        $group_menu->setPath(URL::current());

    	return view('User.Admin.Menu.index', [
            'menu'       => $menu,
            'model_menu' => $model_menu,
            'group_menu' => $group_menu,
            'page'       => $page
        ]);
    }

    public function add()
    {
        $model_group_menu = $this->group_menu;
        $helper           = $this->helper;

        $group_menu = $model_group_menu->get();
    	return view('User.Admin.Menu.add', [
            'group_menu' => $group_menu,
            'helper'     => $helper
        ]);
    }

    public function store(Request $request)
    {
    	$menu_request = $request->get('menu');

        if(isset($menu_request['checkbox_relevant_menu']))
        {
            $this->validatorRelevantMenu($menu_request)->validate();
        }
        elseif($menu_request['level'] == 0)
        {
            $this->validatorIndexMenu($menu_request)->validate();
        }
        elseif($menu_request['level'] == 1)
        {
            $this->validatorIndexSubMenu($menu_request)->validate();
        }
        else
        {
            return redirect()->route('admin.menu.add')
                ->with('error', 'Bạn phải chọn đúng loại menu');
        }

        $menu   = $this->menu;
        $helper = $this->helper;

        $menu->name           = $menu_request['name'];
        $menu->link           = $menu_request['link'];
        $menu->level_menu     = $menu_request['level'];
        $menu->icon           = $menu_request['icon'];
        $menu->index_menu     = $menu_request['index_menu'];
        $menu->sub_name       = $menu_request['sub_name'];
        $menu->index_sub_menu = $menu_request['index_sub_menu'];
        $menu->id_group_menu  = $menu_request['group_menu'];
        $menu->relevant_menu  = $menu_request['relevant_menu'];
        $menu->created_at     = $helper->getCurrentDateTime();
        $menu->updated_at     = $helper->getCurrentDateTime();
        $menu->save();

        return redirect()->route('admin.menu')
            ->with('success', 'Bạn đã thêm mới một menu');
    }

    protected function validatorIndexMenu(array $data)
    {
        return Validator::make($data, [
            'name'           => ['required','string', 'min:2', 'max:25'],
            'link'           => ['required','string', 'min:2', 'max:50'],
            'level'          => ['required','string', 'min:1', 'max:3'],
            'icon'           => ['required','string', 'min:2', 'max:25'],
            'index_menu'     => ['required','string', 'min:1', 'max:3'],
            'group_menu'     => ['required','string', 'min:1', 'max:3'],
        ], $this->messages());
    }

    protected function validatorIndexSubMenu(array $data)
    {
        return Validator::make($data, [
            'name'           => ['required','string', 'min:2', 'max:25'],
            'link'           => ['required','string', 'min:2', 'max:50'],
            'level'          => ['required','string', 'min:1', 'max:3'],
            'sub_name'       => ['required','string', 'min:2', 'max:3'],
            'index_sub_menu' => ['required','string', 'min:1', 'max:3'],
            'group_menu'     => ['required','string', 'min:1', 'max:3'],
        ], $this->messages());
    }

    protected function validatorRelevantMenu(array $data)
    {
        return Validator::make($data, [
            'name'          => ['required','string', 'min:2', 'max:25'],
            'link'          => ['required','string', 'min:2', 'max:50'],
            'relevant_menu' => ['required','string', 'min:1', 'max:3'],
            'group_menu'    => ['required','string', 'min:1', 'max:3'],
        ], $this->messages());
    }

    protected function messages()
    {
        return [
            'required'               => 'Không được để trống',
            'string'                 => 'Sai định dạng',
            'name.max'               => 'Tên dài hơn :max ký tự',
            'name.min'               => 'Tên ngắn hơn :min ký tự',
            'max'                    => 'Sai định dạng',
            'min'                    => 'Sai định dạng',
            'relevant_menu.required' => 'Phải chọn menu liên quan',
            'group_menu.required'    => 'Phải chọn nhóm menu',
        ];
    }
}
