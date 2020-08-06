<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Model\Admin\Customer;
use App\Model\Helper;
use Illuminate\Http\Request;

class UpdateCustomerController extends Controller
{
    public function __construct(Customer $customer)
    {
		$this->customer = $customer;
    }

    public function index($id, Request $request)
    {
		$request_customer = $request->customer;
		$model_customer   = $this->customer;

		$customer = $model_customer->find($id);
		$customer->name       = $request_customer['name'];
		$customer->phone      = $request_customer['phone'];
		$customer->status     = $request_customer['status'];
		$customer->updated_at = Helper::getCurrentDateTime();
		$customer->save();

		return redirect()->route('admin.customer.detail', ['id' => $id])
			->with('success', 'Cập nhật thành công');
    }
}