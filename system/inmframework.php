<?php

	spl_autoload_register ('autoloadCore');
	spl_autoload_register ('autoloadControllers');
	spl_autoload_register ('autoloadModels');
	spl_autoload_register ('autoloadHelpers');
	spl_autoload_register ('autoloadLibrariesSYS');
	spl_autoload_register ('autoloadLibraries');

	function autoloadCore ($className) {
		$fileName = SYS.'core/'.ucfirst($className).'.php';
		include  $fileName;
	}
	
	function autoloadHelpers ($className) {
		$fileName = SYS.'helpers/'.ucfirst($className).'.php';
		include  $fileName;
	}
	
	function autoloadLibrariesSYS ($className) {
		$fileName = SYS.'libraries/'.ucfirst($className).'.php';
		include  $fileName;
	}
	
	
	function autoloadControllers ($className) {
		$fileName = APP.'controllers/'.ucfirst($className).'.php';
		include  $fileName;
	}
	
	function autoloadModels ($className) {
		$fileName = APP.'models/'.ucfirst($className).'.php';
		include  $fileName;
	}
	
	function autoloadLibraries ($className) {
		$fileName = APP.'libraries/'.ucfirst($className).'.php';
		include  $fileName;
	}
  
?>
