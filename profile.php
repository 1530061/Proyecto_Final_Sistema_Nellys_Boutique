<?php 
  session_start();
  include ("lib/db.php");               //Funciones encargada de la BD
  include ("lib/misc.php");             //Funciones compartidas en todos los formularios

/////Funciones del formulario

//Funcion que imprime el menu de configuracion del perfil de los propios usuarios, ubicado en la seccion de profile.
function contacts_actual_info($id){
    $usr=select("select nombre,apellido_paterno, apellido_materno, fecha_nac, genero, email, telefono, biografia from usuario where id=".$id."");
    echo('<form enctype="multipart/form-data" action="profile.php" id="testx" name="test" class="form-validation" novalidate="" method="post">

        <div class="form-group">
        <label for="userName">Nombre<span class="text-danger">*</span></label>
        <input type="text" name="usr_nombre" parsley-trigger="change" required="" class="form-control" id="usr_nombre" value="'.array_values($usr[0])[0].'">
        </div>
        <div class="form-group">
        <label for="usr_app">Apellido Paterno<span class="text-danger">*</span></label>
        <input type="text" name="usr_app" parsley-trigger="change" required="" class="form-control" id="usr_app" value="'.array_values($usr[0])[1].'">
        </div>
        <div class="form-group">
        <label for="usr_amp">Apellido Materno<span class="text-danger"></span></label>
        <input type="text" name="usr_apm" parsley-trigger="change" class="form-control" id="usr_apm" value="'.array_values($usr[0])[2].'">
        </div>
        <div class="form-group">
        <label for="datepicker-autoclose">Fecha de Nacimiento<span class="text-danger">*</span></label>
        <div class="input-group">
        <input type="text" name="usr_fn" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-autoclose" parsley-trigger="change" required="" value="'.array_values($usr[0])[3].'">
        <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
        </div>
        </div>
        <label>Genero<span class="text-danger">*</span></label>
        <div class="form-group">
        <div class="radio radio-info radio-inline">
        <input type="radio" id="inlineRadio1" value="M" name="usr_ge" checked="" ">
        <label for="inlineRadio1"> Masculino </label>
        </div>
        <div class="radio radio-danger radio-inline">
        <input type="radio" id="inlineRadio2" value="F" name="usr_ge">
        <label for="inlineRadio2"> Femenino </label>
        </div>
        </div>
        <hr>
        <div class="form-group" id="emg">
        <label for="usr_em">Email <span class="text-danger">*</span></label>
        <input type="email" name="usr_em" parsley-trigger="change" class="form-control" id="usr_em" value="'.array_values($usr[0])[5].'">
        </div>
        <div class="form-group" id="telf">
        <label for="usr_tel">Telefono <span class="text-danger">*</span></label>
        <input type="tel" name="usr_tel" parsley-trigger="change" placeholder="" class="form-control" id="usr_tel" value='.array_values($usr[0])[6].'">
        </div>
        <div class="form-group" id="summer">
        <label for="summernote">Biografia<span class="text-danger"></span></label>
        <fieldset>
        
        <p class="container">
        <textarea class="input-block-level" id="summernote" name="content" rows="2">
        </textarea>
        </p>
        </fieldset>
        
        </div>
        <hr>
        <div class="form-group text-right m-b-0">
        <button type="reset" class="btn btn-danger btn-bordered btn-lg" style="width:25%">
        <i class="mdi mdi-close"></i>Cancelar
        </button>
        <button class="btn btn-primary btn-bordered btn-lg" type="submit" style="width:35%" >
        <i class="mdi mdi-check"></i>Guardar
        </button>
        </div>
        </form>');
}

//Funcion que permite actualizar el perfil de un usuario
function update_profile($id){
    $date=date_create($_POST["usr_fn"]);
    $date=date_format($date,"Y-m-d H:i:s");


    $columns=["nombre", "apellido_paterno", "apellido_materno", "fecha_nac", "genero", "email", "telefono", "biografia"];
    $values=[st($_POST["usr_nombre"]),st($_POST["usr_app"]),st($_POST["usr_apm"]), st($date), st($_POST["usr_ge"]), st($_POST["usr_em"]), st($_POST["usr_tel"]), st($_POST["content"])];
    $table="usuario";
    $condition="where id=".$id;
    update($columns,$values,$table,$condition);
    sweetalert('Perfil actualizado correctamente.</strong>',"good");
    
    
}

//Funcion que imprime la informacion de algun contacto de un administrador.
function contacts_information($id){
    $usr=select("select CONCAT(nombre,' ',apellido_paterno,' ', apellido_materno), telefono, email from usuario where id=".$id."");
    echo('<div class="panel-body">
        <div class="m-b-20">
        <strong>Nombre Completo</strong>
        <br>
        <p class="text-muted">'.array_values($usr[0])[0].'</p>
        </div>
        <div class="m-b-20">
        <strong>Telefono</strong>
        <br>
        <p class="text-muted">'.array_values($usr[0])[1].'</p>
        </div>
        <div class="m-b-20">
        <strong>Correo Electronico</strong>
        <br>
        <p class="text-muted">'.array_values($usr[0])[2].'</p>
        </div>
        </div>');
    }

//Se revisa que la conexion tenga una sesion activa sino se redirige al index.php
if (empty($_SESSION["logg"]))
    header('Location: /final/index.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Perfil</title>
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

        <!-- SweetAlert-->
        <script src="assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
        <script src="assets/pages/jquery.sweet-alert.init.js"></script>

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
                    height: 350,                 
                    minHeight: null,             
                    maxHeight: null,            
                    focus: false                
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