<?php 
session_start();
include ("lib/db.php");
include ("lib/misc.php");
include ("lib/corte_lib.php");

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
	<?php
		$daten=date_create("now");
		$daten=date_format($daten,"Y-m-d");

		echo("<title id='title'>Corte de caja [".$daten."]</title>");
	?>

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
						<h1 style="color:#D52B2B;"> Corte de caja del dia</h1>
					</div>

				</div>

				<div class="row" style="width:100%; padding-left: 30px;">
					<h5 > <i class="mdi mdi-information-outline"></i> Obtenga un documento en formato PDF, CSV, EXCEL o copie al portapapeles un reporte generado con los valores de la tabla, haciendo click en los botones que se encuentran en la parte superior de la tabl y modifique la hora que quiere que aparezca en el titulo.</h5>
					<label for="timepicker">Hora a mostrar en el documento<span class="text-danger"></span></label>
					<div class="input-group">
	                    <input onchange=(hour()) id="timepicker" name="timepicker" type="text" class="form-control">
	                    <span class="input-group-addon"><i class="mdi mdi-clock"></i></span>
                	</div>
				</div>

				
				<div class="p-20 m-b-20">
					<div id="tabla_div">
						
						<div id="table_cont">
							<table id="exampletable" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%">
						    	<?php
						    		fill_datatable_corte();
						    	?>
						    </table>
						</div>
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

	<script type="text/javascript">
		var titleStart=document.getElementById("title").innerHTML;
        function hour() {
           	document.getElementById("title").innerHTML=titleStart+" "+document.getElementById("timepicker").value;
        }
    </script>

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
			function open_del(id) {
				window.open('stock_mod.php?id='+id,'_self');
			}
			function open_mod(id){
				window.open('stock_del.php?id='+id,'_self');
			}
			
			function open_supp(id){
				window.open('stock_supply.php?id='+id,'_self');
			}

			$(document).ready(function() {
			    $('#exampletable').DataTable( {
			        dom: 'Bfrtip',
			        buttons: [
			            'copyHtml5',
			            'excelHtml5',
			            'csvHtml5',
			            'pdfHtml5'
			        ]
			    } );
			} );
						

		</script>

	</body>
	</html>