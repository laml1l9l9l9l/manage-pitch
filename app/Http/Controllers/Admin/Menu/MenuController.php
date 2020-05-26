<?php

namespace App\Http\Controllers\Admin\Menu;

use App\Http\Controllers\Controller;
use App\Model\Admin\Menu;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Validator;

class MenuController extends Controller
{
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index(Request $request)
    {
        $model_menu       = $this->menu;

        $offset          = 5;
        $start_page      = 1;
        $page            = $request->get('page_menu');
        $page_menu       = $this->indexTable($page, $offset);

        $menu = $model_menu->paginate($offset, ['*'], 'page_menu');
        $menu->setPath(URL::current());

    	return view('User.Admin.Menu.index', [
            'menu'                    => $menu,
            'model_menu'              => $model_menu,
            'page_menu'               => $page_menu
        ]);
    }

    public function add()
    {
        $model_menu = $this->menu;

        $menu = $model_menu->get();
    	return view('User.Admin.Menu.add', [
            'menu'   => $menu,
        ]);
    }

    public function store(Request $request)
    {
    	$menu_request = $request->get('menu');

        // if(isset($menu_request['checkbox_relevant_menu']))
        // {
        //     $this->validatorRelevantMenu($menu_request)->validate();
        // }
        if($menu_request['level'] == MENU)
        {
            $this->validatorIndexMenu($menu_request)->validate();
        }
        elseif($menu_request['level'] == SUB_MENU)
        {
            $menu_request['icon'] = $menu_request['sub_name'];
            $this->validatorIndexSubMenu($menu_request)->validate();
        }
        else
        {
            return redirect()->route('admin.menu.add')
                ->with('error', 'Bạn phải chọn đúng loại menu');
        }

        $menu   = $this->menu;

        $menu->name           = $menu_request['name'];
        $menu->link           = $menu_request['link'];
        $menu->level_menu     = $menu_request['level'];
        $menu->icon           = $menu_request['icon'];
        $menu->index_menu     = $menu_request['index_menu'];
        // $menu->sub_name       = $menu_request['sub_name'];
        $menu->index_sub_menu = $menu_request['index_sub_menu'];
        // $menu->id_group_menu  = $menu_request['group_menu'];
        // $menu->relevant_menu  = $menu_request['relevant_menu'];
        $menu->created_at     = Helper::getCurrentDateTime();
        $menu->updated_at     = Helper::getCurrentDateTime();
        $menu->save();

        return redirect()->route('admin.menu')
            ->with('success', 'Bạn đã thêm mới một menu');
    }


    private $array_validate = [
        'name'  => ['required', 'string', 'min:2', 'max:25'],
        'link'  => ['required', 'string', 'min:2', 'max:50'],
        'level' => ['required', 'string', 'min:1', 'max:3'],
    ];

    private function validatorIndexMenu(array $data)
    {
        $array_validate               = $this->array_validate;
        $array_validate['icon']       = ['required', 'string', 'min:2', 'max:25'];
        $array_validate['index_menu'] = ['required', 'string', 'min:1', 'max:3'];
        return Validator::make($data, $array_validate, $this->messages());
    }

    private function validatorIndexSubMenu(array $data)
    {
        $array_validate                   = $this->array_validate;
        $array_validate['sub_name']       = ['required', 'string', 'min:1', 'max:4'];
        $array_validate['index_sub_menu'] = ['required', 'string', 'min:1', 'max:3'];
        return Validator::make($data, $array_validate, $this->messages());
    }

    private function validatorRelevantMenu(array $data)
    {
        return Validator::make($data, [
            'name'          => ['required', 'string', 'min:2', 'max:25'],
            'link'          => ['required', 'string', 'min:2', 'max:50'],
            // 'relevant_menu' => ['required','string', 'min:1', 'max:3'],
            // 'group_menu'    => ['required','string', 'min:1', 'max:3'],
        ], $this->messages());
    }

    private function messages()
    {
        return [
            'required'               => 'Không được để trống',
            'string'                 => 'Sai định dạng',
            'name.max'               => 'Tên dài hơn :max ký tự',
            'name.min'               => 'Tên ngắn hơn :min ký tự',
            'max'                    => 'Sai định dạng, dài hơn :max ký tự',
            'min'                    => 'Sai định dạng, dài hơn :max ký tự',
            // 'relevant_menu.required' => 'Phải chọn menu liên quan',
            // 'group_menu.required'    => 'Phải chọn nhóm menu',
        ];
    }
}
