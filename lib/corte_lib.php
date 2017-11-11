<?php
	function fill_datatable_corte(){
		echo('
		 <thead>
	        <tr>
	            <th>Id de la Venta</th>
	            <th>Total de Venta</th>
	            <th>Vendedor</th>
	        </tr>
	    </thead>
	    <tbody>
	    ');

		$daten=date_create("now");
		$daten=date_format($daten,"Y-m-d");

		$today = select("select id, total,id_usuario from venta where fecha='".$daten."'");
		
		for($i=0;$i<sizeof($today);$i++){
			echo('
				<tr>
					<td>'.array_values($today[$i])[0].'</td>
					<td>'.array_values($today[$i])[1].'</td>
					<td>'.array_values(select("select CONCAT(nombre, apellido_paterno, apellido_materno) from usuario where id='".array_values($today[$i])[2]."'")[0])[0].'</td>
				</tr>
				');
		}
	    echo('</tbody>');	

	}

?>