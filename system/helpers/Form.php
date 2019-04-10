<?php

	class Form {
	
		public function post($post) {
		
		$output = htmlspecialchars($_POST[$post]);
		return $output;
		
		}
		
		public function get($post) {
		
		$output = htmlspecialchars($_GET[$post]);
		return $output;
		
		}
		
		public function request($post) {
		
		$output = htmlspecialchars($_REQUEST[$post]);
		return $output;
		
		}
		
		public function test() {
			echo 'Works';
		}
	
	
	}
	
?>