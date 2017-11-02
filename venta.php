<?php 
	session_start();
	include ("lib/db.php");
	include ("lib/misc.php");

	if (empty($_SESSION["logg"]))
		header('Location: /final/index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>SimpleAdmin - Responsive Admin Dashboard Template</title>
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

        <!-- DataTables -->
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

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
							<li><a href="#">Contacto</a></li>
						</ul>

						<!-- Top nav Right menu -->
						<ul class="nav navbar-nav navbar-right top-navbar-items-right pull-right">
							<li class="hidden-xs">
								<form role="search" class="navbar-left app-search pull-left">
									<input type="text" placeholder="Buscar..." class="form-control">
									<a href=""><i class="fa fa-search"></i></a>
								</form>
							</li>
							<li class="dropdown top-menu-item-xs">
								<a href="#" data-target="#" class="dropdown-toggle menu-right-item" data-toggle="dropdown" aria-expanded="true">
									<i class="mdi mdi-bell"></i> <span class="label label-danger">3</span>
								</a>
								<ul class="dropdown-menu p-0 dropdown-menu-lg">
									<!--<li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>-->
									<li class="list-group notification-list" style="height: 267px;">
										<div class="slimscroll">
											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-diamond bg-primary"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">A new order has been placed A new order has been placed</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-cog bg-warning"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">New settings</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-bell-o bg-custom"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">Updates</h5>
														<p class="m-0">
															<small>There are <span class="text-primary font-600">2</span> new updates available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-user-plus bg-danger"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">New user registered</h5>
														<p class="m-0">
															<small>You have 10 unread messages</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-diamond bg-primary"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">A new order has been placed A new order has been placed</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>

											<!-- list item-->
											<a href="javascript:void(0);" class="list-group-item">
												<div class="media">
													<div class="media-left p-r-10">
														<em class="fa fa-cog bg-warning"></em>
													</div>
													<div class="media-body">
														<h5 class="media-heading">New settings</h5>
														<p class="m-0">
															<small>There are new settings available</small>
														</p>
													</div>
												</div>
											</a>
										</div>
									</li>
									<!--<li>-->
										<!--<a href="javascript:void(0);" class="list-group-item text-right">-->
											<!--<small class="font-600">See all notifications</small>-->
											<!--</a>-->
											<!--</li>-->
										</ul>
									</li>

									<li class="dropdown top-menu-item-xs">
										<a href="" class="dropdown-toggle menu-right-item profile" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
										<ul class="dropdown-menu">
											<li><a href="javascript:void(0)"><i class="ti-user m-r-10"></i> Profile</a></li>
											<li><a href="javascript:void(0)"><i class="ti-settings m-r-10"></i> Settings</a></li>
											<li><a href="javascript:void(0)"><i class="ti-lock m-r-10"></i> Lock screen</a></li>
											<li class="divider"></li>
											<li><a href="javascript:void(0)"><i class="ti-power-off m-r-10"></i> Logout</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div> <!-- end container -->
					</div> <!-- end navbar -->
				</div>
				<!-- Top Bar End -->


				<!-- Page content start -->
				<div class="page-contentbar">

					<!--left navigation start-->
					<aside class="sidebar-navigation">
						<div class="scrollbar-wrapper">
							<div>
								<button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
									<i class="mdi mdi-close"></i>
								</button>
								<!-- User Detail box -->
								<div class="user-details">
									<div class="pull-left">
										<img src="assets/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle">
									</div>
									<div class="user-info">
										<a href="#">Stanley Jones</a>
										<p class="text-muted m-0">Administrator</p>
									</div>
								</div>
								<!--- End User Detail box -->

								<!-- Left Menu Start -->
								<ul class="metisMenu nav" id="side-menu">

									<li><a href="dashboard.php"><i class="ti-home"></i> Inicio </a></li>

									<li><a href="venta.php"><span class="label label-custom pull-right"></span> <i class="mdi mdi-cart-outline"></i> Venta </a></li>

									<li><a href="javascript: void(0);" aria-expanded="true"><i class="mdi mdi-package-variant-closed"></i> Inventario</a></li>
									
									<li><a href="javascript: void(0);" aria-expanded="true"><i class="mdi mdi-clipboard-outline"></i> Apartado de Productos</a></li>

									<li><a href="javascript: void(0);" aria-expanded="true"><i class="mdi mdi-account-outline"></i> Gestion de Clientes</a></li>

									<li><a href="javascript: void(0);" aria-expanded="true"><i class="mdi mdi-lock-outline"></i> Gestion de Usuarios</a></li>                               

								</ul>
								<!-- Left Menu End -->
							</div>
						</div><!--Scrollbar wrapper-->
					</aside>
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
							<div class="col-sm-4 col-lg-4">
								<?php
									get_date();
								?>	
							</div>
						</div>
						<hr>

						<!-- Todo -->
						<div class=row>
							<div class="col-sm-1 col-lg-8">
								<!-- Buscador -->
								<div class="row">
									<div class="col-sm-1 col-lg-2">
											<h4> 
												Buscar:  
											</h4>
									</div>
									<div class="col-sm-4 col-lg-10">
										<select class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
		                                        <option>Select</option>
		                                        <optgroup label="Alaskan/Hawaiian Time Zone">
		                                            <option value="AK">Alaska</option>
		                                            <option value="HI">Hawaii</option>
		                                        </optgroup>
		                                        <optgroup label="Pacific Time Zone">
		                                            <option value="CA">California</option>
		                                            <option value="NV">Nevada</option>
		                                            <option value="OR">Oregon</option>
		                                            <option value="WA">Washington</option>
		                                        </optgroup>
		                                        <optgroup label="Mountain Time Zone">
		                                            <option value="AZ">Arizona</option>
		                                            <option value="CO">Colorado</option>
		                                            <option value="ID">Idaho</option>
		                                            <option value="MT">Montana</option>
		                                            <option value="NE">Nebraska</option>
		                                            <option value="NM">New Mexico</option>
		                                            <option value="ND">North Dakota</option>
		                                            <option value="UT">Utah</option>
		                                            <option value="WY">Wyoming</option>
		                                        </optgroup>
		                                        <optgroup label="Central Time Zone">
		                                            <option value="AL">Alabama</option>
		                                            <option value="AR">Arkansas</option>
		                                            <option value="IL">Illinois</option>
		                                            <option value="IA">Iowa</option>
		                                            <option value="KS">Kansas</option>
		                                            <option value="KY">Kentucky</option>
		                                            <option value="LA">Louisiana</option>
		                                            <option value="MN">Minnesota</option>
		                                            <option value="MS">Mississippi</option>
		                                            <option value="MO">Missouri</option>
		                                            <option value="OK">Oklahoma</option>
		                                            <option value="SD">South Dakota</option>
		                                            <option value="TX">Texas</option>
		                                            <option value="TN">Tennessee</option>
		                                            <option value="WI">Wisconsin</option>
		                                        </optgroup>
		                                        <optgroup label="Eastern Time Zone">
		                                            <option value="CT">Connecticut</option>
		                                            <option value="DE">Delaware</option>
		                                            <option value="FL">Florida</option>
		                                            <option value="GA">Georgia</option>
		                                            <option value="IN">Indiana</option>
		                                            <option value="ME">Maine</option>
		                                            <option value="MD">Maryland</option>
		                                            <option value="MA">Massachusetts</option>
		                                            <option value="MI">Michigan</option>
		                                            <option value="NH">New Hampshire</option>
		                                            <option value="NJ">New Jersey</option>
		                                            <option value="NY">New York</option>
		                                            <option value="NC">North Carolina</option>
		                                            <option value="OH">Ohio</option>
		                                            <option value="PA">Pennsylvania</option>
		                                            <option value="RI">Rhode Island</option>
		                                            <option value="SC">South Carolina</option>
		                                            <option value="VT">Vermont</option>
		                                            <option value="VA">Virginia</option>
		                                            <option value="WV">West Virginia</option>
		                                        </optgroup>
		                                    </select>
		                        	</div>
		                        </div> <!-- Termina Buscador -->

		                        <!-- Comienza tabla productos -->
		                        
		                        <div class="row" style="padding-left: 13px; padding-right: 10px;">
	                        	 	<div class="m-b-20 table-responsive">
	                                    <table id="datatable-fixed-col" class="table table-striped table-bordered">
	                                        <thead>
	                                        <tr>
	                                            <th>Codigo</th>
	                                            <th>Nombre</th>
	                                            <th>Talla</th>
	                                            <th>Color</th>
	                                            <th>Cantidad</th>
	                                            <th>Precio</th>
	                                        </tr>
	                                        </thead>


	                                        <tbody>
	                                        <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                         <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                         <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                         <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                         <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                        <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                         <tr>
	                                            <td>perro101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                         <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>
	                                           <tr>
	                                            <td>1010101010</td>
	                                            <td>System Architect</td>
	                                            <td>S</td>
	                                            <td>Rojo</td>
	                                            <td>50</td>
	                                            <td>500</td>
	                                        </tr>

	                                
	                                        </tbody>
	                                    </table>
                                	</div>


		                        </div>
	                        </div>
							
							<div class="col-sm-1 col-lg-4">
								<h4> Ultimo Producto </h4>
								<div class ="row">
                              		<div class="col-sm-1 col-lg-4">
                              			<h5>Nombre</h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h4>Resultado nombre</h4>
                              		</div>
                              	</div>
								<div class="row">
									<div class="image" style="position: relative; width: 100%;">
									      
									  	<img src="prod_img/short.jpe" style='height: 100%; width: 100%; max-height:180px; object-fit: contain'; alt="Producto" >
										
										<h2 style="position: absolute; top: 65%; left: 0; width: 100%; ">
											<span style="   color: white; font: bold 24px/45px Helvetica, Sans-Serif; letter-spacing: -1px;  background: rgb(0, 0, 0); background: rgba(0, 0, 0, 0.7); padding: 10px; "
											>$25000.00
											</span>
										</h2>
									</div>
								</div><!--
									<div class ="row">
	                              		<div class="col-sm-1 col-lg-4">
	                              			<h5>Descripcion</h5>
	                              		</div>

										<div class="col-sm-1 col-lg-8">
											<textarea  readonly cols="35" rows="5" style="border: none; overflow:hidden;resize: none; padding-top: 10px;">Un buen vestido de un buen color que gjaldf dasjd fasjldfla  e er er df dsfasdfasdf fsjaflk. que falsdfjsdfjhaskdf dyf asdfjsdhflksd fmcmcmcmjeueueu daskks.
											</textarea>
	                              		</div>
	                              	</div>-->
                              	<div class ="row">
                              		<div class="col-sm-1 col-lg-4" style="padding-top:15px;">
                              			<h5>Talla</h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h3>2</h3>
                              		</div>
                              	</div>
                              	<div class ="row">
                              		<div class="col-sm-1 col-lg-4"">
                              			<h5>Cantidad</h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h4><input type="number" name="quantity" min="1" max="5" style="width:100px;text-align: right;  padding-right: 3px; height:30px;" value=1></h4>
                              		</div>
                              	</div>
                              	<div class ="row">
                              		<div class="col-sm-1 col-lg-2">
                              			<button class="btn btn-icon btn-danger"> <i class="fa fa-remove"></i></button>
                              		</div>
                              		<div class="col-sm-1 col-lg-8">
                              			<div class="pull-right">
                              				<button class="btn btn-icon btn-success" style="width:200px;"> <i class="mdi mdi-check"></i> Agregar</button>
                              			</div>
                              		</div>
                              	</div>
                              	<div class ="row">
                              		<div class="col-sm-1 col-lg-4" style="padding-top:15px;">
                              			<h5>Total</h5>
                              		</div>
									<div class="col-sm-1 col-lg-8">
										<h2>$500.00</h2>
                              		</div>
                              	</div>
							</div>
						</div>
						<br>


						<p>hola</p>
						


						
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

		<!-- Dashboard init -->
		<script src="assets/pages/jquery.dashboard.js"></script>

		<!-- App Js -->
		<script src="assets/js/jquery.app.js"></script>

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

        <!-- init -->
        <script src="assets/pages/jquery.datatables.init.js"></script>

        <!-- fun-->
        <script src="lib/fun.js"></script>
	</body>
	</html>