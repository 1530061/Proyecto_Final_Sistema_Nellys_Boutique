<?php 
session_start();
include ("lib/db.php");
include ("lib/misc.php");
include ("lib/user_control_lib.php");

if (empty($_SESSION["logg"]))
	header('Location: /final/index.php');
?>


<?php // here start your php file
ob_get_contents();
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Agregar Usuario</title>
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
				<div class="row">
					<div class="col-sm-1 col-md-4 col-lg-1">
						<span class="ti-home gi-5x" style="font-size: 60px; padding-left: 10px;" ></span> 
					</div>
					<div class="col-sm-11 col-md-8 col-lg-11">
						<h1> Tablero </h1>
					</div>
				</div>
				

				
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

					insert_user($file, $tmp);
				}
				?>
				<div class="p-20 m-b-20">
					<hr>
					<form enctype="multipart/form-data" action="user_new.php" id="testx" name="test" class="form-validation" novalidate="" method="post">

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
								<input type="radio" id="inlineRadio1" value="M" name="usr_ge" <?php if(isset($_POST["usr_ge"])){if($_POST["usr_ge"]=="M")echo('checked=""');}else{echo('checked=""');}?>>
								<label for="inlineRadio1"> Masculino </label>
							</div>
							<div class="radio radio-danger radio-inline">
								<input type="radio" id="inlineRadio2" value="F" name="usr_ge" <?php if(isset($_POST["usr_ge"]))if($_POST["usr_ge"]=="F")echo('checked=""'); ?>>
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
								<input type="radio" id="inlineRadio3" value="1" name="usr_niv" <?php if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="1")echo('checked=""'); ?>>
								<label for="inlineRadio3"> Empleado </label>
							</div>
							<div class="radio radio-warning radio-inline" onchange="yesnoCheck2(this);">
								<input type="radio" id="inlineRadio4" value="0" name="usr_niv" <?php if(isset($_POST["usr_niv"]))if($_POST["usr_niv"]=="0")echo('checked=""'); ?> >
								<label for="inlineRadio4"> Administrador </label>
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
							<button type="reset" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
								<i class="mdi mdi-close"></i>Cancelar
							</button>
							<button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
								<i class="mdi mdi-check"></i>Guardar
							</button>
						</div>
					</form>
				</div>
				
				<!-- end container -->

				

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

	<!--Morris Chart-->
	<script src="assets/plugins/morris/morris.min.js"></script>
	<script src="assets/plugins/raphael/raphael-min.js"></script>

	<!-- SweetAlert-->
	<script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
	<script src="assets/pages/jquery.sweet-alert.init.js"></script>

	<!-- Dashboard init -->
	<script src="assets/pages/jquery.dashboard.js"></script>

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



	<!-- App Js -->
	<script src="assets/js/jquery.app.js"></script>

	
	<script>
		function yesnoCheck(that) {
			document.getElementById("emg").style.display = "none";
			document.getElementById("telf").style.display = "none";
			document.getElementById("summer").style.display = "none";
		}
		function yesnoCheck2(that) {
			document.getElementById("emg").style.display = "block" 
			document.getElementById("telf").style.display = "block";
			document.getElementById("summer").style.display = "block";
		}
	</script>
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('.form-validation').parsley();
			$('.summernote').summernote({
                    height: 350,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
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