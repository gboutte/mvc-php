<?php
namespace Config;

class Routes
{
    public static function getRoutes(){


        return array(
            'home'=> array(
                'path' => '/',
                'action' => "Controller\HomeController:index",
            ),
            "params" => array(
                'path' => '/param/{param}',
                'action' => "Controller\HomeController:param",
            )
        );

    }

}