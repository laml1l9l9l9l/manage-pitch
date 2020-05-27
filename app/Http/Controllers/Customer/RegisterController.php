<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Model\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = '/';

	public function __construct(Customer $customer)
	{
        $this->middleware('guest');
		$this->customer = $customer;
	}

    public function index()
    {
    	return view('NotUser.Customer.register');
    }

    public function register(Request $request)
    {
    	$customer_request = $request['customer'];
        $this->validator($customer_request)->validate();

        event(new Registered($user = $this->create($customer_request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function guard()
    {
        return Auth::guard('');
    }
    
    protected function registered(Request $request, $user)
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255', 'min: 5'],
            'email'    => ['required', 'string', 'max:255', 'min: 5', 'regex:/^\w+([\.\-]{0,1}\w+)*\@\w+\..+$/i', 'unique:customers'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:5']
        ], $this->messages());
    }

    public function messages()
	{
	    return [
            'required'      => 'Không được để trống',
            'string'        => 'Không đúng định dạng',
            'unique'        => 'Tài khoản đã tồn tại',
            'max'           => 'Không được dài hơn :max ký tự',
            'min'           => 'Không được ngắn hơn hơn :min ký tự',
            'confirmed'     => 'Hai mật khẩu chưa trùng khớp nhau',
            'email.regex' => 'Email định dạng',
	    ];
	}

    protected function create(array $data)
    {
        $user_model = $this->customer;

        return Customer::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'status'   => ACTIVE,
            'password' => $user_model->buildPassLender($data['password'])
        ]);
    }
}
