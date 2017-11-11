<?php

//Funcion que imprime la imagen del menu de la parte superior derecha de la interfaz
function image_top(){
	$result = select("select fotografia from usuario where id=".$_SESSION["id"]."")[0];
	if (!empty($result)) {
		return '<a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="'.array_values($result)[0].'" alt="user-img" class="img-circle"> </a>';
	}else{
		return '<a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="usr_img\0.png" alt="user-img" class="img-circle"> </a>';	
	}
}

//Funcion que imprime la imagen del menu de la parte izquierda
function image_sidebar_menu(){
	$result = select("select fotografia from usuario where id=".$_SESSION["id"]."")[0];
	if (!empty($result)) {
		return '<img src="'.array_values($result)[0].'" alt="" class="thumb-md img-circle">';			
	}else{
		return '<img src="usr_img\0.png" alt="" class="thumb-md img-circle">';
	}
}

//Funcion que retorna la imagen del usuario teniendo como entrada su ID
function get_img_usrbyID($id){
	$result = select("select fotografia from usuario where id=".$id."")[0];
	if (!empty($result)) {
		return array_values($result)[0];			
	}else{
		return "usr_img\0.png";
	}
}

//Funcion que retorna el nombre de usuario teniendo como entrada su ID
function get_name_usrbyID($id){
	return array_values(select("select nombre from usuario where id='".$id."'")[0])[0].' '.array_values(select("select apellido_paterno from usuario where id='".$id."'")[0])[0];
}

//Funcion que retorna el tipo de usuario teniendo como entrada su ID
function get_role_usrbyID($id){
	$result = array_values(select("select nivel from usuario where id=".$id."")[0])[0];
	return $result;
}

//Funcion que retorna la biografia de un usuario teniendo como entrada su ID
function get_bio_usrbyID($id){
	return array_values(select("select biografia from usuario where id=".$id."")[0])[0];
}


//Funcion que imprime en el menu el tipo de usuario
function name_and_role_sidebar_menu(){
	$result = array_values(select("select nivel from usuario where id=".$_SESSION["id"]."")[0])[0];
	$genero = array_values(select("select genero from usuario where id=".$_SESSION["id"]."")[0])[0];
	$role="Nothing";
	if($result==0)
		$role="Administrador";
	else if($result==1){
		$role="Emplead";
		if($genero=="M")
			$role=$role."o";
	}
	if($genero=="F")
		$role=$role."a";
	return '<a href="profile.php">'.array_values(select("select nombre from usuario where id=".$_SESSION["id"]."")[0])[0].' '.array_values(select("select apellido_paterno from usuario where id=".$_SESSION["id"]."")[0])[0].'</a><p class="text-muted m-0">'.$role.'</p>';
	echo('<p class="text-muted m-0">'.$role.'</p>');
}

//Funcion que acciona el radiobutton usr_niv
function radiosexo1(){
	if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="1")echo('checked=""');
}
//Funcion que acciona el radiobutton usr_niv
function radiosexo2(){
	if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="0")echo('checked=""');
}

