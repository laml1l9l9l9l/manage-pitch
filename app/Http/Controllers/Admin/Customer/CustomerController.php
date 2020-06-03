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
		$model_customer = $this->customer;
		
		$offset        = 5;
		$start_page    = 1;
		$page          = $request->get('page');
		$page_customer = $this->indexTable($page, $offset);

        $customers = $model_customer->paginate($offset);
        $customers->setPath(URL::current());

    	return view('User.Admin.Customer.index', [
			'customers'      => $customers,
			'model_customer' => $model_customer,
			'page_customer'  => $page_customer
    	]);
    }

}
