	<?php 
	session_start();
	include ("lib/db.php");               //Funciones encargada de la BD
	include ("lib/misc.php");             //Funciones compartidas en todos los formularios
	include ("lib/user_control_lib.php"); //Funciones compartidas entre la seccion de control de usuarios

	if (empty($_SESSION["logg"]))
		header('Location: /final/index.php');
	?>


	<?php 
	ob_get_contents();
	ob_end_clean();
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Modificar Usuario</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
		<meta content="Coderthemes" name="author" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

		<!-- Plugins css-->
		<link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/plugins/switchery/switchery.min.css">
		<link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


		<!-- DataTables -->
		<link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>


		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="assets/css/metisMenu.min.css" rel="stylesheet">
		<!-- Icons CSS -->
		<link href="assets/css/icons.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/plugins/summernote/summernote.css" rel="stylesheet" />





	</head>


	<body>

		<div id="page-wrapper">

			<!-- Top Bar Start -->
			<div class="topbar">

				<!-- LOGO -->
				<div class="topbar-left">
					<div class="">
						<a href="index.php" class="logo">
							<img src="assets/images/logo.png" alt="logo" class="logo-lg" />
							<img src="assets/images/logo_sm.png" alt="logo" class="logo-sm hidden" />
						</a>
					</div>
				</div>

				<!-- Top navbar -->
				<?php
				page_print_topnavbar();
				?>
			</div>
			<!-- Top Bar End -->


			<!-- Page content start -->
			<div class="page-contentbar">

				<!--left navigation start-->
				<?php
				page_print_leftsidemenu();
				?>
				<!--left navigation end-->

				<!-- START PAGE CONTENT -->
				<div id="page-right-content">
					<!-- Logo and name -->
					<div class="col-sm-12 col-md-12 col-lg-12">
						<h1 style="color:#D52B2B;"><span class="mdi mdi-account-star-variant" style="font-size: 60px; padding-left: 10px;" ></span>    Modificar Usuario </h1>
					
						<?php
							if($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST) &&
								empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0)
							{
								echo('<div class="alert alert-danger alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">×</span>
									</button>
									<strong> La imagen excede el tamaño permitido (>8MB)
									</div>');
							}
							if(isset($_POST["usr_nombre"])){
								
								$file=$_FILES['userfile']['name'];
								$tmp=$_FILES['userfile']['tmp_name'];

								update_user($file, $tmp);
							}
						?>
					</div>
					<div class="p-20 m-b-20">
						
						<div class="row">
							<div class= "col-lg-12">
								<h3 style="color:#6A2E98;" class="header-title m-t-0"> Busqueda un solo usuario</h3>
								<h5 > <i class="mdi mdi-information-outline"></i> Ingrese en el buscador el nombre o el usuario de cualquier usuario registrado para ver toda su informacion y modificarlo.</h5>
							</div>
						</div>
						<div class="row">
							<div class= "col-lg-12" style="padding-top: 15px;">
								<select class="js-example-basic-single" name="state" style="width:100%">
									<option value=""></option>
									<?php
									fill_search_mod_usr();
									?>
								</select>
							</div>
						</div>
						<br>
						<br>
						<div id="tabla_div">
							<div class="row">
								<div class= "col-lg-12">
									<h3 style="color:#6A2E98;" class="header-title m-t-0"> Todos los usuario registrados</h3>
									<h5 > <i class="mdi mdi-information-outline"></i> Haga click en cualquier usuario para ver toda su informacion y modificarlo.</h5>
								</div>

							</div>
							<div id="table_cont">
								<table id="exampletable" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%">
									<?php
									fill_datatable_usr_mod();
									?>
								</table>
							</div>
						</div>


						<div id="contain_form">
							<form enctype="multipart/form-data" action="user_mod.php" id="usrmod_from" name="test" class="form-validation" novalidate="" method="post" style="display:none;">


								<hr>
								<div class="form-group">
									<div class="col-lg-4">
										<h4>Detalles del empleado con el id</h4>
									</div>
									<div class="col-lg-5">
										<input type="text" name="usr_id" parsley-trigger="change" required="" class="form-control" id="usr_id" readonly value="">
									</div>
									<div class="col_lg-3">
										<a href="user_mod.php"><button type="button" class="btn btn-danger btn-bordered btn-lg" style="width:220px">
											<i class="ti-back-right"></i>Ver Todos los Usuarios
										</button></a>
									</div>
									
									<br>
									<br>
									<div class="form-group">
										<label for="userName">Nombre<span class="text-danger">*</span></label>
										<input type="text" name="usr_nombre" parsley-trigger="change" required="" class="form-control" id="usr_nombre" value="<?php err_print('usr_nombre');?>">
									</div>
									<div class="form-group">
										<label for="usr_app">Apellido Paterno<span class="text-danger">*</span></label>
										<input type="text" name="usr_app" parsley-trigger="change" required="" class="form-control" id="usr_app" value="<?php err_print('usr_app');?>">
									</div>
									<div class="form-group">
										<label for="usr_amp">Apellido Materno<span class="text-danger"></span></label>
										<input type="text" name="usr_apm" parsley-trigger="change" class="form-control" id="usr_apm" value="<?php err_print('usr_apm');?>">
									</div>
									<div class="form-group">
										<label for="datepicker-autoclose">Fecha de Nacimiento<span class="text-danger">*</span></label>
										<div class="input-group">
											<input type="text" name="usr_fn" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" parsley-trigger="change" required="" value="<?php err_print('usr_fn');?>">
											<span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
										</div>
									</div>
									<label>Genero<span class="text-danger">*</span></label>
									<div class="form-group">
										<div class="radio radio-info radio-inline">
											<input type="radio" id="usr_ge1" value="M" name="usr_ge" <?php if(isset($_POST["usr_ge"])){if($_POST["usr_ge"]=="M")echo('checked=""');}else{echo('checked=""');}?>>
											<label for="usr_ge1"> Masculino </label>
										</div>
										<div class="radio radio-danger radio-inline">
											<input type="radio" id="usr_ge2" value="F" name="usr_ge" <?php if(isset($_POST["usr_ge"]))if($_POST["usr_ge"]=="F")echo('checked=""'); ?>>
											<label for="usr_ge2"> Femenino </label>
										</div>
									</div>
									<label>Fotografia</label>
									<div class="row">
										<div class="col-lg-6">
											<div class="thumb-xl member-thumb m-b-10 center-block">
												<h6 style="padding-left:10px;"> Imagen Actual </h6>
												<img src="usr_img\0.png" id="fotografia" class="img-circle img-thumbnail" style="max-height:150px" alt="FORMATO NO SOPORTADO, SELECCIONE NUEVA FOTO">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="thumb-xl member-thumb m-b-10 center-block">
												<h6 style="padding-left:10px;""> Vista Previa </h6>
												<img src="usr_img\0.png" id="prev_foto" class="img-circle img-thumbnail" style="max-height:150px" alt="FORMATO NO SOPORTADO, SELECCIONE NUEVA FOTO">
											</div>
										</div>
									</div>
									<br>
									<br>
									<br>
									<div class="pull-right">
										<span class="text-warning"> * No se modificara la imagen si se deja en blanco</span>
									</div>
									<br>
									<div class="form-group m-b-0">
										<input type="file" class="filestyle" name="userfile" data-buttonname="btn-primary" id="filestyle-5"  tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);" onchange="readURL(this);">
										<div class="bootstrap-filestyle input-group"> 
											<span class="group-span-filestyle input-group-btn" tabindex="0" id="summmer">

											</span>
										</div>         
									</div>
									<hr>
									<div class="form-group">
										<label for="usr_user">Usuario<span class="text-danger">*</span></label>
										<input type="text" name="usr_user" parsley-trigger="change" required="" placeholder="" class="form-control" id="usr_user">
									</div>
									<label>Contraseña</label>
									<div class="pull-right">
										<span class="text-danger"> * Cambio de contraseña obligatorio</span>
									</div>
									<div class="form-group">

										<input id="pass1" name="usr_pass" type="password" placeholder="Password" required="" class="form-control">
									</div>
									<div class="form-group">
										<label for="usr_pass">Confirmar Contraseña <span class="text-danger">*</span></label>
										<input data-parsley-equalto="#pass1" type="password" required="" placeholder="Password" class="form-control" id="usr_pass">
									</div>
									<label >Nivel<span class="text-danger">*</span></label>
									<div class="form-group">
										<div class="radio radio-info radio-inline" onchange="yesnoCheck(this);">
											<input type="radio" id="usr_niv1" value="1" name="usr_niv" <?php if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="1")echo('checked=""'); ?>>
											<label for="usr_niv1"> Empleado </label>
										</div>
										<div class="radio radio-warning radio-inline" onchange="yesnoCheck2(this);">
											<input type="radio" id="usr_niv2" value="0" name="usr_niv" <?php if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="0")echo('checked=""'); ?> >
											<label for="usr_niv2"> Administrador </label>
										</div>
									</div>
									<div class="form-group" id="emg" style="display:none;">
										<label for="usr_em">Email (Requerido para Administradores)<span class="text-danger">*</span></label>
										<input type="email" name="usr_em" parsley-trigger="change" class="form-control" id="usr_em" value="<?php err_print('usr_em');?>">
									</div>
									<div class="form-group" id="telf" style="display:none;">
										<label for="usr_tel">Telefono (Requerido para Administradores)<span class="text-danger">*</span></label>
										<input type="tel" name="usr_tel" parsley-trigger="change" placeholder="" class="form-control" id="usr_tel">
									</div>
									<div class="form-group" id="sum" style="display:none;">
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
										<a href="user_mod.php"><button type="button" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
											<i class="mdi mdi-close"></i>Cancelar
										</button></a>
										<button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
											<i class="mdi mdi-check"></i>Guardar
										</button>
									</div>
								</form>
							</div>
						</div>


						<div class="footer">

							<div>
								<strong>Sistema Nelly's Boutique</strong> - Copyright &copy; 2017
							</div>
						</div> <!-- end footer -->

					</div>
					<!-- End #page-right-content -->

				</div>
				<!-- end .page-contentbar -->
			</div>
			<!-- End #page-wrapper -->


			<!-- js placed at the end of the document so the pages load faster -->

			<script src="assets/js/jquery-2.1.4.min.js"></script>
			<script src="assets/js/bootstrap.min.js"></script>
			<script src="assets/js/metisMenu.min.js"></script>
			<script src="assets/js/jquery.slimscroll.min.js"></script>


			<!-- SweetAlert-->
			<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
			<script src="assets/pages/jquery.sweet-alert.init.js"></script>

			<!-- App Js -->
			<script src="assets/js/jquery.app.js"></script>

			<!-- fun-->
			<script src="lib/fun.js"></script>


			<!--filestyle -->
			<script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>

			<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
			<script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
			<script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
			<script src="assets/plugins/switchery/switchery.min.js"></script>
			<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>

			<script src="assets/plugins/moment/moment.js"></script>
			<script src="assets/plugins/timepicker/bootstrap-timepicker.js"></script>
			<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
			<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script src="assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
			<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
			<script src="assets/plugins/summernote/summernote.min.js"></script>

			<!-- form advanced init js -->
			<script src="assets/pages/jquery.form-advanced.init.js"></script>

			<!-- Datatable js -->
			<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
			<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
			<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
			<script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
			<script src="assets/plugins/datatables/jszip.min.js"></script>
			<script src="assets/plugins/datatables/pdfmake.min.js"></script>
			<script src="assets/plugins/datatables/vfs_fonts.js"></script>
			<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
			<script src="assets/plugins/datatables/buttons.print.min.js"></script>
			<script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
			<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
			<script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
			<script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
			<script src="assets/plugins/datatables/dataTables.colVis.js"></script>
			<script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

			<!-- init -->
			<script src="assets/pages/jquery.datatables.init.js"></script>


			<!-- App Js -->
			<script src="assets/js/jquery.app.js"></script>

			<script type="text/javascript">
				function readURL(input) {
					if (input.files && input.files[0]) {
						var reader = new FileReader();

						reader.onload = function (e) {
							$('#prev_foto').attr('src', e.target.result);
						}

						reader.readAsDataURL(input.files[0]);
					}
				}
			</script>
			<script>

				//Select 2 buscador de nombres y usuarios
				var elem = ["usr_nombre","usr_app","usr_apm","datepicker-autoclose","usr_user", "usr_em", "usr_tel","usr_niv1","usr_ge2","summernote","fotografia" ]; //Elementos a modificar
				$(document).ready(function() {
					var select2 = $('.js-example-basic-single').select2({ placeholder: "Usuario o nombre completo" });
				});
				//Select 2
				$('.js-example-basic-single').on('change', function() {
					var $select = $(".js-example-basic-single").parent().find("select"); // it's <select> element
					var value = $select.val(); 
					document.getElementById("tabla_div").style.display = "none";
					document.getElementById('usr_id').value= value;
					$('html, body').animate({
						scrollTop: $("#contain_form").offset().top
					}, 500);
					for($i=0;$i<elem.length;$i++)
						getOutput(value, $i);
				})

				//Creacion de tabla
				$(document).ready(function() {
					$('#exampletable').DataTable({
						"searching": false,
						"drawCallback": function( settings ) {
							$("#exampletable").wrap( "<div class='table-responsive'></div>" );
						}
					});
				});


				//Evento de llamado por celda
				function callFromTable(value){
					document.getElementById('usr_id').value= value;
					document.getElementById("tabla_div").style.display = "none";
					$('html, body').animate({
						scrollTop: $("#contain_form").offset().top
					}, 500);
					for($i=0;$i<elem.length;$i++)
						getOutput(value, $i);
				}


				// Salida
				function getOutput(id,tipo) {
					getRequest(
				      'lib/searchbyid.php?id='+id+'&t='+tipo, // URL for the PHP file
				       drawOutput,  // handle successful request
				       drawError,
				       tipo  // handle error
				       );
					return false;
				}  

				// Error
				function drawError() {
					var container = document.getElementById('output');
					container.innerHTML = 'Bummer: there was an error!';
				}
				
				
				// Salida
				function drawOutput(responseText, tipo) {
					elem_id=elem[tipo];				
					if(tipo==8 || tipo==7){
						responseText=responseText.replace(/(\r\n|\n|\r)/gm,"");
						if(responseText=="1"){
							elem_id="usr_niv1";
							yesnoCheck();
						}else if(responseText=="0"){
							elem_id="usr_niv2";
							yesnoCheck2();
						}else if(responseText=="M"){
							elem_id="usr_ge1";
						}else{
							elem_id="usr_ge2";
						}
						document.getElementById(elem_id).checked = "true";
					}else{
						if(tipo==9){
							$('textarea[name="content"]').summernote('code',responseText);
						}else if(tipo==10){
							document.getElementById(elem_id).src= responseText;
						}
						else
							document.getElementById(elem_id).value= responseText;
					}
				}
				// Salida
				function getRequest(url, success, error, tipo) {
					var req = false;
					try{
				        req = new XMLHttpRequest();
				    } catch (e){
				        try{
				        	req = new ActiveXObject("Msxml2.XMLHTTP");
				        } catch(e) {
				            try{
				            	req = new ActiveXObject("Microsoft.XMLHTTP");
				            } catch(e) {
				            	return false;
				            }
				        }
				    }
				    if (!req) return false;
				    if (typeof success != 'function') success = function () {};
				    if (typeof error!= 'function') error = function () {};
				    req.onreadystatechange = function(){
				    	if(req.readyState == 4) {
				    		return req.status === 200 ? 
				    		success(req.responseText, tipo) : error(req.status);
				    	}
				    }
				    req.open("GET", url, true);
				    req.send(null);
				    document.getElementById("usrmod_from").style.display="block";
				    return req;
				}

				//Radiobuttons administrador
				function yesnoCheck(that) {
					document.getElementById("emg").style.display = "none";
					document.getElementById("telf").style.display = "none";
					document.getElementById("sum").style.display = "none";
				}
				function yesnoCheck2(that) {
					document.getElementById("emg").style.display = "block" 
					document.getElementById("telf").style.display = "block";
					document.getElementById("sum").style.display = "block";
				}
			</script>

			<script type="text/javascript">
				//Summernote
				$(document).ready(function() {
					$('.form-validation').parsley();
					$('.summernote').summernote({
						height: 350,                 
						minHeight: null,            
						maxHeight: null,             
						focus: false                 
					});
				});
				$(document).ready(function() {
					$('#summernote').summernote({
						height: "170px"
					});
				});
				var postForm = function() {
					var content = $('textarea[name="content"]').html($('#summernote').code());
				}


			</script>
		</body>
		</html>