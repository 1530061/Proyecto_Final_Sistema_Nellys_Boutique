<?php


	function get_extension($file) {
		$tmp=explode(".", $file);
		$extension = end($tmp);
		return $extension ? $extension : false;
	}



	function upload($file, $tmp, $newname){
		$filename=$newname;
		$uploaddir = $_SERVER['SCRIPT_FILENAME'];
		$uploaddir = dirname($uploaddir).'/usr_img/';
		//$uploaddir= substr($uploaddir, 1);
		/*
		echo("lol");
		echo(get_extension($_FILES['userfile']['name']));
		echo("<br>");
	 	echo($uploaddir);*/
		$uploadfile = $uploaddir . $filename.'.'. get_extension($_FILES['userfile']['name']);
				echo("<br>");
				/*
		echo($uploadfile);
		echo "<p>";	*/
		
		$tmpdir=$_FILES['userfile']['tmp_name'];

		move_uploaded_file($tmpdir, $uploadfile);
		/*$tmpdir= substr($tmpdir, 1);
		echo($tmpdir)
		if (move_uploaded_file($tmpdir, $uploadfile)) {
		  echo "File is valid, and was successfully uploaded.\n";
		} else {
		   echo "Upload failed";
		}

		echo "</p>";
		echo '<pre>';
		echo 'Here is some more debugging info:';
		print_r($_FILES);
		print "</pre>";*/
		return ("usr_img"."\\\\".$filename.".". get_extension($_FILES['userfile']['name']));
	}
?> 