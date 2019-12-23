<?php
use Lib\Router as Router;


ini_set('display_errors',1);


define('PUBLIC_ROOT',$_SERVER['DOCUMENT_ROOT']);
define('PROJECT_ROOT',realpath (PUBLIC_ROOT.'/../'));
define('TEMPLATE_ROOT',PROJECT_ROOT.'/template');

require_once PROJECT_ROOT.'/autoload.php';
//echo "<pre>";
//print_r($_SERVER);
$requested_url = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router($method,urldecode($requested_url));
$router->run();