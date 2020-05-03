<?php

namespace App\Model;


class Helper
{
    public static function getCurrentDateTime()
    {
        date_default_timezone_set('Asia/Bangkok');
        return date("Y-m-d H:i:s");
    }


    public static function optionSelectBasic($values, $selected){

        foreach ($values as $key => $value ){
            if($value->id==$selected){
                $flag="selected";
            }else{
                $flag="";
            }
            echo "<option $flag value=\"".$value->id."\">$value->name</option>";
        }
    }


    public static function optionSelectLinkMenu($values, $selected){

        foreach ($values as $key => $value ){
            if($value->id==$selected){
                $flag="selected";
            }else{
                $flag="";
            }
            echo "<option $flag value=\"".$value->id."\">$value->link</option>";
        }
    }
}
