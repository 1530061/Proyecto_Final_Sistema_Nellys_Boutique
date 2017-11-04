<?php
	include ("db.php");
	include ("user_control_lib.php");


	$types = select("select id, talla from talla where id_tipo=".$_GET['id_tipo']);
	//echo('<optgroup label="Nombre Completo">');
	for($i=0;$i<count($types);$i++){
		echo('<option value="'.array_values($types[$i])[0].'">'.array_values($types[$i])[1].'</option>');
	}
?>