<?php
	if(isset($_GET['type'])){
		include ("misc.php");
		if($_GET['type']=="1"){
			sweetalert('Producto no encontrado.</strong>',"bad");
			echo("<br>");
		}
	}

	//Funcion que llena el select2 con su nombre id y el tipo de producto
	function fill_types_clothes(){
		$types = select("select id, nombre from tipo_producto");
		
		for($i=0;$i<count($types);$i++){
			echo('<option value="'.array_values($types[$i])[0].'">'.array_values($types[$i])[1].'</option>');
		}
	}

	//Funcion que permite llenar la talla de los usuarios
	function fill_start_size(){
		$id_tipo = array_values(select("select id from tipo_producto")[0])[0];
		$types = select("select id, talla from talla where id_tipo=".$id_tipo);
		
		for($i=0;$i<count($types);$i++){
			echo('<option value="'.array_values($types[$i])[0].'">'.array_values($types[$i])[1].'</option>');
		}
	}

	//Funcion que permite hacer una busqueda agregando los valores a un elemento select2
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

	//Funcion que permite obtener un producto por ID
	function get_of_prodbyID($id, $column){
		return array_values(select("select ".$column." from producto where codigo=".$id."")[0])[0];
	}

	//Funcion que imprime una tabla de productos
	function fill_datatable_prod(){
		echo('
		 <thead>
	        <tr>
	            <th>Codigo</th>
	            <th>Nombre</th>
	            <th>Descripcion</th>
	          	<th>Tipo</th>
	          	<th>Talla</th>
	          	<th>Cantidad Stock</th>
	          	<th>Precio</th>
	
	        </tr>
	    </thead>
	    <tbody>
	    ');

		$table = select("select p.codigo, p.nombre as ne, p.descripcion, tp.nombre, t.talla, p.cantidad_stock, p.precio from producto p inner join tipo_producto tp on tp.id = p.id_tipo inner join talla t on p.id_talla=t.id where activo=1");

	    for($i=0;$i<sizeof($table);$i++){
			echo('
				<tr onclick="callFromTable('.st(array_values($table[$i])[0]).');">
					<td>'.array_values($table[$i])[0].'</td>
					<td>'.array_values($table[$i])[1].'</td>
					<td>'.array_values($table[$i])[2].'</td>
					<td>'.array_values($table[$i])[3].'</td>
					<td>'.array_values($table[$i])[4].'</td>
					<td>'.array_values($table[$i])[5].'</td>
					<td>'.array_values($table[$i])[6].'</td>
				</tr>
				');
		}
	    echo('</tbody>');					    
	}


	
	//Funcion que se encarga de hacer la insercion de un producto
	function insert_product($file, $tmp){
		$prod_cod=select("select codigo from producto where codigo='".$_POST["prod_cod"]."' and activo=1")[0];
		if(array_values($prod_cod)[0]=="0" && $_POST["prod_cod"]!='0'){

		
		$values=[st($_POST["prod_cod"]),st($_POST["prod_name"]),st($_POST["prod_desc"]), st($_POST["prod_tipo"]), st($_POST["prod_talla"]),$_POST["prod_precio"], st($_POST["prod_cant"]),"1"];
		$columns=["codigo", "nombre", "descripcion", "id_tipo", "id_talla", "precio", "cantidad_stock","activo"];

		if(!empty($_FILES['userfile']['name'])){
			$errors     = array();
			    $maxsize    = 2097152;		//2MB
			    $acceptable = array(		//Tipos
			    	'image/jpe',
			    	'image/jpeg',
			    	'image/jpg',
			    	'image/gif',
			    	'image/png'
			    );

			    if(($_FILES['userfile']['size'] >= $maxsize) || ($_FILES["userfile"]["size"] == 0)) {
			    	$errors[] = 'Archivo muy grande. El archivo debe de ser mas pequeño que 2MB.';
			    }
			    if(!in_array($_FILES['userfile']['type'], $acceptable) && (!empty($_FILES["userfile"]["type"]))) {
			    	$errors[] = 'Formato de fotografia invalido, solo formatos JPG, JPEG, PNG, JPE y GIF aceptados.';
			    }

			    if(count($errors) === 0) {
			    	insert($columns, $values, "producto");
			    	include 'upload_picture.php';
			    	$fileloc=upload_product($file, $tmp, $_POST["prod_cod"]);

			    	$columns=["fotografia"];
			    	$values=[st($fileloc)];
			    	$table="producto";
			    	$condition="where codigo='".$_POST["prod_cod"]."'";
			    	update($columns,$values,$table,$condition);
			    	sweetalert('Producto ['.$_POST["prod_cod"].'] agregado correctamente.</strong>',"good");
			    	$_POST = array();
			    } else {    
			    	
			    	foreach($errors as $error) {
			    		sweetalert($error,"bad");
			    		
			    	}
			    }
			}else{
				$fileloc='prod_img\\\\0.png';
				insert($columns, $values, "producto");
				
				$columns=["fotografia"];
				$values=[st($fileloc)];
				$table="producto";
				$condition="where codigo='".$_POST["prod_cod"]."'";
				
				update($columns,$values,$table,$condition);
				sweetalert('Producto ['.$_POST["prod_cod"].'] agregado correctamente.</strong>',"good");
				$_POST = array();
			}
		}else{
			sweetalert("El producto con el codigo [".$_POST["prod_cod"]."] no esta disponible, Intente nuevamente.","bad");
		}
	}

	//Funcion que permite actualizar algun producto
	function update_prod($file, $tmp){

		$users=select("select count(*) from producto where codigo='".$_POST["prod_cod"]."' and activo=1")[0];
		if(array_values($users)[0]=="1" && $_POST["prod_cod"]!="'0'"){

			$values=[st($_POST["prod_name"]),st($_POST["prod_desc"]), st($_POST["prod_tipo"]), st($_POST["prod_talla"]),$_POST["prod_precio"], st($_POST["prod_cant"]),"1"];
			$columns=[ "nombre", "descripcion", "id_tipo", "id_talla", "precio", "cantidad_stock","activo"];

			if(!empty($_FILES['userfile']['name'])){
				//Parametros de insercion de imagen
				$errors     = array();
			    $maxsize    = 2097152;		//2MB
			    $acceptable = array(		//Tipos
			    	'image/jpe',
			    	'image/jpeg',
			    	'image/jpg',
			    	'image/gif',
			    	'image/png'
			    );

			    if(($_FILES['userfile']['size'] >= $maxsize) || ($_FILES["userfile"]["size"] == 0)) {
			    	$errors[] = 'Archivo muy grande. El archivo debe de ser mas pequeño que 2MB.';
			    }
			    if(!in_array($_FILES['userfile']['type'], $acceptable) && (!empty($_FILES["userfile"]["type"]))) {
			    	$errors[] = 'Formato de fotografia invalido, solo formatos JPG, JPEG, PNG, JPE y GIF aceptados.';
			    }

			    if(count($errors) === 0) {
			    	$filepath=array_values(select("select fotografia from producto where codigo='".$_POST["prod_cod"]."'")[0])[0];

					if($filepath!='prod_img\0.png' && substr($filepath,0,9)=='prod_img\\'){
						unlink($filepath);
					}
			    	update($columns, $values, "producto", "where codigo='".$_POST["prod_cod"]."'");
			    	include 'upload_picture.php';
			    	$fileloc=upload_product($file,$tmp, $_POST["prod_cod"]);

			    	$columns=["fotografia"];
			    	$values=[st($fileloc)];
			    	$table="producto";
			    	$condition="where codigo='".$_POST["prod_cod"]."'";
			    	update($columns,$values,$table,$condition);
			    	sweetalert('Producto con el codigo ['.$_POST["prod_cod"].'] actualizado correctamente.</strong>',"good");
			    	$_POST = array();
			    	
			    } else {    
			    	
			    	foreach($errors as $error) {
			    		sweetalert($error,"bad");
			    	}
			    }
			}else{
				update($columns, $values, "producto", "where codigo='".$_POST["prod_cod"]."'");
				sweetalert('Producto con el codigo ['.$_POST["prod_cod"].'] modificado correctamente.</strong>',"good");						
			}
		}else{
			sweetalert("El codigo de producto [".$_POST["prod_cod"]."] no esta disponible, Intente nuevamente.","bad");
		}
	}
?>