<?php
namespace App\Middlewares;

use App\Contract\Middlewares\MiddlewareInterface;
use App\Utilities\XSSClean;

class GlobalMiddleware implements MiddlewareInterface
{

    public static function handle()
    {
        self::sanitizeGetRequest();
    }

    public static function sanitizeGetRequest()
    {
        foreach ($_GET as $key => $value) {
            $_GET[$key] =  XSSClean::xss_clean($value);
        }
    }
}