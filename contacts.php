<?php 
  session_start();
  include ("lib/db.php");               //Funciones encargadas de la BD
  include ("lib/misc.php");             //Funciones compartidas en todos los formularios

  /////Funciones del formulario

    //Funcion que llena el formulario con la informacion de todos usuarios administradores, mostrando su fotografia, nombre, telefono, email.
    function allcontacts(){
        $id_users=select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno), email, fotografia, telefono, id from usuario where nivel=0 and activo=1");
        
        for($i=0;$i<sizeof($id_users);$i++){
            echo('
                <div class="col-md-4">
                <div class="text-center card-box">
                <div class="clearfix"></div>
                <div class="member-card" style=" height:250px">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                <img src="'.array_values($id_users[$i])[2].'" class="img-circle img-thumbnail" alt="profile-image">
                <i class="mdi mdi-star-circle member-star text-success" title="Usuario Administrador"></i>
                </div>

                <div class="">
                <h4 class="m-b-5">'.array_values($id_users[$i])[0].'</h4>
                <p class="text-muted">'.array_values($id_users[$i])[3].' <span> | <span> <a href="#" class="text-pink">'.array_values($id_users[$i])[1].'</a> </span></p>
                </div>

                
                <a href="profile.php?id='.array_values($id_users[$i])[4].'"><button type="button" class="btn btn-default btn-sm m-t-10">Ver Perfil</button></a>
                </div>
                </div>
                </div>'
            );
        }
    }

  //Se revisa que la conexion tenga una sesion activa sino se redirige al index.php
  if (empty($_SESSION["logg"]))
    header('Location: /final/index.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Contactos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
                    <h1 style="color:#D52B2B;"><span class="mdi mdi-face gi-5x" style="font-size: 60px; padding-left: 10px;" ></span>  Contacto</h1>
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



        <!-- SweetAlert-->
        <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert.init.js"></script>

        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>
        
        <!-- Logout-->
        <script src="lib/fun.js"></script>

    </body>
</html>