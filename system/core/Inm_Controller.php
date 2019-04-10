<?php 

	class Inm_Controller {
	
		//private static $instance;

		public function __construct()
		{
			self::$instance = & $this;
		} 
		
		public function loadview($view, $data) {
		
			include(VIEW.$view.'.php');
		
		}
		
	}


?>