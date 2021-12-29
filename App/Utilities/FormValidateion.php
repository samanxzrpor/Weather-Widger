<?php
namespace App\Utilities;


class FormValidateion
{

    public static function validatePostString(mixed $filed)
    {
        return filter_var($filed , FILTER_SANITIZE_STRING);
    }

    public static function validatePostUrl(mixed $filed)
    {
        return filter_var($filed , FILTER_SANITIZE_URL);
    }

    public static function validatePostEmail(mixed $filed)
    {
        return filter_var($filed , FILTER_SANITIZE_EMAIL);
    }

    public static function isStrongPassword(string $pass)
    {
        if (strlen($pass) < 8)
            return false;
        if (!preg_match('/[A-Za-z1-9]/' , $pass))
            return false;
        if (!preg_match('/\d/' , $pass))
            return false;

        return true;
    }

}