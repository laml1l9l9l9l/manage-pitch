<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Model\Admin\Admin;
use App\Model\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
	public function __construct(Admin $admin)
	{
		$this->admin = $admin;
	}

    public function changePassword()
    {
    	return view('User.Admin.Profile.change_password');
    }

    public function updatePassword(Request $request)
    {
    	$request_profile = $request->profile;
        $this->validator($request_profile)->validate();

        $model_admin = $this->admin;
        $name_route  = 'admin.change.password';
        $new_password = $model_admin->buildPassLender($request_profile['password']);
		$user    = $this->guard()->user();
        // Check old password
        if($user->password != $request_profile['old_password'])
        {
            return redirect()->route($name_route)
            ->with('error', 'Mật khẩu hiện tại không chính xác');
        }

        // Update password
		$profile = $model_admin->find($user->id);
		$profile->password   = $new_password;
		$profile->updated_at = Helper::getCurrentDateTime();
        $profile->save();

    	return redirect()->route($name_route)
            ->with('success', 'Bạn đã đổi mật khẩu');
    }

    protected function guard()
    {
        return Auth::guard('admin');
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
			'unique'             => 'Tài khoản đã tồn tại',
			'max'                => 'Không được dài hơn :max ký tự',
			'min'                => 'Không được ngắn hơn hơn :min ký tự',
			'confirmed'          => 'Hai mật khẩu chưa trùng khớp nhau',
			'password.different' => 'Không được sử dụng mật khẩu cũ',
	    ];
	}

}
