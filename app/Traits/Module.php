<?php
namespace App\Traits;
use Carbon;
use DB;
use Hashids\Hashids;
// use App\Models\Access\User\User;

trait Module
{
    function hashVal($data) {
        $hashids = new Hashids('', 10);
        return $hashids->encode($data);
    }

    function reHash($data) {
        $hashids = new Hashids('', 10);
        $hash_arr = $hashids->decode($data);
        if(count($hash_arr) > 0) {
            return $hash_arr[0];
        }
        return null;
    }

    function makeInitialsFromName(String $name) {
        $name_arr = explode(" ", $name);
        $abbr = "";

        foreach ($name_arr as $val) {
            $val = ucfirst($val); //Sukarno
            $val = substr($val, 0, 1);
            $abbr.=$val;
        }


        return $abbr;
    }

    function makeInitialsFromLastname(String $lname) {
        $lname = ucwords($lname); // Asasa Asasa
        $name_arr = explode(" ", $lname);
        $name_arr = implode("", $name_arr);
        $abbr = $name_arr;        
        return $abbr;
    }
}