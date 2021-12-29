<?php
namespace App\Utilities;

class XSSClean 
{

    public static function xss_clean(string $str)
    {
        return filter_var(htmlspecialchars($str), FILTER_SANITIZE_STRING);
    }

}