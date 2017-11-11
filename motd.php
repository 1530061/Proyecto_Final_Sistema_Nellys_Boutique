<?php 
  session_start();
  include ("lib/db.php");               //Funciones encargada de la BD
  include ("lib/misc.php");             //Funciones compartidas en todos los formularios

//// Funciones del formulario
    function change_motd(){
    $dateTime = new DateTime('now'); 
    $dateTime=date_format($dateTime,"Y-m-d H:i:s");
    if(!empty($_POST["content"])){
      $columns=["mensaje", "id_usuario", "fecha"];
      $values=[st($_POST["content"]), $_SESSION["id"], st($dateTime)];
      insert($columns, $values, "motd");
    }else{
      sweetalert("No puede dejar el mensaje del dia vacio.","bad");
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
        <title>Mensaje del Dia</title>
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


        <!-- Plugins css-->
        <link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
          <link rel="stylesheet" href="assets/plugins/switchery/switchery.min.css">
        <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
          <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
        <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
                  <div class="row">
                    <div class="col-sm-1 col-md-4 col-lg-1">
                      <span class="mdi mdi-mail-ru gi-5x" style="font-size: 60px; padding-left: 10px;" ></span> 
                    </div>
                    <div class="col-sm-11 col-md-8 col-lg-11">
                      <h1> Configuracion del Mensaje del Dia </h1>
                    </div>
                  </div>
                  <?php
                    if(isset($_POST["content"])){
                      change_motd();
                      //$values=[$_POST["name"],$_POST["usr"],$_POST["p"];

                    }
                  ?>

                  <div class="card-box widget-inline" style=" width: 99%; height: 150px; overflow: auto;">
                      <div class="row" style="width:90%; ">
                        <div class="pull-left">
                          <h4 style="margin-left: 25px;">Mensaje del Dia Actual</h4>
                        </div>
                      <?php
                        motd();
                      ?>
                      </div>
                  </div>
                  <!--$_SESSION["id"]-->
                  <form enctype="multipart/form-data" action="motd.php" id="testx" name="test" class="form-validation" novalidate="" method="post">
                    <div class="card-box widget-inline" id="summer" style=" width: 99%; height: 300px; overflow: auto;">
                        <h4 style="margin-left: 20px;">Ingresar nuevo mensaje</h4>
                        <fieldset>
                          <p class="container">
                            <textarea class="input-block-level" id="summernote" name="content" rows="2">
                            </textarea>
                          </p>
                        </fieldset>
                        
                    </div>
                     <div class="form-group text-right m-b-0">
                            <button type="reset" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
                                <i class="mdi mdi-close"></i>Cancelar
                            </button>
                            <button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
                                <i class="mdi mdi-check"></i>Guardar
                            </button>
                      </div>
                  </form>
                  
                  
                       
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

        <!-- fun-->
        <script src="lib/fun.js"></script>

          <!-- form advanced init js -->
        <script src="assets/pages/jquery.form-advanced.init.js"></script>


        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>


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



      <script type="text/javascript">
           //Dibujado de elemento SummerNote
            $(document).ready(function() {
                $('.form-validation').parsley();
                $('.summernote').summernote({
                    height: 350,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });
            });
            $(document).ready(function() {
        $('#summernote').summernote({
          height: "130px"
        });
      });
      var postForm = function() {
        var content = $('textarea[name="content"]').html($('#summernote').code());
      }
        </script>

    </body>
</html>