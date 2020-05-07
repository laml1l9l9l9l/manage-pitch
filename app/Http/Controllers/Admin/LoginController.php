<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    protected $redirectTo = '/manager';

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

        $credentials = array(
            'email' => $request['email'],
            'password' => $request['password'],
        );

        dd(Auth::guard('')->attempt($credentials));

        if ($this->attemptLoginAdmin($request)) {
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            return redirect()->route('admin.home');
        }

        return $this->customSendFailedLoginResponse($request);
    }

    protected function attemptLoginAdmin(Request $request)
    {
        $credentials = array(
            'email' => $request['email'],
            'password' => $request['password'],
        );
        return $this->guardAdmin()->attempt(
            $credentials, false
        );
    }

    protected function customSendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.custom_failed')],
        ]);
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

    protected function guardAdmin()
    {
        return Auth::guard('');
    }
}
