<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Customer;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends CustomerController
{
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function index()
    {
    	return view('User.Customer.Profile.change_password');
    }

    public function update(Request $request)
    {
    	$request_profile = $request->profile;
        $this->validator($request_profile)->validate();

        $model_customer = $this->customer;
        $name_route     = 'customer.profile.change.password';
        $old_password   = $model_customer->buildPassCustomer($request_profile['old_password']);
        $new_password   = $model_customer->buildPassCustomer($request_profile['password']);
        $user           = $this->guard()->user();
        // Check old password
        if($user->password != $old_password)
        {
            return redirect()->route($name_route)
                ->with('error', 'Mật khẩu hiện tại không chính xác');
        }

        // Update password
		$profile = $model_customer->find($user->id);
		$profile->password   = $new_password;
		$profile->updated_at = Helper::getCurrentDateTime();
        $profile->save();

    	return redirect()->route($name_route)
            ->with('success', 'Bạn đã đổi mật khẩu');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'old_password'          => ['required', 'string', 'min:5'],
            'password'              => ['required', 'string', 'min:5', 'different:old_password', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:5']
        ], $this->messages());
    }

    public function messages()
    {
        return [
            'required'           => 'Không được để trống',
            'string'             => 'Không đúng định dạng',
            'max'                => 'Không được dài hơn :max ký tự',
            'min'                => 'Không được ngắn hơn hơn :min ký tự',
            'confirmed'          => 'Hai mật khẩu chưa trùng khớp nhau',
            'password.different' => 'Không được sử dụng mật khẩu cũ',
        ];
    }
}
