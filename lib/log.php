<?php 

function exists_user($user, $pass){
	if (!empty($user) && !empty($pass)) {
		$verification=select("select id from usuario where user='".$user."' and pass='".$pass."';");
		if(array_values($verification[0])[0]!="0"){
			session_start();
			$_SESSION["logg"] = "true";
			$_SESSION["id"] = array_values($verification[0])[0];
			header('Location: /final/dashboard.php');
		}
	}
}


?>