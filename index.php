<?php

header("content-type: text/html; charset=utf-8");

define('ROOT',dirname(__FILE__).'/');
define('SYS',dirname(__FILE__).'/system/');
define('APP',dirname(__FILE__).'/application/');
define('VIEW',dirname(__FILE__).'/application/views/');
define('HomeController','Frontend');
define('BASEURL', 'http://yoursite.com/index.php/');


include SYS.'inmframework.php';



$router = Router::call(); 
$Controller = $router['controller']; 
$Function = $router['function']; 
$Arguments = $router['arguments'];


$Controller::$Function($Arguments); 
  
?>