//Funcion que imprime el menu de la parte izquierda
function page_print_leftsidemenu(){
	$role=get_role_usrbyID($_SESSION["id"]);
	echo('
		<aside class="sidebar-navigation">
		<div class="scrollbar-wrapper">
		<div>
		<button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
		<i class="mdi mdi-close"></i>
		</button>
		<!-- User Detail box -->
		<div class="user-details">
		<div class="pull-left">'.
		image_sidebar_menu()  
		.'</div>
		<div class="user-info">'.
		name_and_role_sidebar_menu()
		.'</div></a>
		</div>
		<!--- End User Detail box -->

		<!-- Left Menu Start -->
		<ul class="metisMenu nav" id="side-menu">
		
		<li><a href="dashboard.php"><i class="ti-home"></i> Inicio </a></li>

		<li><a href="sale.php"><span class="label label-custom pull-right"></span> <i class="mdi mdi-cart-outline"></i> Venta </a></li>

		<li><a href="stock_supply.php"><span class="label label-custom pull-right"></span> <i class="mdi mdi-library-plus"></i> Surtir Producto </a></li>');
	if($role=="0"){
		echo('

			<li><a href="stock.php"><span class="label label-custom pull-right"></span> <i class="mdi mdi-store"></i> Inventario </a></li>

			<li><a href="corte.php"><span class="label label-custom pull-right"></span> <i class="mdi mdi-autorenew"></i> Corte de caja</a></li>

			<li><a href="timelapse.php"><span class="label label-custom pull-right"></span> <i class="mdi mdi-timelapse"></i> Linea de tiempo ventas </a></li>
			
			<li class="">
				<a href="javascript: void(0);" aria-expanded="false"><i class="mdi mdi-package-variant-closed"></i> Gestion de Inventario <span class="fa arrow"></span></a>
				<ul class="nav-second-level nav collapse" aria-expanded="false" style="height: 0px;">
					<li><a href="stock_new.php" aria-expanded="true"><i class="mdi mdi-package-variant"></i> Agregar Producto </a></li>
					<li><a href="stock_mod.php" aria-expanded="true"><i class="mdi mdi-autorenew"></i> Modificar Producto </a></li>
					<li><a href="stock_del.php" aria-expanded="true"><i class="mdi mdi-delete-forever"></i> Eliminar Producto </a></li>
				</ul>
			</li>

			
			<li class="">
			<a href="javascript: void(0);" aria-expanded="false"><i class="mdi mdi-lock-outline"></i> Gestion de Usuarios <span class="fa arrow"></span></a>
			<ul class="nav-second-level nav collapse" aria-expanded="false" style="height: 0px;">
			<li><a href="user_new.php" aria-expanded="true"><i class="mdi mdi-account-plus"></i> Nuevo Usuario </a></li>
			<li><a href="user_mod.php" aria-expanded="true"><i class="mdi mdi-account-star-variant"></i> Modificar Usuario </a></li>	
			<li><a href="user_del.php" aria-expanded="true"><i class="mdi mdi-account-remove"></i> Eliminar Usuario</a></li>
			</ul>
			</li>
			

			<li class="">
			<a href="javascript: void(0);" aria-expanded="false"><i class="ti-menu-alt"></i> Administracion del sitio <span class="fa arrow"></span></a>
			<ul class="nav-second-level nav collapse" aria-expanded="false" style="height: 0px;">
			<li><a href="motd.php" aria-expanded="true"><i class="mdi mdi-mail-ru gi-5x"></i> Mensaje del Dia</a></li>
			</ul>
			</li>
			
			</ul>
			<!-- Left Menu End -->
			</div>
			</div><!--Scrollbar wrapper-->
			</aside>');
	}else{
		echo('</ul>
			<!-- Left Menu End -->
			</div>
			</div><!--Scrollbar wrapper-->
			</aside>');
	}
}

//Funcionq ue imprime la parte superior del menu
function page_print_topnavbar(){
	echo('
		<div class="navbar navbar-default" role="navigation">
		<div class="container">
		<div class="">

		<!-- Mobile menu button -->
		<div class="pull-left">
		<button type="button" class="button-menu-mobile visible-xs visible-sm">
		<i class="fa fa-bars"></i>
		</button>
		<span class="clearfix"></span>
		</div>

		<!-- Top nav left menu -->
		<ul class="nav navbar-nav hidden-sm hidden-xs top-navbar-items">
		<li><a href="about.php">Acerca De</a></li>
		<li><a href="help.php">Ayuda</a></li>
		<li><a href="contacts.php">Contacto</a></li>
		</ul>

		<!-- Top nav Right menu -->
		<ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
		<li class="hidden-xs">
		<form role="search" class="navbar-left app-search pull-left">
		<input type="text" placeholder="Buscar..." class="form-control">
		<a href=""><i class="fa fa-search"></i></a>
		</form>
		</li>
			

		<li class="dropdown top-menu-item-xs">'.
		image_top()
		.'<ul class="dropdown-menu">
		<li><a href="profile.php"><i class="ti-user m-r-10"></i> Profile</a></li>
		<li class="divider"></li>
		<li><a href="javascript:logout()"><i class="ti-power-off m-r-10"></i> Logout</a></li>
		</ul>
		</li>
		</ul>
		</div>
		</div> <!-- end container -->
		</div> <!-- end navbar -->');
}


function st($string){
	return "'".$string."'";
}
function err_print($post){
	if(isset($_POST[$post])){
		echo($_POST[$post]);
	}
}

function sweetalert($message, $type){
	if($type=="good"){
		echo('<div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-bottom:0px; margin-left:10px; margin-right:10px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" >
			<span aria-hidden="true">×</span>
			</button>
			<strong>'.$message.'</strong>
			</div>');
	}else if($type=="bad"){
		echo('<div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom:0px; margin-left:10px; margin-right:10px;">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close" >
			<span aria-hidden="true">×</span>
			</button>
			<strong>'.$message.'</strong>
			</div>');
	}else if($type=="alert"){

	}
}

function motd(){
	$nombre=select("select CONCAT(u.nombre,' ',u.apellido_paterno,' ', u.apellido_materno), u.fotografia, m.mensaje, m.fecha from motd as m inner join usuario as u where u.id=m.id_usuario and m.id = ALL(select max(id) from motd)");
	$date=date_create(array_values($nombre[0])[3]);
	$date=date_format($date,"l, d F Y    h:i A");
	echo('<div class="pull-right" style="margin-right: -65px;  padding-top: -40px;">
		<div class="row">
		<div class="pull-left" style="margin-right:10px;">
		<h6 style="margin-left: 15px; ">'.array_values($nombre[0])[0].'</h6>
		<h6 style="margin-left: 15px; ">'.$date.'</h6>
		</div>
		<div class="pull-right" >
		<a href="" class="dropdown-toggle menu-right-item profile" aria-expanded="true"><img src="'.array_values($nombre[0])[1].'" alt="user-img" class="img-circle"> </a>
		</div>
		</div>
		
		</div>
		<br><br>
		<p class="text-muted" style="margin-left: 25px; ">'.array_values($nombre[0])[2].'</p>');
}





?>