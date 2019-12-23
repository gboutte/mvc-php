<?php
namespace Lib;


class Renderer
{
    private $blocks = array();
    public function __construct()
    {

    }
    public function setBlock($name,$file,$params = array()){
        $this->blocks[$name] = Renderer::renderFile($file,$params);
    }
    public function render($file,$params = array()){
        $params = array_merge($params,$this->blocks);
        return Renderer::renderFile($file,$params);
    }
    public static function renderFile($file,$params = array()){
        $realfile = TEMPLATE_ROOT.'/'.$file;
        ob_start();
        extract($params);
        if(file_exists($realfile)){

            require $realfile ;
        }

        return ob_get_clean();
    }
}