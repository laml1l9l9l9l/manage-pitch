<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    public $status_model = array(
    	MENU => 'Menu cha',
    	SUB_MENU => 'Menu con',
    );
}
