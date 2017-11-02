<?php
	include ("db.php");
	include ("control_usuarios_lib.php");


	switch ($_GET['t']) {
	    case 0:
	       	echo ''.get_of_usrbyID($_GET['id'],"nombre").'';
	        break;
	    case 1:
	        echo ''.get_of_usrbyID($_GET['id'].'',"apellido_paterno");
	        break;
	    case 2:
			echo ''.get_of_usrbyID($_GET['id'].'',"apellido_materno");
	        break;
		case 3:
	        echo ''.get_of_usrbyID($_GET['id'].'',"fecha_nac");
	        break;
		case 4:
	        echo ''.get_of_usrbyID($_GET['id'].'',"user");
	        break;
		case 5:
	        echo ''.get_of_usrbyID($_GET['id'].'',"email");
	        break;
		case 6:
	        echo ''.get_of_usrbyID($_GET['id'].'',"telefono");
	        break;
		case 7:
	        echo ''.get_of_usrbyID($_GET['id'].'',"nivel");
	        break;
		case 8:
	        echo ''.get_of_usrbyID($_GET['id'].'',"genero");
	        break;
		case 9:
	        echo ''.get_of_usrbyID($_GET['id'].'',"biografia");
	        break;
	    default:
	        echo '';
	}

	
?>
