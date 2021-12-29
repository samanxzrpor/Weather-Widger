<?php
namespace App\Core\Routing;

use \App\Core\Request;

class Router
{

    private $request;

    private $currentRoute;

    private $listRoutes = [];

    private $currentController;

    private $currentMethod;

    private $metodsParams = [];

    private const ALLOWED_METHODS = ['get', 'post' , 'delete' , 'put' , 'update'];


    public function __construct()
    {
        $this->request = new Request();
        $this->listRoutes  = Routes::getRoutes();
        
        $this->currentRoute = $this->checkCurrentRoute($this->request) ?? null;
    }

    private function checkCurrentRoute(Request $request)
    {
        foreach ($this->listRoutes as $route)
        {
            if (!in_array($request->getMethod() , $route['method']))
                continue;
           
            if ($this->regexRoute($route['uri']))
                return $route;
        }
        
        return null;
    }

    private function regexRoute(string $uri)
    {
        $pattern = '/^' . str_replace(['/' ,'{' ,'}'] , ['\/' ,'(?<' ,'>[-!\w]+)'] , $uri) . '$/';
        $result = preg_match($pattern , $this->request->getUri() , $matches);
        
        if(empty($result))
            return false;

        foreach ($matches as $key => $value) {
            if (!is_int($key)) {
                $this->metodsParams[$key] = $value;
            }
        }

        return true;
    }

    private function dispath(mixed $route )
    {
       
        # if action is null
        if (is_null($route['action']))  
            return;

        # if action is function 
        if (is_callable($route['action']))
            $route['action']();

        # if action is string
        if (is_string($route['action']))
            $route['action'] = explode('@' , $route['action']);

        # if action is array
        if (is_array($route['action'])) {

            $currentController = '\App\Controllers\\' . $route['action'][0];
            if (class_exists($currentController)) {
                $obj = new $currentController();
                $method = $route['action'][1];

                if (method_exists($obj,$method)) {
                    $obj->$method($this->metodsParams);              
                }
            }
        }
    }
    
    public function run ()
    {
        # Check Status Code 405
        $this->dispath405($this->request);
        # Check Status Code 404
        $this->dispath404($this->currentRoute);
        # Check Middlewares

        # Run
        $this->dispath($this->currentRoute);
    }

    private function dispath405(request $request)
    {
        if (!in_array($request->getMethod() , self::ALLOWED_METHODS))
            return false;

        return true;
    }

    private function dispath404 (mixed $route)
    {
        if (is_null($route))
            return false;

        return true;
    }
}