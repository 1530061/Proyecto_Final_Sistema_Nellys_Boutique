<?php 
session_start();
include ("lib/db.php");               //Funciones encargada de la BD
include ("lib/misc.php");             //Funciones compartidas en todos los formularios
include ("lib/stock_lib.php");		  //Contiene funciones de llenado de las tablas de busqueda

////Funciones del formulario
	//Llena la tabla de la busqueda
	function fill_datatable_prod_del_upd(){
		echo('
		 <thead>
	        <tr>
	            <th>Codigo</th>
	            <th>Nombre</th>
	          	<th>Tipo</th>
	          	<th>Talla</th>
	          	<th>Cantidad Stock</th>
	          	<th>Precio</th>
	          	<th>Actualizar</th>
	          	<th>Eliminar</th>
				<th>Surtir</th>
	
	        </tr>
	    </thead>
	    <tbody>
	    ');

		$table = select("select p.codigo, p.nombre as ne, tp.nombre, t.talla, p.cantidad_stock, p.precio from producto p inner join tipo_producto tp on tp.id = p.id_tipo inner join talla t on p.id_talla=t.id where activo=1");

	
	    for($i=0;$i<sizeof($table);$i++){
	    	$pattern = '/\s*/m';
   			$replace = '';
    		$id=array_values($table[$i])[0];
			$id=preg_replace( $pattern, $replace,$id );
			echo('
				<tr>
					<td>'.array_values($table[$i])[0].'</td>
					<td>'.array_values($table[$i])[1].'</td>
					<td>'.array_values($table[$i])[2].'</td>
					<td>'.array_values($table[$i])[3].'</td>
					<td>'.array_values($table[$i])[4].'</td>
					<td>'.array_values($table[$i])[5].'</td>
					<td><center><button class="btn btn-icon btn-warning" onclick="open_del(\''.$id.'\')"> <i class="fa fa-wrench"></i> </button></center></td>
					<td><center><button class="btn btn-icon btn-danger" onclick="open_mod(\''.$id.'\')"> <i class="fa fa-remove"></i> </button></center></td>
					<td><center><button class="btn btn-icon btn-success" onclick="open_supp(\''.$id.'\')"> <i class="mdi mdi-plus-circle-outline"></i> </button></center></td>
				</tr>
				');
		}
	    echo('</tbody>');	
	}


//Se revisa que la conexion tenga una sesion activa sino se redirige al index.php
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
	<title>Inventario</title>
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
                    <h1 style="color:#D52B2B;"><span class="mdi mdi-store gi-5x" style="font-size: 60px; padding-left: 10px;" ></span>  Inventario</h1>
                </div>



				<div class="p-20 m-b-20">
					<div id="tabla_div">
						<div class="row">
							<div class= "col-lg-12">
								<h3 style="color:#6A2E98;" class="header-title m-t-0"> Productos en el sistema</h3>
								<h5 > <i class="mdi mdi-information-outline"></i> Utilice el buscador para encontrar cualquier producto y haga click en los botones de Actualizar, Eliminar y Surtir para sus debidas operaciones.</h5>
							</div>

						</div>
						<div id="table_cont">
							<table id="exampletable" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%">
						    	<?php
						    		fill_datatable_prod_del_upd();
						    	?>
						    </table>
						</div>
					</div>

					<div id="contain_form">
						<form enctype="multipart/form-data" action="stock_mod.php" id="prodmod_from" name="prodmod_from" class="form-validation" novalidate="" method="post" style="display:none;">

							<hr>
							<div class="form-group">
								<div class="col-lg-4">
									<h4>Detalles del producto con el codigo</h4>
								</div>
								<div class="col-lg-5">
									<input type="text" name="prod_cod" parsley-trigger="change" required="" class="form-control" id="prod_cod" readonly value="<?php err_print('prod_cod');?>">
								</div>
								<div class="col_lg-3">
									<a href="stock_mod.php"><button type="button" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
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
							<label for="prod_cant">Cantidad de productos en el inventario<span class="text-danger">*</span></label>
							<input type="number" name="prod_cant" class="form-control" id="prod_cant" min="1" style="text-align: left;  padding-right: 10px;" value=1>
						</div>
						<label>Fotografia</label>
												<div class="pull-right">
							<span class="text-warning"> * No se modificara la imagen si se deja en blanco</span>
						</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="thumb-xl member-thumb m-b-10 center-block">
										<h6 style="padding-left:10px;"> Imagen Actual </h6>
										<img src="prod_img\0.png" id="fotografia" class="img img-thumbnail" style="max-height:150px" alt="FORMATO NO SOPORTADO, SELECCIONE NUEVA FOTO">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="thumb-xl member-thumb m-b-10 center-block">
										<h6 style="padding-left:10px;""> Vista Previa </h6>
										<img src="prod_img\0.png" id="prev_foto" class="img img-thumbnail" style="max-height:150px" alt="FORMATO NO SOPORTADO, SELECCIONE NUEVA FOTO">
									</div>
								</div>
						</div>
						<br>
						<br>
						<br>
						<div class="form-group m-b-0">
							<input type="file" class="filestyle" name="userfile" data-buttonname="btn-primary" id="filestyle-5" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);" onchange="readURL(this);">
							<div class="bootstrap-filestyle input-group">
								<span class="group-span-filestyle input-group-btn" tabindex="0">
									
								</span>
							</div>         
						</div>
						<br>
						<br>
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


	<!-- App Js -->
	<script src="assets/js/jquery.app.js"></script>

	<!-- fun-->
	<script src="lib/fun.js"></script>


	<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
	<script src="assets/plugins/switchery/switchery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>




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




	<!-- App Js -->
	<script src="assets/js/jquery.app.js"></script>

	<script>
			function open_del(id) {
				window.open('stock_mod.php?id='+id,'_self');
			}
			function open_mod(id){
				window.open('stock_del.php?id='+id,'_self');
			}
			
			function open_supp(id){
				window.open('stock_supply.php?id='+id,'_self');
			}

			//Select 2 buscador de nombres y usuarios
			 //Elementos a modificar
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

			//Creacion de la tabla de los botones
			$(document).ready(function() {
			    $('#exampletable').DataTable({
				    "drawCallback": function( settings ) {
				        $("#exampletable").wrap( "<div class='table-responsive'></div>" );
				    }
				});
			});
		</script>
	</body>
	</html>