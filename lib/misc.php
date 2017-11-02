<?php




	function image_top(){
		$result = select("select fotografia from usuario where id=".$_SESSION["id"]."")[0];
		if (!empty($result)) {
			return '<a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="'.array_values($result)[0].'" alt="user-img" class="img-circle"> </a>';
		}else{
			return '<a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="usr_img\0.png" alt="user-img" class="img-circle"> </a>';	
		}
	}

	function image_sidebar_menu(){
		$result = select("select fotografia from usuario where id=".$_SESSION["id"]."")[0];
		if (!empty($result)) {
			return '<img src="'.array_values($result)[0].'" alt="" class="thumb-md img-circle">';			
		}else{
			return '<img src="usr_img\0.png" alt="" class="thumb-md img-circle">';
		}
	}
	function get_img_usrbyID($id){
		$result = select("select fotografia from usuario where id=".$id."")[0];
		if (!empty($result)) {
			return array_values($result)[0];			
		}else{
			return "usr_img\0.png";
		}
	}
	function get_single_name_usrbyID($id){
		return array_values(select("select nombre from usuario where id='".$id."'")[0])[0]. '';
	}
	function get_app_usrbyID($id){
		return array_values(select("select apellido_paterno from usuario where id='".$id."'")[0])[0]. '';
	}
	function get_apm_usrbyID($id){
		return array_values(select("select apellido_materno from usuario where id='".$id."'")[0])[0]. '';
	}
	function get_date_usrbyID($id){
		return array_values(select("select fecha_nac from usuario where id='".$id."'")[0])[0]. '';
	}


	function get_name_usrbyID($id){
		return array_values(select("select nombre from usuario where id='".$id."'")[0])[0].' '.array_values(select("select apellido_paterno from usuario where id='".$id."'")[0])[0];
	}
	function get_role_usrbyID($id){
		$result = array_values(select("select nivel from usuario where id=".$id."")[0])[0];
		$genero = array_values(select("select genero from usuario where id=".$id."")[0])[0];
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
		return $role;
	}

	function get_bio_usrbyID($id){
		return array_values(select("select biografia from usuario where id=".$id."")[0])[0];
	}

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

	function radiosexo1(){
		if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="1")echo('checked=""');
	}
	function radiosexo2(){
		if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="0")echo('checked=""');
	}

	function user_info($id){
		$usr=select("select nombre,apellido_paterno, apellido_materno, fecha_nac, genero, email, telefono, biografia from usuario where id=".$id."");
		 echo('<form enctype="multipart/form-data" action="user_mod.php" id="usrmod_from" name="test" class="form-validation" novalidate="" method="post" style="display:block;">

					                        <div class="form-group">
									            <label for="userName">Nombre<span class="text-danger">*</span></label>
									            <input type="text" name="usr_nombre" parsley-trigger="change" required="" class="form-control" id="usr_nombre" value="'.array_values($usr[0])[0].'">
									        </div>
																	<div class="form-group">
									            <label for="usr_app">Apellido Paterno<span class="text-danger">*</span></label>
									            <input type="text" name="usr_app" parsley-trigger="change" required="" class="form-control" id="usr_app" value="'.array_values($usr[0])[1].'">
									        </div>
																	<div class="form-group">
									            <label for="usr_amp">Apellido Materno<span class="text-danger"></span></label>
									            <input type="text" name="usr_apm" parsley-trigger="change" class="form-control" id="usr_apm" value="'.array_values($usr[0])[2].'">
									        </div>
									        <div class="form-group">
									        		<label for="datepicker-autoclose">Fecha de Nacimiento<span class="text-danger">*</span></label>
									        		<div class="input-group">
									                <input type="text" name="usr_fn" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" parsley-trigger="change" required="" value="'.array_values($usr[0])[3].'">
									                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
									            </div>
									        </div>
					                        <label>Genero<span class="text-danger">*</span></label>
									        <div class="form-group">
								        		<div class="radio radio-info radio-inline">
									                <input type="radio" id="inlineRadio1" value="M" name="usr_ge" checked="" ">
									                <label for="inlineRadio1"> Masculino </label>
									            </div>
									            <div class="radio radio-danger radio-inline">
													<input type="radio" id="inlineRadio2" value="F" name="usr_ge">
									                <label for="inlineRadio2"> Femenino </label>
									            </div>
									        </div>
					                        <label>Fotografia<span class="text-danger"></span></label>
					                        <div class="form-group m-b-0">
					                              <input type="file" class="filestyle" name="userfile" data-buttonname="btn-primary" id="filestyle-5" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
					                              <div class="bootstrap-filestyle input-group"> 
					                              			<span class="group-span-filestyle input-group-btn" tabindex="0">
					                              				
					                              			</span>
					                              </div>         
					                        </div>
					                        <hr>
					                        <div class="form-group">
					                            <label for="usr_user">Usuario<span class="text-danger">*</span></label>
					                            <input type="text" name="usr_user" parsley-trigger="change" required="" placeholder="" class="form-control" id="usr_user">
					                        </div>
					                        <div class="form-group">
					                            <label for="pass1">Contraseña<span class="text-danger">*</span></label>
					                            <input id="pass1" name="usr_pass" type="password" placeholder="Password" required="" class="form-control">
					                        </div>
					                        <div class="form-group">
					                            <label for="passWord2">Confirmar Contraseña <span class="text-danger">*</span></label>
					                            <input data-parsley-equalto="#pass1" type="password" required="" placeholder="Password" class="form-control" id="passWord2">
					                        </div>
					                        <label >Nivel<span class="text-danger">*</span></label>
					                        <div class="form-group">
					                        		<div class="radio radio-info radio-inline" onchange="yesnoCheck(this);">
					                                <input type="radio" id="inlineRadio3" value="1" name="usr_niv" checked="">>
					                                <label for="inlineRadio3"> Empleado </label>
					                            </div>
					                            <div class="radio radio-warning radio-inline" onchange="yesnoCheck2(this);">
																					<input type="radio" id="inlineRadio4" value="0" name="usr_niv" >
					                                <label for="inlineRadio4"> Administrador </label>
					                            </div>
					                        </div>
											<div class="form-group" id="emg" style="display:none;">
					                            <label for="usr_em">Email (Requerido para Administradores)<span class="text-danger">*</span></label>
					                            <input type="email" name="usr_em" parsley-trigger="change" class="form-control" id="usr_em" value="'.array_values($usr[0])[5].'">
					                        </div>
											<div class="form-group" id="telf">
									            <label for="usr_tel">Telefono <span class="text-danger">*</span></label>
									            <input type="tel" name="usr_tel" parsley-trigger="change" placeholder="" class="form-control" id="usr_tel" value="'.array_values($usr[0])[6].'">
									        </div>
					                        <div class="form-group" id="summer" style="display:block">
					                        	<label for="summernote">Biografia<span class="text-danger"></span></label>
													<fieldset>
														
														<p class="container">
															<textarea class="input-block-level" id="summernote" name="content" rows="2">
															'.array_values($usr[0])[7].'
															</textarea>
														</p>
													</fieldset>
												
					                        </div>
					                        <hr>
					                        <div class="form-group text-right m-b-0">
					                        		<button type="reset" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
					                                <i class="mdi mdi-close"></i>Cancelar
					                            </button>
					                            <button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
					                                <i class="mdi mdi-check"></i>Guardar
					                            </button>
					                        </div>
					                      </form>');
	}

	function contacts_actual_info($id){
		$usr=select("select nombre,apellido_paterno, apellido_materno, fecha_nac, genero, email, telefono, biografia from usuario where id=".$id."");
		 echo('<form enctype="multipart/form-data" action="profile.php" id="testx" name="test" class="form-validation" novalidate="" method="post">

		        <div class="form-group">
		            <label for="userName">Nombre<span class="text-danger">*</span></label>
		            <input type="text" name="usr_nombre" parsley-trigger="change" required="" class="form-control" id="usr_nombre" value="'.array_values($usr[0])[0].'">
		        </div>
										<div class="form-group">
		            <label for="usr_app">Apellido Paterno<span class="text-danger">*</span></label>
		            <input type="text" name="usr_app" parsley-trigger="change" required="" class="form-control" id="usr_app" value="'.array_values($usr[0])[1].'">
		        </div>
										<div class="form-group">
		            <label for="usr_amp">Apellido Materno<span class="text-danger"></span></label>
		            <input type="text" name="usr_apm" parsley-trigger="change" class="form-control" id="usr_apm" value="'.array_values($usr[0])[2].'">
		        </div>
		        <div class="form-group">
		        		<label for="datepicker-autoclose">Fecha de Nacimiento<span class="text-danger">*</span></label>
		        		<div class="input-group">
		                <input type="text" name="usr_fn" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" parsley-trigger="change" required="" value="'.array_values($usr[0])[3].'">
		                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
		            </div>
		        </div>
		        <label>Genero<span class="text-danger">*</span></label>
		        <div class="form-group">
	        		<div class="radio radio-info radio-inline">
		                <input type="radio" id="inlineRadio1" value="M" name="usr_ge" checked="" ">
		                <label for="inlineRadio1"> Masculino </label>
		            </div>
		            <div class="radio radio-danger radio-inline">
						<input type="radio" id="inlineRadio2" value="F" name="usr_ge">
		                <label for="inlineRadio2"> Femenino </label>
		            </div>
		        </div>
		        <hr>
				<div class="form-group" id="emg">
		            <label for="usr_em">Email <span class="text-danger">*</span></label>
		            <input type="email" name="usr_em" parsley-trigger="change" class="form-control" id="usr_em" value="'.array_values($usr[0])[5].'">
		        </div>
				<div class="form-group" id="telf">
		            <label for="usr_tel">Telefono <span class="text-danger">*</span></label>
		            <input type="tel" name="usr_tel" parsley-trigger="change" placeholder="" class="form-control" id="usr_tel" value='.array_values($usr[0])[6].'">
		        </div>
		       	<div class="form-group" id="summer">
					                        	<label for="summernote">Biografia<span class="text-danger"></span></label>
													<fieldset>
														
														<p class="container">
															<textarea class="input-block-level" id="summernote" name="content" rows="2">
															</textarea>
														</p>
													</fieldset>
												
					                        </div>
		        <hr>
		        <div class="form-group text-right m-b-0">
		        		<button type="reset" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
		                <i class="mdi mdi-close"></i>Cancelar
		            </button>
		            <button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
		                <i class="mdi mdi-check"></i>Guardar
		            </button>
		        </div>
		      </form>');
	}


	function contacts_actual_infoback($id){
		 echo('<form enctype="multipart/form-data" action="profile.php" id="testx" name="test" class="form-validation" novalidate="" method="post">

				                        <div class="form-group">
				                            <label for="userName">Nombre<span class="text-danger">*</span></label>
				                            <input type="text" name="usr_nombre" parsley-trigger="change" required="" class="form-control" id="usr_nombre" value="'.err_print('usr_nombre').'">
				                        </div>
																<div class="form-group">
				                            <label for="usr_app">Apellido Paterno<span class="text-danger">*</span></label>
				                            <input type="text" name="usr_app" parsley-trigger="change" required="" class="form-control" id="usr_app" value="'.err_print('usr_app').'">
				                        </div>
																<div class="form-group">
				                            <label for="usr_amp">Apellido Materno<span class="text-danger"></span></label>
				                            <input type="text" name="usr_apm" parsley-trigger="change" class="form-control" id="usr_apm" value="'.err_print('usr_apm').'">
				                        </div>
				                        <div class="form-group">
				                        		<label for="datepicker-autoclose">Fecha de Nacimiento<span class="text-danger">*</span></label>
				                        		<div class="input-group">
				                                <input type="text" name="usr_fn" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" parsley-trigger="change" required="" value="'.err_print('usr_fn').'">
				                                <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
				                            </div>
				                        </div>
				                        <label>Genero<span class="text-danger">*</span></label>
				                        <div class="form-group">
				                        		<div class="radio radio-info radio-inline">
				                                <input type="radio" id="inlineRadio1" value="M" name="usr_ge" '.radio1().'>
				                                <label for="inlineRadio1"> Masculino </label>
				                            </div>
				                            <div class="radio radio-danger radio-inline">
																				<input type="radio" id="inlineRadio2" value="F" name="usr_ge"'.radio2().'>
				                                <label for="inlineRadio2"> Femenino </label>
				                            </div>
				                        </div>
				                        <label>Fotografia<span class="text-danger"></span></label>
				                        <div class="form-group m-b-0">
				                              <input type="file" class="filestyle" name="userfile" data-buttonname="btn-primary" id="filestyle-5" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">
				                              <div class="bootstrap-filestyle input-group">
				                              			<span class="group-span-filestyle input-group-btn" tabindex="0">
				                              				
				                              			</span>
				                              </div>         
				                        </div>
				                        <hr>
				                        <div class="form-group">
				                            <label for="usr_user">Usuario<span class="text-danger">*</span></label>
				                            <input type="text" name="usr_user" parsley-trigger="change" required="" placeholder="" class="form-control" id="usr_user">
				                        </div>
				                        <div class="form-group">
				                            <label for="pass1">Contraseña<span class="text-danger">*</span></label>
				                            <input id="pass1" name="usr_pass" type="password" placeholder="Password" required="" class="form-control">
				                        </div>
				                        <div class="form-group">
				                            <label for="passWord2">Confirmar Contraseña <span class="text-danger">*</span></label>
				                            <input data-parsley-equalto="#pass1" type="password" required="" placeholder="Password" class="form-control" id="passWord2">
				                        </div>
				                        <label >Nivel<span class="text-danger">*</span></label>
				                        <div class="form-group">
				                        		<div class="radio radio-info radio-inline" onchange="yesnoCheck(this);">
				                                <input type="radio" id="inlineRadio3" value="1" name="usr_niv" '.radiosexo1().'>
				                                <label for="inlineRadio3"> Empleado </label>
				                            </div>
				                            <div class="radio radio-warning radio-inline" onchange="yesnoCheck2(this);">
																				<input type="radio" id="inlineRadio4" value="0" name="usr_niv" '.radiosexo1().' >
				                                <label for="inlineRadio4"> Administrador </label>
				                            </div>
				                        </div>

										<div class="form-group" id="emg" style="display:none;">
				                            <label for="usr_em">Email (Requerido para Administradores)<span class="text-danger">*</span></label>
				                            <input type="email" name="usr_em" parsley-trigger="change" class="form-control" id="usr_em" value="'.err_print('usr_em').'">
				                        </div>
										<div class="form-group" id="telf" style="display:none;">
				                            <label for="usr_tel">Telefono (Requerido para Administradores)<span class="text-danger">*</span></label>
				                            <input type="tel" name="usr_tel" parsley-trigger="change" placeholder="" class="form-control" id="usr_tel">
				                        </div>
				                        <div class="form-group" id="summer" style="display:none;">
				                        	<label for="summernote">Biografia<span class="text-danger"></span></label>
												<fieldset>
													
													<p class="container">
														<textarea class="input-block-level" id="summernote" name="content" rows="2">
														</textarea>
													</p>
												</fieldset>
											
				                        </div>
				                        <hr>
				                        <div class="form-group text-right m-b-0">
				                        		
				                            <button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
				                                <i class="mdi mdi-check"></i>Guardar
				                            </button>
				                        </div>
				                      </form>');
	}
	function contacts_information($id){
		$usr=select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno), telefono, email from usuario where id=".$id."");
		echo('<div class="panel-body">
                <div class="m-b-20">
                    <strong>Nombre Completo</strong>
                    <br>
                    <p class="text-muted">'.array_values($usr[0])[0].'</p>
                </div>
                <div class="m-b-20">
                    <strong>Telefono</strong>
                    <br>
                    <p class="text-muted">'.array_values($usr[0])[1].'</p>
                </div>
                <div class="m-b-20">
                    <strong>Correo Electronico</strong>
                    <br>
                    <p class="text-muted">'.array_values($usr[0])[2].'</p>
                </div>
            </div>');
	}

	function page_print_leftsidemenu(){
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

                                <li><a href="venta.php"><span class="label label-custom pull-right"></span> <i class="mdi mdi-cart-outline"></i> Venta </a></li>

                                <li><a href="inventario.html" aria-expanded="true"><i class="mdi mdi-package-variant-closed"></i> Inventario</a></li>
								
                								<li><a href="javascript: void(0);" aria-expanded="true"><i class="mdi mdi-clipboard-outline"></i> Apartado de Productos</a></li>
                								
                								<li><a href="javascript: void(0);" aria-expanded="true"><i class="mdi mdi-account-outline"></i> Gestion de Clientes</a></li>
                								
                				 <li class="">
                                    <a href="javascript: void(0);" aria-expanded="false"><i class="mdi mdi-lock-outline"></i> Gestion de Usuarios <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav collapse" aria-expanded="false" style="height: 0px;">
                                        <li><a href="user_new.php" aria-expanded="true"><i class="mdi mdi-account-plus"></i> Nuevo Usuario </a></li>
                                        <li><a href="user_mod.php" aria-expanded="true"><i class="mdi mdi-account-star-variant"></i> Modificar Usuario </a></li>	
                                        <li><a href="tables-advanced.html">Pendiente</a></li>
                                    </ul>
                                </li>
                											

                                <li class="">
                                    <a href="javascript: void(0);" aria-expanded="false"><i class="ti-menu-alt"></i> Administracion del sitio <span class="fa arrow"></span></a>
                                    <ul class="nav-second-level nav collapse" aria-expanded="false" style="height: 0px;">
                                        <li><a href="motd.php">Mensaje del Dia</a></li>
                                        <li><a href="tables-advanced.html">Pendiente</a></li>
                                    </ul>
                                </li>
								
                            </ul>
							<!-- Left Menu End -->
                        </div>
                    </div><!--Scrollbar wrapper-->
                </aside>');
	}

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
		                                <li><a href="#">Acerca De</a></li>
		                                <li><a href="#">Ayuda</a></li>
		                                <li><a href="contactos.php">Contacto</a></li>
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
		                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-10"></i> Settings</a></li>
		                                        <li><a href="javascript:test()"><i class="ti-lock m-r-10"></i> Lock screen</a></li>
		                                        <li class="divider"></li>
		                                        <li><a href="javascript:logout()"><i class="ti-power-off m-r-10"></i> Logout</a></li>
		                                    </ul>
		                                </li>
		                            </ul>
		                        </div>
		                    </div> <!-- end container -->
		                </div> <!-- end navbar -->');
	}

	function get_name_cashier(){
		$nombre = array_values(select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno) from usuario where id=".$_SESSION["id"]."")[0])[0];
		echo('<h6>'.
				$nombre
			.'</h6>');
	}

	function get_date(){
		$dateTime = new DateTime('now'); 
		echo('<h6>'.
				$dateTime->format("l, d F Y    h:i A")
			.'</h6>');
	}

	function st($string){
		return "'".$string."'";
	}
	function err_print($post){
		if(isset($_POST[$post])){
			echo($_POST[$post]);
		}
	}

	function update_profile($id){
		$date=date_create($_POST["usr_fn"]);
		$date=date_format($date,"Y-m-d H:i:s");


		$columns=["nombre", "apellido_paterno", "apellido_materno", "fecha_nac", "genero", "email", "telefono", "biografia"];
		$values=[st($_POST["usr_nombre"]),st($_POST["usr_app"]),st($_POST["usr_apm"]), st($date), st($_POST["usr_ge"]), st($_POST["usr_em"]), st($_POST["usr_tel"]), st($_POST["content"])];
		$table="usuario";
		$condition="where id=".$id;
		update($columns,$values,$table,$condition);
		sweetalert('Perfil actualizado correctamente.</strong>',"good");
	   
		
	}
	function insert_user($file, $tmp){
		
		if(isset($_POST["usr_niv"])){
			if(((empty($_POST["usr_em"]) && $_POST["usr_niv"]==1) || (!empty($_POST["usr_em"]) && $_POST["usr_niv"]==0)) && ((empty($_POST["usr_tel"]) && $_POST["usr_niv"]==1) || (!empty($_POST["usr_tel"]) && $_POST["usr_niv"]==0)) ){
				$users=select("select user from usuario where user='".$_POST["usr_user"]."'")[0];
				if(array_values($users)[0]=="0"){

					$nombre = $_POST["usr_user"];
					//Preparacion insert
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

	function allcontacts(){
		$id_users=select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno), email, fotografia, telefono, id from usuario where nivel=0");
		
		for($i=0;$i<sizeof($id_users);$i++){
			//if($i%3==0 )
				 //echo('<div class="row">');
			echo('
                  <div class="col-md-4">
                      <div class="text-center card-box">
                        <div class="clearfix"></div>
                        <div class="member-card" style=" height:250px">
                            <div class="thumb-xl member-thumb m-b-10 center-block">
                                <img src="'.array_values($id_users[$i])[2].'" class="img-circle img-thumbnail" alt="profile-image">
                                <i class="mdi mdi-star-circle member-star text-success" title="Usuario Administrador"></i>
                            </div>

                            <div class="">
                                <h4 class="m-b-5">'.array_values($id_users[$i])[0].'</h4>
                             	<p class="text-muted">'.array_values($id_users[$i])[3].' <span> | <span> <a href="#" class="text-pink">'.array_values($id_users[$i])[1].'</a> </span></p>
                            </div>

                           
                            <a href="profile.php?id='.array_values($id_users[$i])[4].'"><button type="button" class="btn btn-default btn-sm m-t-10">Ver Perfil</button></a>
                        </div>
                      </div>
                  </div>'
              );
			 //if($i%3==0 )
				 //echo('</div>');

			//echo(array_values($id_users[$i])[0]."<br>");
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
	function change_motd(){
		$dateTime = new DateTime('now'); 
		$dateTime=date_format($dateTime,"Y-m-d H:i:s");
		if(!empty($_POST["content"])){
			$columns=["mensaje", "id_usuario", "fecha"];
			$values=[st($_POST["content"]), $_SESSION["id"], st($dateTime)];
			insert($columns, $values, "motd");
		}else{
			sweetalert("No puede dejar el mensaje del dia vacio.","bad");
		}
	}

	function fill_search_mod_usr(){
		$user_info = select("select id, CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno) from usuario");
		echo('<optgroup label="Nombre Completo">');
		for($i=0;$i<count($user_info);$i++){
			echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[1].'</option>');
		}
		echo('<optgroup label="Usuario">');
		$user_info = select("select id, user from usuario");
		for($i=0;$i<count($user_info);$i++){
			echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[1].'</option>');
		}
		
		

	}



?>