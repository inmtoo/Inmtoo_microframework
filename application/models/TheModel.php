<?php

	class TheModel extends Inm_Controller {
	
		
		
		public function WriteIntoDB($add, $table) {
			
			Database::insert($table, $add);
		
		}
		

		
		

	
	}

?>