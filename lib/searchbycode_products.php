<?php
	include ("db.php");
	include ("stock_lib.php");

	//echo($_GET['t']);
	if(isset($_GET['type'])){
		switch ($_GET['t']) {
		    case 0:
		       	echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"nombre");
		        break;
		    case 1:
				echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"id_tipo");
		        break;
			case 2:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"id_talla");
		        break;
			case 3:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"cantidad_stock");
		        break;
			case 4:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"fotografia");
		        break;
		    default:
		        echo '';
		}
	}else{
		switch ($_GET['t']) {
		    case 0:
		       	echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"nombre");
		        break;
		    case 1:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"descripcion");
		        break;
		    case 2:
				echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"id_tipo");
		        break;
			case 3:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"id_talla");
		        break;
			case 4:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"precio");
		        break;
			case 5:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"cantidad_stock");
		        break;
			case 6:
		        echo ''.get_of_prodbyID('"'.$_GET['id'].'"',"fotografia");
		        break;
		    default:
		        echo '';
		}
	}


	
?>
