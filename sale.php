<?php 
session_start();
include ("lib/db.php");               //Funciones encargada de la BD
include ("lib/misc.php");             //Funciones compartidas en todos los formularios

/////Funciones del formulario

	//Funcion que llena las opciones con los id y nombres de los productos simulando un buscador
	function fill_search_prod(){
		$user_info = select("select codigo from producto where activo=1");
		echo('<optgroup label="Codigo">');
		for($i=0;$i<count($user_info);$i++){
			echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[0].'</option>');
		}
		echo('<optgroup label="Nombre">');
		$user_info = select("select codigo, nombre from producto where activo=1");
		for($i=0;$i<count($user_info);$i++){
			echo('<option value="'.array_values($user_info[$i])[0].'">'.array_values($user_info[$i])[1].'</option>');
		}
	}	

	//Funcion que retorna el nombre del cajero
	function get_name_cashier(){
		$nombre = array_values(select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno) from usuario where id=".$_SESSION["id"]."")[0])[0];
		echo('<h6>'.
			$nombre
			.'</h6>');
	}

	//Funcion que retorna la fecha 
	function get_date(){
		$dateTime = new DateTime('now'); 
		echo('<h6 id="fecha">'.
			$dateTime->format("l, d F Y    h:i A")
			.'</h6>');
	}

//Se revisa que la conexion tenga una sesion activa sino se redirige al index.php
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
	<title>Venta</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
	<meta content="Coderthemes" name="author" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- MetisMenu CSS -->
	<link href="assets/css/metisMenu.min.css" rel="stylesheet">
	<!-- Icons CSS -->
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="assets/css/style.css" rel="stylesheet">


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

    			<!-- init -->
			<script src="assets/pages/jquery.datatables.init.js"></script>


			<!-- App Js -->
			<script src="assets/js/jquery.app.js"></script>

</head>


