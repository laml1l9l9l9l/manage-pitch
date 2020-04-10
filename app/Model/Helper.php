<?php

namespace App\Model;


class Helper
{
    public static function getCurrentDateTime(){

        date_default_timezone_set('Asia/Bangkok');
        return date("Y-m-d H:i:s");
    }
}
