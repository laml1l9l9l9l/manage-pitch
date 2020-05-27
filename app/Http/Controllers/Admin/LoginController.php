<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/manager';

    public function __construct(Admin $admin)
    {
        $this->middleware('logged.auth');
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

        $credentials = $request->only('email', 'password');

        $user = $this->admin->where('email','=',$credentials['email'])
            ->where('password','=',$credentials['password'])
            ->first();
            

        if (!empty($user)) {
            $this->guard()->login($user);
            $request->session()->regenerate();

            $this->clearLoginAttempts($request);

            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
            // return redirect()->route('admin.home');
        }

        return $this->customSendFailedLoginResponse($request);
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

    protected function guard()
    {
        return \Auth::guard('admin');
    }
}
