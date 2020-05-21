<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    protected $table = 'pitchs';

    public $status_model = array(
    	PITCH_7_PERSON => 'Sân 7',
    	PITCH_9_PERSON => 'Sân 9',
    	PITCH_11_PERSON => 'Sân 11',
    );
}
