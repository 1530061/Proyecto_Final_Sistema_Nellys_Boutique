<?php 
session_start();
include ("lib/db.php");               //Funciones encargada de la BD
include ("lib/misc.php");             //Funciones compartidas en todos los formularios
include ("lib/stock_lib.php");		  //Funciones llenado de tablas busqueda

	
//Funciones del formulario

	//Eliminar un producto quitando su estado de activo
	function delete_product(){
		$id=$_POST['prod_cod'];
		$filepath=array_values(select("select fotografia from producto where codigo='".$id."'")[0])[0];
		if($filepath!='prod_img\0.png' && substr($filepath,0,9)=='prod_img\\'){
			unlink($filepath);
		}
		
		$columns=["activo","fotografia"];
		$values=['0',st('prod_img\\\\0.png')];
		$table="producto";
		$condition="where codigo='".$id."'";
		update($columns,$values,$table,$condition);
		sweetalert('Producto con el codigo['.$_POST["prod_cod"].'] eliminado correctamente.</strong>',"good");
	}


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
	<title>Eliminar Producto</title>
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

				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1 style="color:#D52B2B;"><span class="mdi mdi-delete-forever" style="font-size: 60px; padding-left: 10px;" ></span>  Eliminar Producto </h1>
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
									delete_product();
								}
							?>
							<br>
				</div>


				
				<div class="p-20 m-b-20">
					<div id="error"></div>
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
					<br>
					<br>
					<div id="tabla_div">
						<div class="row">
							<div class= "col-lg-12">
								<h3 style="color:#6A2E98;" class="header-title m-t-0"> Todos los productos registrados</h3>
								<h5 > <i class="mdi mdi-information-outline"></i> Haga click en cualquier producto para ver toda su informacion y modificarlo.</h5>
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
						<form enctype="multipart/form-data" action="stock_del.php" id="prodmod_from" name="prodmod_from" class="form-validation" novalidate="" method="post" style="display:none;">

							<hr>
							<div class="form-group">
								<div class="col-lg-4">
									<h4>Detalles del producto a eliminar con el codigo</h4>
								</div>
								<div class="col-lg-5">
									<input type="text" name="prod_cod" parsley-trigger="change" required="" class="form-control" id="prod_cod" readonly value="<?php err_print('prod_cod');?>">
								</div>
								<div class="col_lg-3">
									<a href="stock_del.php"><button type="button" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
									<i class="ti-back-right"></i>Ver Todos los productos
									</button></a>
								</div>
							
							<br>

							<!--
						<div class="form-group">
							<label for="prod_cod">Codigo<span class="text-danger">*</span></label>
							<input type="text" name="prod_cod" parsley-trigger="change" required="" class="form-control" id="prod_cod" value="<?php err_print('prod_cod');?>">
						</div>-->
						<div class="form-group">
							<label for="prod_name">Nombre<span class="text-danger">*</span></label>
							<input type="text" name="prod_name" parsley-trigger="change" required="" class="form-control" readonly id="prod_name" value="<?php err_print('prod_name');?>">
						</div>
						<div class="form-group">
							<label for="prod_desc">Descripcion<span class="text-danger"></span></label>
							<textarea class="form-control" id="prod_desc" name="prod_desc" readonly rows="5"></textarea>	
						</div>
						<div class="form-group">
							<label for="prod_tipo">Tipo<span class="text-danger">*</span></label>
							<select class="form-control" id="prod_tipo" name="prod_tipo" required="" readonly onchange="updateSize.call(this, event)"">
								<?php
									fill_types_clothes();
								?>
                            </select>
						</div>
						
						<div class="form-group">
							<label for="prod_talla">Talla<span class="text-danger">*</span></label>
							<select class="form-control" id="prod_talla" readonly name="prod_talla" required="">
								<?php
									fill_start_size();
								?>
							</select>
							
						</div>
						<div class="form-group">
							<label for="prod_precio">Precio <span class="text-danger">*</span></label>
							<input type="number" name="prod_precio" class="form-control" min="1" readonly id="prod_precio" style="text-align: left;  padding-right: 10px;" value=1>
						</div>
						<div class="form-group">
							<label for="prod_cant">Cantidad en inventario <span class="text-danger">*</span></label>
							<input type="number" name="prod_cant" class="form-control" readonly id="prod_cant" min="1" style="text-align: left;  padding-right: 10px;" value=1>
						</div>
						<label>Fotografia</label>
						<div class="form-group">
							
							<div class="thumb-xl member-thumb m-b-10 center-block">
								<h6 style="padding-left:10px;"> Imagen Actual </h6>
								<img src="prod_img\0.png" id="fotografia" class="img img-thumbnail" readonly style="max-height:150px" alt="FORMATO NO SOPORTADO, SELECCIONE NUEVA FOTO">
							</div>
							
						</div>
						<br>
						<div class="form-group text-right m-b-0">
							<button class="btn btn-danger btn-bordered btn-lg" id="sub" type="submit" style="width:35%" >
								<i class="fa fa-remove"></i>Eliminar
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


    <!-- Sweet-Alert  -->
    <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="assets/pages/jquery.sweet-alert.init.js"></script>


	<!-- App Js -->
	<script src="assets/js/jquery.app.js"></script>

	<script>
			//Alerta al eliminar
			$(document).on('click', '#sub', function(e) {
		    e.preventDefault();
		    swal({
		 		title: "¿Esta seguro que desea eliminar el producto?",
		        text: "No podra recuperar la informacion relacionada con el producto",
		        type: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#DD6B55",
		        confirmButtonText: "Si",
		        cancelButtonText: "Cancelar",
		        closeOnConfirm: false
		    }).then(function (result) {
		        $('#prodmod_from').submit();
		    });
		});

	</script>

	<script>


			//Select 2 buscador de nombres y usuarios
			$(document).ready(function() {
				var select2 = $('.js-example-basic-single').select2({ placeholder: "Codigo o Nombre del Producto " });
			});
			$('.js-example-basic-single').on('change', function() {
				var $select = $(".js-example-basic-single").parent().find("select"); // it's <select> element
				var value = $select.val(); 
				document.getElementById("tabla_div").style.display = "none";
				document.getElementById('prod_cod').value= value;
				$('html, body').animate({
			        scrollTop: $("#contain_form").offset().top
			    }, 500);
				for($i=0;$i<elem.length;$i++)
					getOutput("'"+value+"'", $i);
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

			//Funcion que se llama al hacer click en una fila
			var elem = ["prod_name","prod_desc","prod_tipo","prod_talla","prod_precio", "prod_cant", "fotografia"];
			function callFromTable(value){
				document.getElementById('prod_cod').value= value;
				document.getElementById("tabla_div").style.display = "none";
				//document.getElementById('contain_form').scrollIntoView();
			    $('html, body').animate({
			        scrollTop: $("#contain_form").offset().top
			    }, 500);
				for($i=0;$i<elem.length;$i++){
					getOutput("'"+value+"'", $i);
				}
			}

			//Ajax llamada
			function getOutput(id,tipo) {
				getRequest(
			      'lib/searchbycode_products.php?id="'+id+'"&t='+tipo, // URL for the PHP file
			       drawOutput,  // handle successful request
			       drawError,
			       tipo  // handle error
			       );
				return false;
			}  

			//Error
			function drawError() {
				var container = document.getElementById('output');
				container.innerHTML = 'Bummer: there was an error!';
			}
			
			var responsePrevTipo;
			//Manejador del resultado
			function drawOutput(responseText, tipo) {
				elem_id=elem[tipo];
				if(tipo==2){
					document.getElementById(elem_id).value= responseText;
					responsePrevTipo=responseText;
				}else if(tipo==3){
					console.log(responseText);
					getOutput2(responsePrevTipo, responseText);
				}else if(tipo==6){
					document.getElementById(elem_id).src= responseText;
				}else{
					document.getElementById(elem_id).value= responseText;
				}
				
			}
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
			    document.getElementById("prodmod_from").style.display="block";
			    return req;
			}
		</script>

		<script type="text/javascript">
		function getOutput2(id,talla) {
			getRequest2(
		      'lib/searchsize.php?id_tipo='+id+'&talla='+talla, 
		       drawOutput2,  
		       drawError,
		       id  
		       );
			return false;
		}  

		
		function updateSize(event) {
			id=this.options[this.selectedIndex].value;
			getOutput2(id);
		    
		}

		function drawOutput2(responseText) {
			$("#prod_talla").html(responseText);
		}
		// helper function for cross-browser request object
		function getRequest2(url, success, error, tipo) {
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
		    		success(req.responseText) : error(req.status);
		    	}
		    }
		    req.open("GET", url, true);
		    req.send(null);
		    return req;
		}
		</script>

		<?php
			//Muestra error
			if(isset($_GET['id'])){
				$exists=array_values(select("select codigo from producto where codigo='".$_GET['id']."'")[0])[0];
				if($exists!="0"){
					echo '<script type="text/javascript">',
					     	'callFromTable(\''.$_GET['id'].'\');',
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