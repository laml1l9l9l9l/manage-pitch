<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function index()
    {
    	return view('NotUser.Admin.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        $model_admin = $this->admin;
        $request['password'] = $model_admin->buildPassLender($request['password']);
        $this->customLogin($request);
    }

    private function validateLogin(Request $request)
    {
        $request->validate([
			'email'    => 'required|regex:/^\w+([\.\-]{0,1}\w+)*\@\w+\..+$/i',
			'password' => 'required|string|min:6|max:60',
        ], $this->messages());
    }

    private function messages()
    {
        return [
			'required'     => 'Không được để trống',
			'string'       => 'Sai định dạng',
			'email.regex'  => 'Email định dạng',
			'password.max' => 'Mật khẩu dài hơn :max ký tự',
			'password.min' => 'Mật khẩu ngắn hơn :min ký tự',
        ];
    }
}
