<?php
namespace App\Core;

use App\Utilities\XSSClean;

class Request 
{
    private $params = [];
    private $method ;
    private $ip ;

    public function __construct()
    {
        foreach ($_REQUEST as $key => $value) {
            $_REQUEST[$key] =  XSSClean::xss_clean($value);
        }

        $this->params = $_REQUEST;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getUri()
    {
        return isset($this->params['path']) ? '/' . $this->params['path'] : '/';
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getIP()
    {
        return $this->ip;
    }
}