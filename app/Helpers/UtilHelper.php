<?php

namespace App\Helpers;


class UtilHelper
{

    public static function randCode($length = 10) {
        $arr = array("123456789", "abcdefghijkmnpqrstuvwxyz");
        $string = implode("", $arr);
        $count = strlen($string) - 1;
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $string[rand(0, $count)];
        }
        return $code;
    }

    public static function hashStr($str, $salt = '')
    {
        return md5(md5($str) . $salt);
    }

}
