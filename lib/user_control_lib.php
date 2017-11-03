<?php

function get_of_usrbyID($id, $column){
	return array_values(select("select ".$column." from usuario where id=".$id."")[0])[0];
}

function update_user($file, $tmp){
	if(isset($_POST["usr_niv"])){

		$id=$_POST["usr_id"];

		if($_POST["usr_niv"]=="1"){
			$_POST["usr_em"]="";
			$_POST["usr_tel"]="";
			$_POST["content"]="";
		}
		if(((empty($_POST["usr_em"]) && $_POST["usr_niv"]==1) || (!empty($_POST["usr_em"]) && $_POST["usr_niv"]==0)) && ((empty($_POST["usr_tel"]) && $_POST["usr_niv"]==1) || (!empty($_POST["usr_tel"]) && $_POST["usr_niv"]==0)) ){
			$users=select("select user from usuario where user='".$_POST["usr_user"]."' and activo=1")[0];
			$actual=select("select user from usuario where id=".$id)[0];
			if(array_values($users)[0]=="0" || array_values($actual)[0]==$_POST["usr_user"]){

				$nombre = $_POST["usr_user"];
				$date=date_create($_POST["usr_fn"]);
				$date=date_format($date,"Y-m-d H:i:s");
				$values=[st($_POST["usr_nombre"]),st($_POST["usr_app"]),st($_POST["usr_apm"]), st($date), st($_POST["usr_user"]), st($_POST["usr_pass"]),$_POST["usr_niv"], st($_POST["usr_ge"]), st($_POST["usr_em"]), st($_POST["content"]), st($_POST["usr_tel"])];
				$columns=["nombre", "apellido_paterno", "apellido_materno", "fecha_nac", "user", "pass", "nivel", "genero", "email", "biografia","telefono"];

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
				    	update($columns, $values, "usuario", "where id=".$id);
				    	include 'upload_picture.php';
				    	$fileloc=upload($file,$tmp, $id);

				    	$columns=["fotografia"];
				    	$values=[st($fileloc)];
				    	$table="usuario";
				    	$condition="where id=".$id;
				    	update($columns,$values,$table,$condition);
				    	$_POST = array();
				    	sweetalert('Usuario ['.$nombre.'] actualizado correctamente.</strong>',"good");
				    } else {    
				    	
				    	foreach($errors as $error) {
				    		sweetalert($error,"bad");
				    	}
				    }
				}else{
					update($columns, $values, "usuario", "where id=".$id);
					sweetalert('Usuario ['.$nombre.'] modificado correctamente.</strong>',"good");						
				}
			}else{
				sweetalert("El nombre de usuario [".$_POST["usr_user"]."] no esta disponible, Intente nuevamente.","bad");
			}
		}else{
			sweetalert("Ingrese un correo electronico y telefono valido.","bad");
		}
	}else{
		sweetalert("Ingrese un nivel de privilegios valido.","bad");
	}
}

function delete_user(){
	$id=$_POST['usr_id'];
	$filepath=array_values(select("select fotografia from usuario where id=".$id)[0])[0];
	if($filepath!='usr_img\0.png' && substr($filepath,0,8)=='usr_img\\'){
		unlink($filepath);
	}
	
	$columns=["activo","user","pass","fotografia"];
	$values=['0','null','null',st('usr_img\\\\0.png')];
	$table="usuario";
	$condition="where id=".$id;
	update($columns,$values,$table,$condition);
}


function insert_user($file, $tmp){

	if(isset($_POST["usr_niv"])){
		if(((empty($_POST["usr_em"]) && $_POST["usr_niv"]==1) || (!empty($_POST["usr_em"]) && $_POST["usr_niv"]==0)) && ((empty($_POST["usr_tel"]) && $_POST["usr_niv"]==1) || (!empty($_POST["usr_tel"]) && $_POST["usr_niv"]==0)) ){
			$users=select("select user from usuario where user='".$_POST["usr_user"]."' and activo=1")[0];
			if(array_values($users)[0]=="0"){

				$nombre = $_POST["usr_user"];
					//Preparacion insert
				$date=date_create($_POST["usr_fn"]);
				$date=date_format($date,"Y-m-d H:i:s");
				$values=[st($_POST["usr_nombre"]),st($_POST["usr_app"]),st($_POST["usr_apm"]), st($date), st($_POST["usr_user"]), st($_POST["usr_pass"]),$_POST["usr_niv"], st($_POST["usr_ge"]), st($_POST["usr_em"]), st($_POST["content"]), st($_POST["usr_tel"]), "1"];
				$columns=["nombre", "apellido_paterno", "apellido_materno", "fecha_nac", "user", "pass", "nivel", "genero", "email", "biografia","telefono","activo"];

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
					    	insert($columns, $values, "usuario");
					    	$id = array_values(select("select id from usuario where user='".$nombre."' and pass='".$_POST["usr_pass"]."'")[0])[0];
					    	include 'upload_picture.php';
					    	$fileloc=upload($file,$tmp, $id);

					    	$columns=["fotografia"];
					    	$values=[st($fileloc)];
					    	$table="usuario";
					    	$condition="where id=".$id;
					    	update($columns,$values,$table,$condition);
					    	$_POST = array();
					    	sweetalert('Usuario ['.$nombre.'] agregado correctamente.</strong>',"good");
					    } else {    
					    	
					    	foreach($errors as $error) {
					    		sweetalert($error,"bad");
					    		
					    	}
					    }
					}else{
						$fileloc='usr_img\\\\0.png';
						insert($columns, $values, "usuario");
						$id = array_values(select("select id from usuario where user='".$_POST["usr_user"]."' and pass='".$_POST["usr_pass"]."'")[0])[0];
						//Nuevos valores para update
						$columns=["fotografia"];
						$values=[st($fileloc)];
						$table="usuario";
						$condition="where id=".$id;
						//Termina
						
						update($columns,$values,$table,$condition);
						$_POST = array();
						sweetalert('Usuario ['.$nombre.'] agregado correctamente.</strong>',"good");
						
					}
				}else{
					sweetalert("El nombre de usuario [".$_POST["usr_user"]."] no esta disponible, Intente nuevamente.","bad");
				}
			}else{
				sweetalert("Ingrese un correo electronico y telefono valido.","bad");
			}
		}else{
			sweetalert("Ingrese un nivel de privilegios valido.","bad");
		}
	}

function fill_search_mod_usr(){
	$user_info = select("select id, CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno) from usuario where activo=1 and id!=".$_SESSION['id']);
	echo('<optgroup label="Nombre Completo">');
	for($i=0;$i<count($user_info);$i++){
		echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[1].'</option>');
	}
	echo('<optgroup label="Usuario">');
	$user_info = select("select id, user from usuario where activo=1 and id!=".$_SESSION['id']);
	for($i=0;$i<count($user_info);$i++){
		echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[1].'</option>');
	}



}

?>

