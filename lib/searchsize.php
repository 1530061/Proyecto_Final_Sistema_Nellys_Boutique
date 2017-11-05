<?php
	include ("db.php");
	include ("user_control_lib.php");
	include ("misc.php");

	if(isset($_GET['type']) && isset($_GET['val'])){
		if($_GET['type']=='2'){
			echo(array_values(select('select nombre from tipo_producto where id='.$_GET['val'])[0])[0]);
		}else if($_GET['type']=='3'){
			echo(array_values(select('select talla from talla where id='.$_GET['val'])[0])[0]);
		}
	}else{
		$types = select("select id, talla from talla where id_tipo=".$_GET['id_tipo']);
		//echo('<optgroup label="Nombre Completo">');

		for($i=0;$i<count($types);$i++){
			echo('<option '.(st($_GET['talla'])==st(array_values($types[$i])[0])?'selected':'').' value="'.array_values($types[$i])[0].'">'.array_values($types[$i])[1].'</option>');
		}
	}
?>