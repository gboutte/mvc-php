<?php

namespace Controller;

use Lib\Controller;
use Lib\Renderer;
use Lib\Response;

class HomeController extends Controller
{
    private $json;
    private $numbers = array();

    public function index()
    {


        $renderer = new Renderer();
        $renderer->setBlock('body', 'index.php');
        return new Response($renderer->render('layout.php'));
    }

    public function param($param)
    {

        $params = ["1st element","2nd element","3rd element",$param];

        $renderer = new Renderer();
        $renderer->setBlock('body', 'liste.php',array('params'=>$params));
        return new Response($renderer->render('layout.php'));

    }
}