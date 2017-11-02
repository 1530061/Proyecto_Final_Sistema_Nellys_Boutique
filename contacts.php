<?php 
  session_start();
  include ("lib/db.php");
  include ("lib/misc.php");
  include ("lib/contacts_lib.php");

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
                      <h1> Contacto </h1>
                    </div>
                  </div>

                  <div style='overflow:auto; width:100%;height:100%;'>
                  <?php
                    allcontacts();
                  ?>
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

    </body>
</html>