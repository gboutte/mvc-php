<?php

namespace Lib;


class Controller
{
    public function render($file){
        $realfile = TEMPLATE_ROOT.'/'.$file;
        ob_start();
        if(file_exists($realfile)){

            require $realfile ;
        }

        return ob_get_clean();
    }
}