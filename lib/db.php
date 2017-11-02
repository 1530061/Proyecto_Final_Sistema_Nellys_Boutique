<?php

$servername = "localhost";
$username = "root";
$password= "";
//$password = "php34a5";
$dbname = "nelly_db";

function connect(){
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	return $conn;
}

function select($query) {
	$conn = connect();
	$result = $conn->query($query);
	$resArr = array();

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        $resArr[] = $row;
	    }
	} else {
		$resArr[0][0]="0";
	}
	$conn->close();
	return $resArr; 
}

function delete($query){
	$conn = connect();

	if ($conn->query($query) === TRUE) 
	    return true;
	else 
	    return false;
	$conn->close();
}
//$columns, $values, $table
function insert($columns, $values, $table){
	/*
	$columns=["nombre","apellido_paterno","apellido_materno","fecha_nac", "user", "pass","nivel","genero"];
	$values=["'John'","'DOe'","'john@'","'2009-01-10 18:38:02'","'usr'","'pass'","0","'M'"];
	$table="usuario";*/
	if(sizeof($columns)==sizeof($values)){
		$conn=connect();
		$columns_string="(";
		$values_string="(";
		for($i=0;$i<sizeof($columns)-1;$i++){
			$columns_string=$columns_string.$columns[$i].", ";
			$values_string=$values_string.$values[$i].", ";
		}
		$columns_string=$columns_string.$columns[sizeof($columns)-1].")";
		$values_string=$values_string.$values[sizeof($values)-1].")";
		//echo($columns_string);
		//echo($values_string);
		
		$sql = "INSERT INTO ".$table." ".$columns_string."
		VALUES ".$values_string."";
		$conn->query($sql);
		/*
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
		*/

		$conn->close();
	}else{
		echo("erro");
	}
}

function update($columns, $values, $table, $condition){

	if(sizeof($columns)==sizeof($values)){
		$conn=connect();
		$string="";
		
		for($i=0;$i<sizeof($columns)-1;$i++){
			$string=$string.$columns[$i]." = ".$values[$i]." ,";
		}
		$string=$string.$columns[$i]." = ".$values[$i]." ";
		
		$sql = "UPDATE ".$table." SET ".$string." ".$condition."";
		$conn->query($sql);
		/*
		echo($sql);
		
		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}*/
		

		$conn->close();
	}else{
		echo("erro");
	}
}



?>