<?php

class CustomQuery extends AppModel{
	var $sql;
	var $limit = 20;
	var $useTable = false;
	
	function setSql($sql){
		$this->sql = $sql;
	}

	function paginateCount($conditions, $recursive){

		$sql  = "SELECT COUNT(*) AS total FROM (" . $this->sql . ") AS CONSUL";
		
		if( $aux  = $this->query($sql) ){
			return $aux[0][0]['total'];
		}

		return false;
	}

	function paginate($conditions, $fields, $order, $limit, $page, $recursive){

		$sql  = $this->sql;
		$sql .= " LIMIT " . $this->limit . " ";
		$sql .= " OFFSET " . (($page - 1) * $this->limit);

		return $this->query($sql);
	}	
	
	function getData(){
		return $this->query($this->sql);
	}
	
}


?>
