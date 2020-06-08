<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Exception;

class LoginController extends CustomerController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct(Customer $customer)
    {
        $this->middleware('guest');
        $this->customer = $customer;
    }

    public function index()
    {
    	return view('NotUser.Customer.login');
    }

    public function login(Request $request)
    {
    	$request_customer = $request->customer;
        $this->validateLogin($request_customer)->validate();
        $model_customer = $this->customer;
        $request_customer['password'] = $model_customer->buildPassCustomer($request_customer['password']);

        $user = $this->getUser($request_customer);
            

        if (!empty($user)) {
            $this->createSessionLogin($user, $request);

            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
        }

        return $this->customSendFailedLoginResponse($request_customer);
    }

    public function ajaxLogin(Request $request)
    {
        try
        {
            $request_customer = $request->only('email', 'password');;
            $model_customer = $this->customer;
            $request_customer['password'] = $model_customer->buildPassCustomer($request_customer['password']);

            $user = $this->getUser($request_customer);
            

            if (!empty($user)) {
                $this->createSessionLogin($user, $request);

                return response()->json([
                    'success' => 'Đăng nhập thành công',
                    '_token'  => csrf_token()
                ]);
            }

            return response()->json([
                'error' => 'Bạn nhập sai email hoặc mật khẩu'
            ]);
        }
        catch(Exception $e)
        {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function customSendFailedLoginResponse($request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.custom_failed')],
        ]);
    }

    protected function getUser($request_customer)
    {
        $user = $this->customer->where('email','=',$request_customer['email'])
            ->where('password','=',$request_customer['password'])
            ->first();

        return $user;
    }

    protected function createSessionLogin($user,Request $request)
    {
        $this->guard()->login($user);
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
    }

    private function validateLogin(array $data)
    {
        return Validator::make($data, [
            'email'    => ['required', 'regex:/^\w+([\.\-]{0,1}\w+)*\@\w+\..+$/i'],
            'password' => ['required', 'string', 'min:6', 'max:60']
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
