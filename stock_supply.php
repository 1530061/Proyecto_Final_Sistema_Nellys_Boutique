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
							<span class="mdi mdi-autorenew" style="font-size: 60px; padding-left: 10px;" ></span> 
						</div>
						<div class="col-sm-11 col-md-8 col-lg-11">
							<h1 style="color:#D52B2B;"> Modificar Producto </h1>
						</div>

					</div>



					<?php


					if(isset($_POST["prod_cod"]) && isset($_POST["prod_cant_sup"])){
						supply_product();
					}
					?>

					<div class="p-20 m-b-20">
						<div id="error">
						</div>
						<div class="row">
							<div class= "col-lg-12">
								<h3 style="color:#6A2E98;" class="header-title m-t-0"> Busqueda un solo producto</h3>
								<h5 > <i class="mdi mdi-information-outline"></i> Ingrese en el buscador el codigo o el nombre de cualquier producto registrado para ver toda su informacion y modificarlo.</h5>
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
					</div>
						<div class="p-20 m-b-20">
							<form enctype="multipart/form-data" action="stock_supply.php" id="prodmod_from" name="prodmod_from" class="form-validation" novalidate="" method="post" style="display:none;">
								<div class="row" id="contain_form">
									<h3>Producto encontrado para surtir:</h3>
									<br>
									<div class="col-lg-7">
										<div class="form-group">
											<div class="col-lg-3">
												<h4>Codigo:</h4>
											</div>
											<div class="col-lg-9">
												<input type="text" name="prod_cod" parsley-trigger="change" required="" class="form-control" id="prod_cod" readonly value="">
											</div>									
												<br>
											<br>
											<div class="form-group">
												<label for="prod_name">Nombre<span class="text-danger"></span></label>
												<input type="text" disabled="true" name="prod_name" parsley-trigger="change" required="" class="form-control" id="prod_name" value="">
											</div>
											<div class="form-group">
												<label for="prod_tip">Tipo<span class="text-danger"></span></label>
												<input type="text" disabled="true" name="prod_tip" parsley-trigger="change" required="" class="form-control" id="prod_tip" value="">
											</div>
											<div class="form-group">
												<label for="prod_tall">Talla<span class="text-danger"></span></label>
												<input type="text" disabled="true" name="prod_tall" parsley-trigger="change" required="" class="form-control" id="prod_tall" value="">
											</div>			
											<br>
										</div>
									</div>
									<div class="col-lg-5" style="padding-left: 50px;">
										<div><center>
											<img src="prod_img\0.png" id="fotografia" class="img img-thumbnail" style=" max-height:200px" alt="FORMATO NO SOPORTADO, SELECCIONE NUEVA FOTO">

											
											</center>
										</div>
										<label for="prod_cant">Actualmente en Inventario<span class="text-danger"></span></label>
											<input  style="font-size:30px;" type="text" disabled="true" name="prod_cant" class="form-control" id="prod_cant" style="text-align: left;  padding-right: 10px;">
										<br>
									</div>

								</div>
								<div class="row">
									<div class="col-lg-10">
										<h4>Cantidad a surtir</h4>
										<div class="form-group">
											<label for="prod_cant_sup">Ingrese la cantidad de unidades que va a agregar al producto.<span class="text-danger"></span></label>
											<input type="number" name="prod_cant_sup" class="form-control" id="prod_cant_sup" min="1" style="text-align: left;  padding-right: 10px; font-size:30px;" value=1>
										</div>
									</div>
									<div class="col-lg-2">
										<button class="btn btn-icon btn-success" style="height:100px; width:100px"> <i class="mdi mdi-check"></i> Agregar </button>
									</div>
								</div>
							</form>
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


				//Select 2 buscador de nombres y usuarios
				 //Elementos a modificar
				$(document).ready(function() {
					var select2 = $('.js-example-basic-single').select2({ placeholder: "Codigo o Nombre del Producto " });
				});
				$('.js-example-basic-single').on('change', function() {
					var $select = $(".js-example-basic-single").parent().find("select"); // it's <select> element
					var value = $select.val(); 
					//document.getElementById("tabla_div").style.display = "none";
					document.getElementById('prod_cod').value= value;
					$('html, body').animate({
				        scrollTop: $("#contain_form").offset().top
				    }, 500);
					for($i=0;$i<elem.length;$i++)
						getOutput("'"+value+"'", $i);
				})

				$(document).ready(function() {
				    $('#exampletable').DataTable({
				    	"searching": false,
					    "drawCallback": function( settings ) {
					        $("#exampletable").wrap( "<div class='table-responsive'></div>" );
					    }
					});
				});

				var elem = ["prod_name","prod_desc","prod_tip","prod_tall","prod_precio", "prod_cant", "fotografia"];
				function callFromTable(value){
					document.getElementById('prod_cod').value= value;
					//document.getElementById("tabla_div").style.display = "none";
					//document.getElementById('contain_form').scrollIntoView();
				    $('html, body').animate({
				        scrollTop: $("#contain_form").offset().top
				    }, 500);
					for($i=0;$i<elem.length;$i++){
						getOutput("'"+value+"'", $i);
					}
				}

							// handles drawing an error message

				// handles the click event for link 1, sends the query
				function getOutput(id,tipo) {
					getRequest(
				      'lib/searchbycode_products.php?id="'+id+'"&t='+tipo, // URL for the PHP file
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
				
				var responsePrevTipo;
				// handles the response, adds the html
				function drawOutput(responseText, tipo) {
					//RADIOBUTTON GENERO
					elem_id=elem[tipo];
					//alert(responseText)
					if(tipo!=1 && tipo!=4){
						if(tipo==6){
							document.getElementById(elem_id).src= responseText;
						}else{
							document.getElementById(elem_id).value= responseText;
							if(tipo==2){
								$.get('lib/searchsize.php?type=2&val='+responseText, function(data) {
								  document.getElementById('prod_tip').value= data;
								});
							}else if(tipo==3){
								$.get('lib/searchsize.php?type=3&val='+responseText, function(data) {
								  document.getElementById('prod_tall').value= data;
								});
							}
						}
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
				    document.getElementById("prodmod_from").style.display="block";
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


			function getOutput2(id,talla) {
				getRequest2(
			      'lib/searchsize.php?id_tipo='+id+'&talla='+talla+'&n=0', // URL for the PHP file
			       drawOutput2,  // handle successful request
			       drawError,
			       id  // handle error
			       );
				return false;
			}  

			// handles drawing an error message
			function updateSize(event) {
				id=this.options[this.selectedIndex].value;
				getOutput2(id);
			    
			}

			// handles the response, adds the html
			function drawOutput2(responseText) {
				$("#prod_talla").html(responseText);

				
			}
			// helper function for cross-browser request object
			function getRequest2(url, success, error, tipo) {
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
			    		success(req.responseText) : error(req.status);
			    	}
			    }
			    req.open("GET", url, true);
			    req.send(null);
			    return req;
			}
			function animateToTop(){
			    $('html, body').animate({
			        scrollTop: $("#contain_form").offset().top
			    }, 500);
			}
			</script>


			<?php
				if(isset($_GET['id'])){
					$exists=array_values(select("select codigo from producto where codigo='".$_GET['id']."'")[0])[0];
					if($exists!="0"){
						echo '<script type="text/javascript">',
						     	'callFromTable(\''.$_GET['id'].'\');',
						     	'animateToTop();',
						     '</script>'
	     				   				   
     				    	
						;
					}else{
						echo('<script>
						$.ajax({url: "lib/stock_lib.php?type=1"}).done(function( html ) {
						    $("#error").append(html);
						});
						</script>');
					}
				}
			?>
		</body>
		</html>