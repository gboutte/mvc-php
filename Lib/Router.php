<?php

namespace Lib;

use Config\Routes as Routes;
use Controller\HomeController;

class Router
{
    private $method;
    private $url;
    private $paramregex = '@{(?<params>[^}]*)}@i';
    private $paramregexurl = '([^/]*)';

    public function __construct($method, $url)
    {
        $this->method = $method;
        $this->url = $url;

    }

    public function run()
    {
        $this->checkRoutes();

    }


    private function checkRoutes()
    {
        $routes = Routes::getRoutes();
        foreach ($routes as $name => $infos) {
            $route = $infos['path'];
            $action = $infos['action'];
            if (preg_match_all($this->paramregex, $route, $matches)) {
                $regexRoute = preg_replace($this->paramregex, $this->paramregexurl, $route);

                if (preg_match('@' . $regexRoute . '@i', $this->url)) {

                    $params = $this->getParameters($route);
                    $this->doAction($action, $params);

                }

            }

            if ($route == $this->url) {

                $this->doAction($action, []);
            }

        }

        $this->error(404);

    }


    private function getParameters($route)
    {
        $params = array();
        if (preg_match_all($this->paramregex, $route, $matches)) {
            $regexRoute = preg_replace($this->paramregex, $this->paramregexurl, $route);

            preg_match('@' . $regexRoute . '@i', $this->url, $urlPased);

            $i = 1;
            foreach ($matches['params'] as $name) {

                if (isset($urlPased[$i])) {
                    $params[$name] = $urlPased[$i];
                    $i++;
                }

            }

        }

        return $params;
    }

    private function doAction($action, $parameters)
    {
        $exploded = explode(':', $action);
        if (count($exploded) == 2) {
            $class = $exploded[0];
            $method = $exploded[1];
            $controller = new $class;

            $is_callable = is_callable(array(
                $controller,
                $method
            ));
            if ($is_callable) {

                $r = new \ReflectionMethod($class, $method);
                $params = $r->getParameters();

                $resp = call_user_func_array(array($controller, $method), $parameters);
                $resp->execute();
            } else {

                $this->error(500);
            }

        } else {
            $this->error(500);
        }

        die();
    }

    private function error($code)
    {

        header('HTTP/1.0 ' . $code . ' Not Found');
        echo "Error $code";
        die();

    }

    public static function routeToUrl($route, $params = array())
    {

        $url = "";
        $routes = Routes::getRoutes();
        if(!empty($routes[$route])){
            $url = $routes[$route]['path'];
            if(!empty($params)){
                foreach ($params as $k => $v){
                    $url = str_replace('{'.$k.'}',$v,$url);
                }
            }
        }
        return $url;
    }

}