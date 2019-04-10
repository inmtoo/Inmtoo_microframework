<?php

  class Router {
  
  static function call() {
  
  
	//$uri_array = explode('/', str_replace('/index.php/', '', $_SERVER['REQUEST_URI']));
	$uri_array = explode('/', str_replace('/index.php', '', $_SERVER['REQUEST_URI'])); 
    array_shift($uri_array);
	
	//if ( count($uri_array) < 1 ) {
	if ( empty($uri_array[0]) ) {
	
		$out['controller'] = HomeController;
		$out['function'] = 'index';
	
	}
	
	else {
	
	$out['controller'] = $uri_array[0];
	
	if (!empty($uri_array[1])) {
		$out['function'] = $uri_array[1];
	} else {
		$out['function'] = 'index';
	}
	
	$out['arguments'] = array();
	
	for ($i = 2; $i < count($uri_array); $i++) {
		$out['arguments'][] = $uri_array[$i];
	}
	
	}
	
	return $out;
	

  }
  
  
  
  
  }

?>
