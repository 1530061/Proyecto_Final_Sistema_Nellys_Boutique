<?php
	if(isset($_GET['type'])){
		//include ("misc.php");
		include ("db.php");
		if($_GET['type']=="1"){
			echo(array_values(select("select fotografia from producto where codigo='".$_GET['cod']."'")[0])[0]);
		}
		if($_GET['type']=="2"){
			echo(array_values(select("select precio from producto where codigo='".$_GET['cod']."'")[0])[0]);
		}
		if($_GET['type']=="3"){
			echo(array_values(select("select nombre from producto where codigo='".$_GET['cod']."'")[0])[0]);
		}
		if($_GET['type']=="4"){
			echo(array_values(select("select talla from talla t inner join producto p on p.id_talla=t.id where p.codigo='".$_GET['cod']."'")[0])[0]);
		}
	}
	function fill_search_prod(){
		$user_info = select("select codigo from producto where activo=1");
		echo('<optgroup label="Codigo">');
		for($i=0;$i<count($user_info);$i++){
			echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[0].'</option>');
		}
		echo('<optgroup label="Nombre">');
		$user_info = select("select codigo, nombre from producto where activo=1");
		for($i=0;$i<count($user_info);$i++){
			echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[1].'</option>');
		}
	}

	if(isset($_GET['action'])){
		include ("db.php");
		if($_GET['action']=="1"){
			$daten=date_create($_GET['fecha']);
			$daten=date_format($daten,"Y-m-d H:i:s");
			$values=["'".$daten."'", $_GET['total'], $_GET['id']];
			$columns=["fecha", "total", "id_usuario"];
			insert($columns, $values, "venta");
			echo(array_values(select("select max(id) from venta")[0])[0]);
		}
		if($_GET['action']=="2"){
			$values=[$_GET['id'], "'".$_GET['codigo']."'", $_GET['cantidad']];
			$columns=["id_venta", "codigo_producto", "cantidad"];
			insert($columns, $values, "venta_producto");
			//echo("exito".$_GET['id']);
		}
		if($_GET['action']=="3"){
			echo(array_values(select("select max(id) from venta")[0])[0]);
		}
	}


	
?>