<?php

//Parametros de conexion a la BD.
$servername = "localhost";
$username = "root";
$password= "";
//$password = "php34a5";
$dbname = "nelly_db";


//Funcion que se encarga de solicitar una conexion a la base de datos.
function connect(){
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	return $conn;
}

//Funcion que hace una consulta a la base de datos, teniendo como entrada una cadena
//de texto que retorna un arreglo de arreglos de tipo string.
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

//Funcion que hace un borrado a la base de datos, teniendo como entrada una cadena
//de texto que realiza la eliminacion.
function delete($query){
	$conn = connect();

	if ($conn->query($query) === TRUE) 
	    return true;
	else 
	    return false;
	$conn->close();
}

//Funcion que realiza una insercion a la base de datos, teniendo como entrada tres arreglos de tipo String, 
//[1] Nombre de las columnas, [2] Valores, [3] Nombre de la tabla.
function insert($columns, $values, $table){
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

		$sql = "INSERT INTO ".$table." ".$columns_string."
		VALUES ".$values_string."";
		$conn->query($sql);
		
		$conn->close();
	}else{
		echo("erro");
	}
}


//Funcion que realiza un update a la base de datos, teniendo como entrada tres arreglos de tipo String, 
//[1] Nombre de las columnas, [2] Valores, [3] Nombre de la tabla y tambien una cadena de texto que contiene
//la condicion que se debe de cumplir para realizar el update.
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
		$conn->close();
	}else{
		echo("erro");
	}
}

?>