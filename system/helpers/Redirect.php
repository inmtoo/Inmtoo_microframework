<?php

	Class Redirect {
	
		function index($path) {
			header('Location: '.BASEURL.$path);
		}
	
	}

?>