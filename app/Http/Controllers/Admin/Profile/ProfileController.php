<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $account = $this->guardAdmin()->user();
    	return view('User.Admin.Profile.index', [
            'account' => $account
        ]);
    }

    public function update(Request $request)
    {
        $this->validateUpdateProfile($request);
        $profile = $request['profile'];
        $account = $this->guardAdmin()->user();
        return redirect()->route('admin.profile')
            ->with('success', 'Cập nhật thông tin các nhân thành công');
    }

    public function logout(Request $request)
    {
        $this->guardAdmin()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    	return redirect()->route('admin.login');
    }

    protected function guardAdmin()
    {
        return Auth::guard('admin');
    }

    private function validateUpdateProfile(Request $request)
    {
        $request->validate([
            'profile.name'    => 'required|min:3|max:100',
            'profile.id_role' => 'required|string',
        ], $this->messages());
    }

    private function messages()
    {
        return [
            'required' => 'Không được để trống',
            'string'   => 'Sai định dạng',
            'profile.name.max' => 'Họ tên dài hơn :max ký tự',
            'profile.name.min' => 'Họ tên ngắn hơn :min ký tự',
        ];
    }
}
