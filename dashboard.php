<?php 
  session_start();
  include ("lib/db.php");
  include ("lib/misc.php");
  include ("lib/dashboard_lib.php");

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
                <!--Morris Chart CSS -->
    <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">

        <!-- Plugins css-->
        <link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/plugins/switchery/switchery.min.css">
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


        <!-- Icons CSS -->
        <link href="assets/css/icons.css" rel="stylesheet">


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

                  <div class="card-box widget-inline" style=" width: 99%; height: 150px; overflow: hidden;">
                      <div class="row" style="width:90%; ">
                        <div class="pull-left">
                          <h4 style="margin-left: 25px;">Mensaje del Dia</h4>
                        </div>
                        <div class="pull-left" style="padding-left: 10px; padding-top: 8px;">
                          <a href="motd.php"><button class="btn btn-icon btn-info btn-xs"> <i class="fa fa-wrench"></i> </button></a>
                        </div>
                      <?php
                        motd();
                      ?>
                    </div>
                  </div>
                  <div class="card-box widget-inline">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                          <h3 class="m-t-10"><i class="text-primary mdi mdi-access-point-network"></i> <b data-plugin="counterup">
                            <?php 
                              getRegistredUsers();
                            ?></b>
                          </h3>
                          <p class="text-muted">Usuarios Registrados</p>
                        </div>
                      </div>

                      <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                          <h3 class="m-t-10"><i class="text-custom mdi mdi-airplay"></i> <b data-plugin="counterup">
                            <?php
                            getRegistredProducts();
                            ?></b></h3>
                          <p class="text-muted">Productos Registrados</p>
                        </div>
                      </div>

                      <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center">
                          <h3 class="m-t-10"><i class="text-info mdi mdi-black-mesa"></i> <b data-plugin="counterup"><?php
                            getTopProduct();
                          ?></b></h3>
                          <p class="text-muted">Producto mas vendido</p>
                        </div>
                      </div>

                      <div class="col-lg-3 col-sm-6">
                        <div class="widget-inline-box text-center b-0">
                          <h3 class="m-t-10"><i class="text-danger mdi mdi-cellphone-link"></i> <b data-plugin="counterup"><?php
                            getDailySales();
                          ?></b></h3>
                          <p class="text-muted">Ventas del dia</p>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div id="grafica_cantidad_top_productos" style="height: 250px;"></div>
                  <div class="row">
                     <div class="col-lg-3 col-sm-3">
                          <div id="otro" style="height: 250px;"></div>
                     </div>
                      <div class="col-lg-3 col-sm-3">
                          <div id="usuarios_y_administradores" style="height: 250px;"></div>
                      </div>
                      <div class="col-lg-6 col-sm-6">
                          <div id="productos_mas_caros" style="height: 250px;"></div>
                      </div>
                  </div>
                  <div id="tipos_producto" style="height: 250px;"></div>
                  
                       
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

        <script>
          new Morris.Line({
          // ID of the element in which to draw the chart.
          element: 'grafica_cantidad_top_productos',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: [
            { year: '2008', value: 20 },
            { year: '2009', value: 10 },
            { year: '2010', value: 5 },
            { year: '2011', value: 5 },
            { year: '2012', value: 20 }
          ],
          // The name of the data record attribute that contains x-values.
          xkey: 'year',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['value'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['Value']
          });

          new Morris.Bar({
          // ID of the element in which to draw the chart.
          element: 'tipos_producto',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: [
            <?php
              getTypes();
            ?>

          ],
          // The name of the data record attribute that contains x-values.
          xkey: 'mapname',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['value'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['Value']
          });

           Morris.Donut({
            element: 'otro',
            data: [
            <?php
                getUserAdminChart();

              ?>
            ]
          });

               Morris.Donut({
            element: 'usuarios_y_administradores',
            data: [
            <?php
                getUserAdminChart();

              ?>
            ]
          });


          
          new Morris.Bar({
          // ID of the element in which to draw the chart.
          element: 'productos_mas_caros',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: [
          
                    <?php
              getMostExpensive();
            ?>
   
          ],
          // The name of the data record attribute that contains x-values.
          xkey: 'mapname',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['value'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['Value']
          });




        </script>

    </body>
</html>