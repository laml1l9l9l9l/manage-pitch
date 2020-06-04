<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Model\Admin\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CustomerController extends Controller
{
    public function __construct(Customer $customer)
    {
		$this->customer = $customer;
    }

    public function index(Request $request)
    {
		$request_customer = $request->customer;
		$model_customer   = $this->customer;
		$array_phone_customer = array();

		// Get array phone customer
		$all_customer = $model_customer->whereNotNull('phone')
			->pluck('phone')->toArray();
		foreach ($all_customer as $customer) {
			$array_phone_customer[$customer] = $customer;
		}
		
		$offset        = 5;
		$start_page    = 1;
		$page          = $request->get('page');
		$page_customer = $this->indexTable($page, $offset);

		$customers = !empty($request_customer) ? $this->search($request_customer) : $model_customer;
        $customers = $customers->paginate($offset);
        $customers->setPath(URL::current());

    	return view('User.Admin.Customer.index', [
			'customers'            => $customers,
			'model_customer'       => $model_customer,
			'array_phone_customer' => $array_phone_customer,
			'page_customer'        => $page_customer,
			'request_customer'     => $request_customer,
			'request'              => $request->all()
    	]);
    }

    public function search($request_customer)
    {
        $customers = $this->customer;

        !empty($request_customer['email']) ? $customers = $customers->where('email', 'like', '%'.$request_customer['email'].'%') : '';
        !empty($request_customer['name']) ? $customers = $customers->where('name', 'like', '%'.$request_customer['name'].'%') : '';
        !empty($request_customer['phone']) ? $customers = $customers->where('phone', 'like', '%'.$request_customer['phone'].'%') : '';
        (isset($request_customer['status']) && $request_customer['status'] !== null) ? $customers = $customers->where('status', $request_customer['status']) : '';
        !empty($request_customer['start_created_at']) ? $customers = $customers->where('created_at', '>=', $request_customer['start_created_at'].' 00:00:00') : '';
        !empty($request_customer['end_created_at']) ? $customers = $customers->where('created_at', '<=', $request_customer['end_created_at'].' 23:59:59') : '';

        return $customers;
    }

}
