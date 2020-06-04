<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\CustomerController;
use App\Model\Customer\Customer;
use App\Model\Customer\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends CustomerController
{
    public function __construct(Customer $customer, Bill $bill)
    {
        $this->customer = $customer;
        $this->bill     = $bill;
    }
    public function index()
    {
        $account = $this->guard()->user();
        $model_customer = $this->customer;
    	return view('User.Customer.Profile.index', [
            'account' => $account,
            'model_customer' => $model_customer
        ]);
    }

    public function update(Request $request)
    {
        $this->validateUpdateProfile($request);
        $profile = $request['profile'];
        $account = $this->guard()->user();

        $model_customer  = $this->customer;
        $customer        = $model_customer->find($account->id);
        $customer->name  = $profile['name'];
        $customer->phone = $profile['phone'];
        $customer->save();

        return redirect()->route('customer.profile')
            ->with('success', 'Cập nhật thông tin các nhân thành công');
    }

    public function information()
    {
        $account = $this->guard()->user();
        return $account;
    }

    public function bill(Request $request)
    {
        $account    = $this->guard()->user();
        $model_bill = $this->bill;
        return view('User.Customer.Bill.index', [
            'account' => $account,
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    	return redirect()->route('customer.login');
    }

    private function validateUpdateProfile(Request $request)
    {
        $request->validate([
            'profile.name'  => 'required|string|min:3|max:100',
            'profile.phone' => ['required','string', 'regex:/^0(3[2-9]|5[689]|7[06-9]|8[1-9]|9[0-9])[0-9]{7}$/'],
        ], $this->messages());
    }

    private function messages()
    {
        return [
            'required'    => 'Không được để trống',
            'string'      => 'Sai định dạng',
            'max'         => 'Sai định dạng, dài hơn :max ký tự',
            'min'         => 'Sai định dạng, ngắn hơn :min ký tự',
            'regex' => 'Sai định dạng',
        ];
    }
}
