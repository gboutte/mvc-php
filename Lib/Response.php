<?php

namespace Lib;


class Response
{
    private $body = "";
    private $headers = array();
    public function __construct($body = "")
    {
        $this->body = $body;
    }
    public function execute(){

        foreach ($this->headers as $name => $value){
            header($name.': '.$value);
        }
        echo $this->body;
        die();
    }

    public function setContent($body){
        $this->body = $body;
    }
    public function setHeader($name,$value){

        $this->headers[$name]=$value;

    }

}