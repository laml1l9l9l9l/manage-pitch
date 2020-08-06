<?php

namespace App\Model\Admin;

use App\Model\Admin\Customer;
use Illuminate\Database\Eloquent\Model;

class HistoryBill extends Model
{
    protected $table = 'bill_history';

    public $status_model = array(
        LOCK   => 'Nghỉ',
        ACTIVE => 'Hoạt động'
    );
}