<body>

	<div id="page-wrapper">

		<!-- Top Bar Start -->
		<div class="topbar">

			<!-- LOGO -->
			<div class="topbar-left">
				<div class="">
					<a href="index.html" class="logo">
						<img src="assets/images/logo.png" alt="logo" class="logo-lg" />
						<img src="assets/images/logo_sm.png" alt="logo" class="logo-sm hidden" />
					</a>
				</div>
			</div>

			<!-- Top navbar -->
			<?php
			page_print_topnavbar();
			?>
				<!-- Top Bar End -->


				<!-- Page content start -->
				<div class="page-contentbar">

					<!--left navigation start-->
					<?php
					page_print_leftsidemenu();
					?>
					<!--left navigation end-->

					<!-- START PAGE CONTENT -->
					<div id="page-right-content" style="padding-top:70px;">
						<!-- Top, cashier and date-->
						<div class=row style="height:0px;">
							<div class="col-sm-1 col-lg-1">
									<h6> 
										Atiende: 
									</h6>
							</div>
							<div class="col-sm-7 col-lg-7" style="padding-left: 15px;">
								<?php
									get_name_cashier();
								?>	
							</div>
							<div class="col-sm-4 col-lg-4" id="da">
								<?php
									get_date();
								?>	
							</div>
						</div>
						<hr>

						<!-- Todo -->
						<div class=row>
							<div id="error"></div>
							<div id="cod_venta"></div>
							<div class="col-sm-1 col-lg-8">
								<!-- Buscador -->
								<div class="row">
									<div class="col-sm-1 col-lg-2">
											<h4 id="xd"> 
												Buscar:  
											</h4>
									</div>
									<div class="col-sm-4 col-lg-10">

										<select class="js-example-basic-single" name="state" style="width:100%">
											<option value=""></option>
											<?php
											fill_search_prod();
											?>
										</select>
										
		                        	</div>
		                        </div> <!-- Termina Buscador -->

		                        <!-- Comienza tabla productos -->
		                        
		                        <div class="row" style="padding-left: 10px; padding-right: 10px;">
									<table id="exampletable" class="table table-striped table-bordered dataTable no-footer dtr-inline" cellspacing="0" width="100%">
                                        <thead>
	                                        <tr>
	                                            <th>Codigo</th>
	                                            <th>Nombre</th>
	                                            <th>Talla</th>
	                                            <th>Cantidad</th>
	                                            <th>Precio</th>
	                                        </tr>
                                        </thead>

                                        <tbody id="body">
	                                       
                                        
                                        </tbody>
                                    </table>
                            	</div>


	                        </div>
	                        
							
							<div class="col-sm-1 col-lg-4">
								<h4> Ultimo Producto </h4>
								<div class ="row">
                              		<div class="col-sm-1 col-lg-4">
                              			<h5></h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h4 id="nombre"></h4>
                              		</div>
                              	</div>
								<div class="row">
									<div class="image" style="position: relative; width: 100%;">
									      
									  	<img src="prod_img/0.png" id="img_actual" style='height: 100%; width: 100%; max-height:180px; object-fit: contain'; alt="Producto" >
										
										<h2 style="position: absolute; top: 65%; left: 0; width: 100%; ">
											<span id="precio" style="   color: white; font: bold 24px/45px Helvetica, Sans-Serif; letter-spacing: -1px;  background: rgb(0, 0, 0); background: rgba(0, 0, 0, 0.7); padding: 10px; "
											>$0
											</span>
										</h2>
									</div>
								</div>
                              	<div class ="row">
                              		<h5 hidden id="codigo"></h5>
                              		<div class="col-sm-1 col-lg-4" style="padding-top:15px;">
                              			<h5>Talla</h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h3 id="talla"></h3>
                              		</div>
                              	</div>
                              	<div class ="row">
                              		<div class="col-sm-1 col-lg-4"">
                              			<h5>Cantidad</h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h4><input type="number" onchange="update_price()"" id="cantidad" name="quantity" min="1" style="width:100px;text-align: right;  padding-right: 3px; height:30px;" value=1></h4>
                              		</div>
                              	</div>
                              	<div class ="row">
                              		<div class="col-sm-1 col-lg-2">
                              			<button class="btn btn-icon btn-danger" onclick="delete_btn()"> <i class="fa fa-remove"></i></button>
                              		</div>
                              		<div class="col-sm-1 col-lg-8">
                              			<div class="pull-right">
                              				<button class="btn btn-icon btn-success" onclick="agregar_btn()" style="width:200px;"> <i class="mdi mdi-check"></i> Agregar</button>
                              			</div>
                              		</div>
                              	</div>
                              	<div class ="row">
                              		<div class="col-sm-1 col-lg-4" style="padding-top:15px;">
                              			<h5>Total</h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h2 id="total_venta">$0.00</h2>
                              		</div>
                              	</div>
							</div>
						</div>
						<br>
						<div class ="row">
                      		<div class="col-sm-1 col-lg-2">
                      			<button class="btn btn-icon btn-danger" style="height:50px;" onclick="reset_sale()">Cancelar Venta</button>
                      		</div>
                      		<div class="col-sm-1 col-lg-10">
                      			<div class="pull-right">
                      				<button class="btn btn-icon btn-success" onclick="terminar_venta()" style="width:300px; height:50px;"> <i class="mdi mdi-check"></i> Terminar Venta</button>
                      			</div>
                      		</div>
                      	</div>

						
						


						
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

			<!-- init -->
			<script src="assets/pages/jquery.datatables.init.js"></script>


			<!-- App Js -->
			<script src="assets/js/jquery.app.js"></script>

        <!-- fun-->
        <script src="lib/fun.js"></script>

        	<script>
        	//Dibujado de la tabla que contiene los productos de la venta actual
        	var table;
			$(document).ready(function() {
			    table=$('#exampletable').DataTable({
			    	"bInfo" : false,
			    	"scrollY": "300px",
			        "scrollCollapse": true,
			        "paging":         false,
				    "drawCallback": function( settings ) {
				        $("#exampletable").wrap( "<div class='dataTables_scroll'></div>" );
				    }
				});
			});

			var holder=[];	//Contenedora de los valores del producto en pantalla

			//Buscador de productos
			$(document).ready(function() {
				var select2 = $('.js-example-basic-single').select2({ placeholder: "Codigo o Nombre del Producto " });
			});

			//Al existir cambio en el select, se llenara la parte derecha del formulario llamando el archivo sale_lib para
			//obtener los valores del producto.
			$('.js-example-basic-single').on('change', function() {
				document.getElementById("cantidad").value="1";
				var $select = $(".js-example-basic-single").parent().find("select"); // it's <select> element
				var value = $select.val(); 
				document.getElementById("codigo").innerHTML = value;
				holder[0]=value;
				$.ajax({url: "lib/sale_lib.php?type=1&cod="+value}).done(function( html ) {
					document.getElementById("img_actual").src = html;
				});
				$.ajax({url: "lib/sale_lib.php?type=2&cod="+value}).done(function( html ) {
					document.getElementById("precio").innerHTML = "$"+html;
					holder[4]=html;
				});
				$.ajax({url: "lib/sale_lib.php?type=3&cod="+value}).done(function( html ) {
					document.getElementById("nombre").innerHTML = html;
					holder[1]=html;
				});
				$.ajax({url: "lib/sale_lib.php?type=4&cod="+value}).done(function( html ) {
					document.getElementById("talla").innerHTML = html;
					holder[2]=html;
				});
			})
			var arr = [[]];
			var total_venta=0;

			//Funcion para agregar un producto a la tabla de la venta
			function agregar_btn(){
				if(holder[0]!="" && holder[0]!=null){
					holder[3]=document.getElementById("cantidad").value;
					len=arr.length-1;
					var pos=0;
					for(i=1;i<arr.length;i++){
						if(arr[i][0]==holder[0]){
							pos=i;
							break;
						}
					}
					if(pos==0){
						arr.push([holder[0],holder[1],holder[2],holder[3],parseFloat(holder[4])*parseFloat(holder[3])]);
						var x= 
							'<tr><td>'+holder[0]+'</td><td>'+holder[1]+'</td><td>'+holder[2]+'</td><td>'+holder[3]+'</td><td>'+parseFloat(holder[4])*parseFloat(holder[3])+'</td></tr>';
						if(arr.length==2)
							document.getElementById("body").innerHTML=x;
						else
							document.getElementById("body").innerHTML=document.getElementById("body").innerHTML+x;
						document.getElementById("cantidad").value="1";
					}else{
						arr[pos][4]=parseFloat(arr[pos][4])+(parseFloat(holder[3])*parseFloat(holder[4]));
						arr[pos][3]=parseFloat(arr[pos][3])+parseFloat(holder[3]);
						document.getElementById("exampletable").rows[pos].cells[4].innerHTML=arr[pos][4];
						document.getElementById("exampletable").rows[pos].cells[3].innerHTML=arr[pos][3];
						document.getElementById("cantidad").value="1";
					}
					var total=0.0;
					for(i=1;i<arr.length;i++){
						total+=parseFloat(arr[i][4]);
					}
					total_venta=total;
					document.getElementById("total_venta").innerHTML="$"+total;
				}else{
					document.getElementById("error").innerHTML='<div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom:0px; margin-left:10px; margin-right:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">×</span></button><strong>Producto no encontrado</strong></div><br>';
						for(i=0;i<4;i++){
							holder[i]="";
						}
						document.getElementById("codigo").innerHTML="";
						document.getElementById("nombre").innerHTML="";
						document.getElementById("talla").innerHTML="";
						document.getElementById("cantidad").value="1";
						document.getElementById("precio").innerHTML="$0";
						document.getElementById("img_actual").src="prod_img/0.png";
				}	
			}

			//Permite borrar el objeto actual de la pantalla
			function delete_btn(){
				for(i=0;i<4;i++){
					holder[i]="";
				}
				document.getElementById("codigo").innerHTML="";
				document.getElementById("nombre").innerHTML="";
				document.getElementById("talla").innerHTML="";
				document.getElementById("cantidad").value="1";
				document.getElementById("precio").innerHTML="$0";
				document.getElementById("img_actual").src="prod_img/0.png";
			}

			//Permite actualizar el precio del producto en la pantalla en razon de la cantidad que existan en la venta
			function update_price(){
				if(document.getElementById("cantidad").value!=null && holder[4]!=null)
					document.getElementById("precio").innerHTML="$"+(parseFloat(holder[4])*parseFloat(document.getElementById("cantidad").value));
			}

			//Reinicia la venta, limpiando los campos y las variables.
			function reset_sale(){
				for(i=0;i<4;i++){
					holder[i]="";
				}
				document.getElementById("codigo").innerHTML="";
				document.getElementById("nombre").innerHTML="";
				document.getElementById("talla").innerHTML="";
				document.getElementById("cantidad").value="1";
				document.getElementById("precio").innerHTML="$0";
				document.getElementById("img_actual").src="prod_img/0.png";
				document.getElementById("body").innerHTML="";
				arr=[[]];
			}

			//Finaliza la venta guardandola en la base de datos, utiliza una llamada doble de ajax, en la que primeramente se hace
			//una insercion a la tabla venta y se obtiene el id de la venta creada, luego se hace una insercion en la tabla producto
			//venta por cada uno de los elementos que se encuentren en la variable arr que refleja la tabla de la pantalla igualmente
			//haciendo uso de ajax, para finalmente limpiar las variables y mostrar mensajes de error o de exito.
			function terminar_venta(){
				var id = '<?php echo $_SESSION["id"]; ?>';
				if(arr.length>1){
					var id_venta;
					$.ajax({url: "lib/sale_lib.php?action=1&fecha="+document.getElementById("fecha").innerHTML+"&total="+total_venta+"&id="+id}).done(function( html ) {

						id_venta=html;

						for(i =0;i<arr.length;i++){

							$.ajax({url: "lib/sale_lib.php?action=2&id="+id_venta+"&codigo="+arr[i][0]+"&cantidad="+arr[i][3]}).done(function( html ) {
							});
						}
						document.getElementById("error").innerHTML='<div class="alert alert-success alert-dismissible fade in" role="alert" style="margin-bottom:0px; margin-left:10px; margin-right:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">×</span></button><strong>Venta realizada exitosamente con el id['+id_venta+'].</strong></div><br>';
						reset_sale();
						
					});
					
				}else{
					document.getElementById("error").innerHTML='<div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin-bottom:0px; margin-left:10px; margin-right:10px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">×</span></button><strong>Ingrese productos a la venta.</strong></div><br>';
				}
				
			}
		</script>
	</body>
	</html>