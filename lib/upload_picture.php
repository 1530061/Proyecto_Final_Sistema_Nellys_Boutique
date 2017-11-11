<?php

	//Funcion que obtiene la extension de la imagen agregada
	function get_extension($file) {
		$tmp=explode(".", $file);
		$extension = end($tmp);
		return $extension ? $extension : false;
	}


	//Funcion que permite hacer la subida de la imagen
	function upload($file, $tmp, $newname){
		$filename=$newname;
		$uploaddir = $_SERVER['SCRIPT_FILENAME'];
		$uploaddir = dirname($uploaddir).'/usr_img/';
		$uploadfile = $uploaddir . $filename.'.'. get_extension($_FILES['userfile']['name']);
				echo("<br>");

		$tmpdir=$_FILES['userfile']['tmp_name'];
		move_uploaded_file($tmpdir, $uploadfile);
		return ("usr_img"."\\\\".$filename.".". get_extension($_FILES['userfile']['name']));
	}

	//Funcion que permite agregar la imagen de un producto
	function upload_product($file, $tmp, $newname){
		$filename=$newname;
		$uploaddir = $_SERVER['SCRIPT_FILENAME'];
		$uploaddir = dirname($uploaddir).'/prod_img/';
		$uploadfile = $uploaddir . $filename.'.'. get_extension($_FILES['userfile']['name']);
		$tmpdir=$_FILES['userfile']['tmp_name'];
		move_uploaded_file($tmpdir, $uploadfile);
		return ("prod_img"."\\\\".$filename.".". get_extension($_FILES['userfile']['name']));
	}
?> 