<?php


namespace App\Router;
use App\Controller\ErrorController;


class Router
{

    private $url;
    private $routes = [];
    private $namedRoutes = [];
    private $errors;
    private $publicFolder;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'POST');
    }

    public function delete($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'DELETE');
    }

    public function put($path, $callable, $name = null) {
        return $this->add($path, $callable, $name, 'PUT');
    }

    private function add($path, $callable, $name, $method) {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null){
            $name = $callable;
        }
        if($name){
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run(){

        $this->publicFolder = 'public';
        $urlFile = ROOT . "/" . $this->url;

        if( (is_dir($urlFile) || file_exists($urlFile)) && ($this->url != '')) {
            $this->errors = new ErrorController();
            $this->errors->forbidden();
            return true;
        }

        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouterException('REQUEST_METHOD UNDEFINED');
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if($route->match($this->url)){
                return $route->call();
            }
        }
        //No routes matching = return a 404
        $this->errors = new ErrorController();
        $this->errors->notFound();
        return true;
    }

    public function url($name, $params = []){
        if(!isset($this->namedRoutes[$name])) {
            throw new RouterException("No routes matched this name");
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

}