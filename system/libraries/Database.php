<?php 

class Database {

    
	function SelectFrom($table, $fields) {
		$DBconnect = DBconnect::db1();
		$result = mysqli_query ($DBconnect, "SELECT ".$fields." FROM `".$table."`"); 
		

		if ($result) {
			$num = mysqli_num_rows($result);     
			$i = 0;
			while ($i < $num) {
			$data[$i] = mysqli_fetch_assoc($result);  
			$i++;
			}    
		}
		else {
			$data = array('type'=>'error');
		} 
		

		return $data;

	}
	
	
	function difQuery($query) {
		$DBconnect = DBconnect::db1();
		$result = mysqli_query ($DBconnect, $query); 
		

		if ($result) {
			$num = mysqli_num_rows($result);     
			$i = 0;
			while ($i < $num) {
			$data[$i] = mysqli_fetch_assoc($result);  
			$i++;
			}    
		}
		else {
			$data = array('type'=>'error');
		} 
		

		return $data;

	}
	
	
	function insert($table, $add) {
		$DBconnect = DBconnect::db1();
		$columns = array_keys($add);
		for ($i = 0; $i< count($add); $i++) {
			$add[$columns[$i]] = "'".$add[$columns[$i]]."'";
			$columns[$i] = '`'.$columns[$i].'`';
		}
		
		$columns =  implode (',', $columns);
		$values = implode (',', $add);
		$query = "INSERT INTO `".$table."` (".$columns.") VALUES (".$values.")";
		mysqli_query( $DBconnect, $query );
		//return $query;
	}
	
	function update( $table, $add, $parametr, $value ) {
	
		$DBconnect = DBconnect::db1();
		$columns = array_keys($add);
		$set = array();
		for ($i = 0; $i< count($add); $i++) {
			$add[$columns[$i]] = "'".$add[$columns[$i]]."'";
			$set[$i] = '`'.$columns[$i].'` ='.$add[$columns[$i]];
			$columns[$i] = '`'.$columns[$i].'`';
			
		}
		
		$set_phrase = implode (',', $set);
		
		
		
		$query = "
			UPDATE `{$table}` set {$set_phrase} WHERE `{$parametr}` = {$value}
		";
		mysqli_query( $DBconnect, $query );
		//return $query;
	
	}
	
	function deletrow_where_param( $table, $parametr, $value ) {
		$DBconnect = DBconnect::db1();
		$query = "DELETE FROM `".$table."` WHERE `".$parametr."` = {$value} ";
		mysqli_query ( $DBconnect, $query );
		//return $query;
	}
	
	function getrows($table, $fields, $parametr, $value) {
		$DBconnect = DBconnect::db1();
		$query = "SELECT ".$fields." FROM `".$table."` WHERE `".$parametr."` = '".$value."'";
		$result = mysqli_query ($DBconnect, "SELECT ".$fields." FROM `".$table."` WHERE `".$parametr."` = '".$value."'");
		if ($result) {
			$num = mysqli_num_rows($result);     
			$i = 0;
			while ($i < $num) {
			$data[$i] = mysqli_fetch_assoc($result);  
			$i++;
			}    
		}
		else {
			$data = array('type'=>'error');
		} 
		
		
		return $data;
		//return $query;
	
	}
	
	
	function getrow($table, $fields, $parametr, $value, $rownum) { // получаем только одну строку $num номер строки
		$DBconnect = DBconnect::db1();
		$result = mysqli_query ($DBconnect, "SELECT ".$fields." FROM `".$table."` WHERE `".$parametr."` = '".$value."'");
		if ($result) {
			$num = mysqli_num_rows($result);     
			$i = 0;
			while ($i < $num) {
			$data[$i] = mysqli_fetch_assoc($result);  
			$i++;
			}    
		}
		else {
			$data = array('type'=>'error');
		} 
		
		
		return $data[$rownum];

	
	}
	
	public function test() {
		
		echo 'Класс Database работает';
	
	}
	
    
}

?>

