<?php 
session_start();
include ("lib/db.php");
include ("lib/misc.php");
include ("lib/stock_lib.php");

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
	<title>Eliminar Usuario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Sweet Alert -->
    <link href="assets/plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

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
				<div class="row" style="height:70px;">
					<div style="color:#D52B2B;" class="col-sm-1 col-md-4 col-lg-1">
						<span class="mdi mdi-account-remove" style="font-size: 60px; padding-left: 10px;" ></span> 
					</div>
					<div class="col-sm-11 col-md-8 col-lg-11">
						<h1 style="color:#D52B2B;"> Eliminar Usuario </h1>
					</div>

				</div>



				<?php
				$tabla=select("select p.codigo, p.nombre, p.descripcion, tp.nombre, t.talla, p.cantidad_stock from producto p inner join tipo_producto tp on tp.id = p.id_tipo inner join talla t on p.id_talla=t.id where activo=1");
				for($i=0;$i<sizeof($tabla);$i++){
					for($j=0;$j<sizeof($tabla[0]);$j++){
						echo(array_values($tabla[$i])[$j]);
						echo('   ');
					}
					echo('<br>');

				}
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

					//delete_user();
					//$values=[$_POST["name"],$_POST["usr"],$_POST["p"];
					
				}
				?>
				<div class="p-20 m-b-20">
					<div class="row">
						<div class= "col-lg-12">
							<h3 style="color:#6A2E98;" class="header-title m-t-0"> Busqueda un solo producto</h3>
							<h5 > <i class="mdi mdi-information-outline"></i> Ingrese en el buscador el codigo o el nombre de cualquier producto registrado para ver toda su informacion y eliminarlo.</h5>
						</div>
					</div>
					<div class="row">
						<div class= "col-lg-12" style="padding-top: 15px;">
							<select class="js-example-basic-single" name="state" style="width:100%">
								<option value=""></option>
								<?php
								fill_search_prod();
								?>
							</select>
						</div>
					</div>
					<br>
					<br>
					<div id="tabla_div">
						<div class="row">
							<div class= "col-lg-12">
								<h3 style="color:#6A2E98;" class="header-title m-t-0"> Todos los productos registrados</h3>
								<h5 > <i class="mdi mdi-information-outline"></i> Haga click en cualquier producto para ver toda su informacion y eliminarlo.</h5>
							</div>

						</div>
						<div id="table_cont">
							<table id="exampletable" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%">
						    	<?php
						    		fill_datatable_prod();
						    	?>
						    </table>
						</div>
					</div>

					<div id="contain_form">
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
								<img src="prod_img\0.png" id="prev_foto" class="img img-thumbnail" alt="profile-image" >
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


    <!-- Sweet-Alert  -->
    <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="assets/pages/jquery.sweet-alert.init.js"></script>


	<!-- App Js -->
	<script src="assets/js/jquery.app.js"></script>

			<script>
			
				$(document).on('click', '#sub', function(e) {
			    e.preventDefault();
			    swal({
			 		title: "¿Esta seguro que desea eliminar el usuario?",
			        text: "No podra recuperar la informacion relacionada al usuario",
			        type: "warning",
			        showCancelButton: true,
			        confirmButtonColor: "#DD6B55",
			        confirmButtonText: "Si",
			        cancelButtonText: "Cancelar",
			        closeOnConfirm: false
			    }).then(function (result) {
			        $('#usrmod_from').submit();
			    });
			});

		</script>
	<script>
			function callFromTable(value){
				document.getElementById('prod_cod').value= value;
				document.getElementById("tabla_div").style.display = "none";
				//document.getElementById('contain_form').scrollIntoView();
			    $('html, body').animate({
			        scrollTop: $("#contain_form").offset().top
			    }, 500);
				for($i=0;$i<elem.length;$i++)
					getOutput(value, $i);
			}

			//Select 2 buscador de nombres y usuarios
			var elem = ["usr_nombre","usr_app","usr_apm","datepicker-autoclose","usr_user", "usr_em", "usr_tel","usr_niv1","usr_ge2","sum","fotografia"]; //Elementos a modificar
			$(document).ready(function() {
				var select2 = $('.js-example-basic-single').select2({ placeholder: "Usuario o Nombre Completo " });
			});
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

			$(document).ready(function() {
			    $('#exampletable').DataTable({
			    	"searching": false,
				    "drawCallback": function( settings ) {
				        $("#exampletable").wrap( "<div class='table-responsive'></div>" );
				    }
				});
			});


			function callFromTable(value){
				document.getElementById('prod_cod').value= value;
				document.getElementById("tabla_div").style.display = "none";
				//document.getElementById('contain_form').scrollIntoView();
			    $('html, body').animate({
			        scrollTop: $("#contain_form").offset().top
			    }, 500);
				for($i=0;$i<elem.length;$i++)
					getOutput(value, $i);
			}

			// handles the click event for link 1, sends the query
			function getOutput(id,tipo) {
				getRequest(
			      'lib/searchbycode_products.php?id='+id+'&t='+tipo, // URL for the PHP file
			       drawOutput,  // handle successful request
			       drawError,
			       tipo  // handle error
			       );
				return false;
			}  

			// handles drawing an error message
			function drawError() {
				var container = document.getElementById('output');
				container.innerHTML = 'Bummer: there was an error!';
			}
			
			
			// handles the response, adds the html
			function drawOutput(responseText, tipo) {
				//RADIOBUTTON GENERO
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
						document.getElementById(elem_id).innerHTML= responseText;
					}else if(tipo==10){
						document.getElementById(elem_id).src= responseText;
					}
					else
						document.getElementById(elem_id).value= responseText;
				}
			}
			// helper function for cross-browser request object
			function getRequest(url, success, error, tipo) {
				var req = false;
				try{
			        // most browsers
			        req = new XMLHttpRequest();
			    } catch (e){
			        // IE
			        try{
			        	req = new ActiveXObject("Msxml2.XMLHTTP");
			        } catch(e) {
			            // try an older version
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