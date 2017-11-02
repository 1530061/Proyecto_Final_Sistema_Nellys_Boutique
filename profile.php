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
                  if(!empty($_POST['usr_nombre'])){
                    update_profile($_SESSION['id']);
                  }

                ?>
                <!--left navigation end-->

                <!-- START PAGE CONTENT -->
                <div id="page-right-content">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-0 text-center">
                                    <div class="member-card">
                                        <div class="thumb-xl member-thumb m-b-10 center-block">
                                            <img src=
                                            <?php
                                              if(empty($_GET['id']))
                                                echo("'".get_img_usrbyID($_SESSION["id"])."'");
                                              else
                                                echo("'".get_img_usrbyID($_GET["id"])."'");

                                            ?>
                                            class="img-circle img-thumbnail" alt="profile-image">
                                            <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                        </div>

                                        <div class="">
                                            <h4 class="m-b-5">
                                            <?php
                                              if(empty($_GET['id']))
                                                echo(get_name_usrbyID($_SESSION["id"]));
                                              else
                                                echo(get_name_usrbyID($_GET["id"]));
                                            ?></h4>
                                            <p class="text-muted"><?php
                                              if(empty($_GET['id']))
                                                echo(get_role_usrbyID($_SESSION["id"]));
                                              else
                                                echo(get_role_usrbyID($_GET["id"]));
                                            ?></p>
                                        </div>

                                        <button type="button" class="btn btn-custom m-t-10">Mensaje</button>

                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <div class="m-t-30">
                            <ul class="nav nav-tabs tabs-bordered">
                                <li class="active">
                                    <a href="#home-b1" data-toggle="tab" aria-expanded="true">
                                        Perfil
                                    </a>
                                </li>
                                <li class="">
                                    <?php
                                          if(empty($_GET['id'])){
                                            echo('<a href="#profile-b1" data-toggle="tab" aria-expanded="false">
                                        Configuracion
                                    </a>');
                                          }
                                    ?>
                                    
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-b1">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- Personal-Information -->
                                            <div class="panel panel-default panel-fill">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Informacion Personal</h3>
                                                </div>
                                                <?php
                                                  if(empty($_GET['id']))
                                                    contacts_information($_SESSION['id']);
                                                  else
                                                    contacts_information($_GET['id']);
                                                  
                                                ?>
                                            </div>
                                            <!-- Personal-Information -->

                                            <!-- Social -->
                                            <div class="panel panel-default panel-fill">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Social</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="social-links list-inline m-b-0">
                                                        <li>
                                                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                                        </li>
                                                        <li>
                                                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                                        </li>
                                                        <li>
                                                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- Social -->
                                        </div>


                                        <div class="col-md-8" style="overflow: hidden;">
                                            <!-- Personal-Information -->
                                            <div class="panel panel-default panel-fill">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Biografia</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <?php
                                                      if(empty($_GET['id']))
                                                        echo(get_bio_usrbyID($_SESSION['id']));
                                                      else
                                                        if(get_bio_usrbyID($_GET['id'])=="")
                                                          echo("<strong> Ups... </strong> Parece que este administrador aun no ha establecido su biografia");
                                                        else
                                                          echo(get_bio_usrbyID($_GET['id']));
                                                    ?>
                                                </div>
                                            </div>
                                            <!-- Personal-Information -->

                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="profile-b1">
                                    <!-- Personal-Information -->
                                    <div class="panel panel-default panel-fill">
                                        <div class="panel-heading">
                                          <?php
                                          if(empty($_GET['id'])){
                                            echo('<h3 class="panel-title">Edit Profile</h3>');
                                          }
                                          ?>
                                        </div>
                                        <div class="panel-body">
                                          <?php
                                          if(empty($_GET['id'])){
                                              contacts_actual_info($_SESSION['id']);
                                          }else{

                                              
                                          }
                                           ?>
                                        </div>
                                    </div>
                                    <!-- Personal-Information -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end container -->

                    <div class="footer">
                        <div class="pull-right hidden-xs">
                            Project Completed <strong class="text-custom">39%</strong>.
                        </div>
                        <div>
                            <strong>Sistema Nelly's Boutique</strong> - Copyright &copy; 2017
                        </div>
                    </div> <!-- end footer -->

                </div>
                  
                       
                  <!-- end container -->

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
          height: "170px"
        });
      });
      var postForm = function() {
        var content = $('textarea[name="content"]').html($('#summernote').code());
      }
        </script>
    </body>
</html>