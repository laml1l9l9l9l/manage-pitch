<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CustomerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function guard()
    {
        return \Auth::guard('');
    }

    protected function indexTable($page, $offset)
    {
        if(empty($page))
        {
            $page = 1;
        }
        elseif($page > 1)
        {
            $page = ($page - 1) * $offset + 1;
        }

        return $page;
    }
}
