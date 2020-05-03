<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = 'manager/home';

	public function __construct(Admin $admin)
	{
        $this->middleware('guest');
		$this->admin = $admin;
	}

    public function index()
    {
    	return view('NotUser.Admin.register');
    }

    public function register(Request $request)
    {
    	$admin_request = $request['admin'];
        $this->validator($admin_request)->validate();

        event(new Registered($user = $this->create($admin_request)));

        // $this->guard()->login($user);
        $this->guard()->loginUsingId($user->id);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    protected function registered(Request $request, $user)
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
			'email'  => ['required', 'string', 'max:255', 'min: 5', 'regex:/^\w+([\.\-]{0,1}\w+)*\@\w+\..+$/i', 'unique:admins'],
			'password' => ['required', 'string', 'min:5', 'confirmed']
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
        $user_model = $this->admin;

        return Admin::create([
            'email'    => $data['email'],
            'password' => $user_model->buildPassLender($data['password'])
        ]);
    }
}
