<?php
	function get_of_usrbyID($id, $column){
		return array_values(select("select ".$column." from usuario where id='".$id."'")[0])[0]. '';
	}




?>