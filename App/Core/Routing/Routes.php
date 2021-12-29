<?php
namespace App\Core\Routing;


class Routes
{
    private static $routes = [];

    public static function base(mixed $method , string $uri ,mixed $action = null , mixed $midlleware = null)
    {
        $method = is_array($method) ? $method : [$method];
        self::$routes[] = ['method'=>$method, 'uri'=>$uri, 'action'=>$action, 'midlleware'=>$midlleware];
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function get( string $uri ,mixed $action = null , mixed $midlleware = null)
    {
        self::base('get', $uri, $action, $midlleware);
    }

    public static function post( string $uri ,mixed $action = null , mixed $midlleware = null)
    {
        self::base('post', $uri, $action, $midlleware);
    }

    public static function update( string $uri ,mixed $action = null , mixed $midlleware = null)
    {
        self::base('update', $uri, $action, $midlleware);
    }

    public static function delete( string $uri ,mixed $action = null , mixed $midlleware = null)
    {
        self::base('delete', $uri, $action, $midlleware);
    }

    public static function put( string $uri ,mixed $action = null , mixed $midlleware = null)
    {
        self::base('put', $uri, $action, $midlleware);
    }

   
}