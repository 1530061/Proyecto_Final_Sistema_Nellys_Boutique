<?php
	function getRegistredUsers(){
		echo(array_values(select("select count(*) from usuario")[0])[0]);
	}
	function getRegistredProducts(){
		echo(array_values(select("select count(*) from producto")[0])[0]);
	}
	function getTopProduct(){
		$id=array_values(select("select codigo_producto, count(*) from venta_producto group by codigo_producto")[0])[0];
		
		echo(array_values(select("select nombre from producto where codigo='".$id."'")[0])[0]);
	}
	function getDailySales(){
		$date=date_create("now");
		$date=date_format($date,"Y-m-d");
		//echo("select count(*) from venta where fecha='".$date."'");
		echo(array_values(select("select count(*) from venta where fecha='".$date."'")[0])[0]);
	}
	function getUserAdminChart(){
		$admin = array_values(select("select count(*) from usuario where nivel=0 and activo=1")[0])[0];
		$user = array_values(select("select count(*) from usuario where nivel=1 and activo=1")[0])[0];
		echo('{label: "Administradores", value: '.$admin.'},
              {label: "Empleados", value: '.$user.'},');
	}

	function getMostExpensive(){
		$lista=select('select nombre, precio from producto where activo=1 order by precio desc limit 5');

		for($i=0;$i<sizeof($lista);$i++){
			echo('{mapname: "'.array_values($lista[$i])[0].'", label: "'.array_values($lista[$i])[0].'", value: '.array_values($lista[$i])[1].'},');
			//echo('{mapname: "'.array_values($lista[0])[$i].'", label: "'.array_values($lista[0])[$i].'", value: '.array_values($lista[1])[$i].'},');
		}    
	}

	function getTypes(){
		$lista=select('select id_tipo, count(*) from producto where activo=1 group by id_tipo limit 5');

		for($i=0;$i<sizeof($lista);$i++){
			echo('{mapname: "'.array_values(select("select nombre from tipo_producto where id='".array_values($lista[$i])[0]."'")[0])[0].'", label: "'.array_values(select("select nombre from tipo_producto where id='".array_values($lista[$i])[0]."'")[0])[0].'", value: '.array_values($lista[$i])[1].'},');
			//echo('{mapname: "'.array_values($lista[0])[$i].'", label: "'.array_values($lista[0])[$i].'", value: '.array_values($lista[1])[$i].'},');
		}       
	}

	function activeAndInactive(){
		$admin = array_values(select("select count(*) from usuario where activo=0")[0])[0];
		$user = array_values(select("select count(*) from usuario where activo=1")[0])[0];
		echo('{label: "Activos", value: '.$admin.'},
              {label: "Inactivos", value: '.$user.'},');
	}

	function prod_activeAndInactive(){
		$activo = array_values(select("select count(*) from producto where activo=0")[0])[0];
		$inactivo = array_values(select("select count(*) from producto where activo=1")[0])[0];
		echo('{label: "Activos", value: '.$activo.'},
              {label: "Inactivos", value: '.$inactivo.'},');
	}

	function getDateGraph(){
		$lista=select('select fecha, SUM(total), count(*) from venta group by fecha limit 10');

		for($i=0;$i<sizeof($lista);$i++){
		 	echo('{week:"'.array_values($lista[$i])[0].'", "venta":"'.array_values($lista[$i])[1].'",  "precio":'.array_values($lista[$i])[1].'},');
		 }
	}

?>