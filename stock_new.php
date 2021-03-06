<?php 
session_start();
include ("lib/db.php");               //Funciones encargada de la BD
include ("lib/misc.php");             //Funciones compartidas en todos los formularios
include ("lib/stock_lib.php");		  //Funciones llenado de tablas busqueda


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
	<title>Agregar Producto</title>
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
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1 style="color:#D52B2B;"><span class="mdi mdi-package-variant" style="font-size: 60px; padding-left: 10px;" ></span>  Agregar Producto </h1>
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
						if(isset($_POST["prod_cod"])){

							$file=$_FILES['userfile']['name'];
							$tmp=$_FILES['userfile']['tmp_name'];

							insert_product($file, $tmp);
						}
					?>
					<br>
				</div>

				
				<div class="p-20 m-b-20">

					<form enctype="multipart/form-data" action="stock_new.php" id="testx" name="test" class="form-validation" novalidate="" method="post">
	
					

						<div class="form-group">
							<label for="prod_cod">Codigo<span class="text-danger">*</span></label>
							<input type="text" name="prod_cod" parsley-trigger="change" required="" class="form-control" id="prod_cod" value="<?php err_print('prod_cod');?>">
						</div>


						<div class="form-group">
							<label for="prod_name">Nombre<span class="text-danger">*</span></label>
							<input type="text" name="prod_name" parsley-trigger="change" required="" class="form-control" id="prod_name" value="<?php err_print('prod_name');?>">
						</div>
						<div class="form-group">
							<label for="prod_desc">Descripcion<span class="text-danger"></span></label>
							<textarea class="form-control" id="prod_desc" name="prod_desc" rows="5"></textarea>	
						</div>
						<div class="form-group">
							<label for="prod_tipo">Tipo<span class="text-danger">*</span></label>
							<select class="form-control" id="prod_tipo" name="prod_tipo" required="" onchange="updateSize.call(this, event)"">
								<?php
									fill_types_clothes();
								?>
                            </select>
						</div>
						
						<div class="form-group">
							<label for="prod_talla">Talla<span class="text-danger">*</span></label>
							<select class="form-control" id="prod_talla" name="prod_talla" required="">
								<?php
									fill_start_size();
								?>
							</select>
							
						</div>

						<div class="form-group">
							<label for="prod_precio">Precio <span class="text-danger">*</span></label>
							<input type="number" name="prod_precio" class="form-control" min="1" id="prod_precio" style="text-align: left;  padding-right: 10px;" value=1>
						</div>
						<div class="form-group">
							<label for="prod_cant">Cantidad que se ingresan al inventario <span class="text-danger">*</span></label>
							<input type="number" name="prod_cant" class="form-control" itd="prod_cant" min="1" style="text-align: left;  padding-right: 10px;" value=1>
						</div>
						<label>Vista Previa</label>
							<div class="thumb-xl member-thumb m-b-10 center-block">
								<img src="prod_img\0.png" id="prev_foto" class="img img-thumbnail" style="max-height:130px" alt="profile-image" >
							</div>
						<label>Fotografia<span class="text-danger"></span></label>
						<div class="form-group m-b-0">
							<input type="file" class="filestyle" name="userfile" data-buttonname="btn-primary" id="filestyle-5" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);" onchange="readURL(this);">
							<div class="bootstrap-filestyle input-group">
								<span class="group-span-filestyle input-group-btn" tabindex="0">
									
								</span>
							</div>         
						</div>
						<br>
						<br>
						<div class="form-group text-right m-b-0">
							<button onclick="gotop();" type="reset" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
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

		function updateSize(event) {
			id=this.options[this.selectedIndex].value;
			getOutput(id);
		    
		}
	</script>
	
	<script type="text/javascript">
		function getOutput(id) {
			getRequest(
		      'lib/searchsize.php?id_tipo='+id, 
		       drawOutput,  
		       drawError,
		       id  
		       );
			return false;
		}  

		//Muestra error en la solicitud Error
		function drawError() {
			var container = document.getElementById('output');
			container.innerHTML = 'Bummer: there was an error!';
		}
		
		//Funcion que manda al elemento superior de la pantalla
		function gotop(){
		    $('html, body').animate({
		        scrollTop: $("#page-right-content").offset().top
		    }, 500);
		}
		//Respuesta
		function drawOutput(responseText, id) {
			console.log(responseText);		
			$("#prod_talla").html(responseText);
		}
		//Manejador de solicitud
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
		    		success(req.responseText, id) : error(req.status);
		    	}
		    }
		    req.open("GET", url, true);
		    req.send(null);
		    return req;
		}
	</script>
</body>
</html>