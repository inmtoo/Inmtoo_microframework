<?php
	class DBconnect {
	
	
	public function db1() {
	
		$link = new mysqli('localhost', 'user', 'password', 'database') ;
		$link->set_charset("utf8");
		return $link;
	
	}
	
	
	}
?>