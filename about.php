<?php 
  session_start();
  include ("lib/db.php");               //Funcion encargada de la BD
  include ("lib/misc.php");             //Funciones compartidas en todos los formularios

  //Se revisa que la conexion tenga una sesion activa sino se redirige al index.php
  if (empty($_SESSION["logg"]))
    header('Location: /final/index.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Acerca De</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<link rel="stylesheet" href="assets/plugins/morris/morris.css">
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
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
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 style="color:#D52B2B;"><span class="mdi mdi-compass gi-5x" style="font-size: 60px; padding-left: 10px;" ></span>  Acerca De </h1>
                </div>

                  <div style='overflow:auto; width:100%;height:100%;'>
                    <h3>Nelly's Boutique - Direccion</h3>

                    <div id="map" style="height:500px; width:100%;">
                    </div>

                    <h5>v1.0 - Erick Elizondo Rodríguez - 1530061</h5>
                    <h5>Diseño de Interfaces</h5>
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
        
        <script>
            //Inicializando el mapa de google que se muestra en la interfaz para mostrar la direccion del establecimiento
            function initMap(){
                var location ={lat: 23.749351, lng:-99.137609};
                var map = new google.maps.Map(document.getElementById("map"),{
                    zoom:18,
                    center: location
                });
                var marker = new google.maps.Marker({
                    position:location,
                    map:map
                });
            }

        </script>

        <!-- Solicitando el mapa de google-->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQhWEnofX1eNC2rK2yXn_c8pRVsac39rg&callback=initMap"></script>
            <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <!-- Logout-->
        <script src="lib/fun.js"></script>
    </body>
</html>