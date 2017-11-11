<?php 
session_start();
include ("lib/db.php");               //Funciones encargadas de la BD
include ("lib/misc.php");             //Funciones compartidas en todos los formularios


////Funciones del formulario

  //Se obtienen los usuarios registrados
  function getRegistredUsers(){
    echo(array_values(select("select count(*) from usuario")[0])[0]);
  }

  //Se obtienen los productos registrados
  function getRegistredProducts(){
    echo(array_values(select("select count(*) from producto")[0])[0]);
  }

  //Se optiene el top de los productos mas vendidos
  function getTopProduct(){
    $id=array_values(select("select codigo_producto, count(*) from venta_producto group by codigo_producto")[0])[0];
    
    echo(array_values(select("select nombre from producto where codigo='".$id."'")[0])[0]);
  }

  //Se obtiene el total de ventas
  function getDailySales(){
    $date=date_create("now");
    $date=date_format($date,"Y-m-d");
    echo(array_values(select("select count(*) from venta where fecha='".$date."'")[0])[0]);
  }

  //Se llena la grafica de los usuarios admin activos e inactivos
  function getUserAdminChart(){
    $admin = array_values(select("select count(*) from usuario where nivel=0 and activo=1")[0])[0];
    $user = array_values(select("select count(*) from usuario where nivel=1 and activo=1")[0])[0];
    echo('{label: "Administradores", value: '.$admin.'},
              {label: "Empleados", value: '.$user.'},');
  }

  //Se llena la grafica con los productos mas caros
  function getMostExpensive(){
    $lista=select('select nombre, precio from producto where activo=1 order by precio desc limit 5');

    for($i=0;$i<sizeof($lista);$i++){
      echo('{mapname: "'.array_values($lista[$i])[0].'", label: "'.array_values($lista[$i])[0].'", value: '.array_values($lista[$i])[1].'},');
    }    
  }

  //Se llena la grafica con los tipos de productos
  function getTypes(){
    $lista=select('select id_tipo, count(*) from producto where activo=1 group by id_tipo limit 5');

    for($i=0;$i<sizeof($lista);$i++){
      echo('{mapname: "'.array_values(select("select nombre from tipo_producto where id='".array_values($lista[$i])[0]."'")[0])[0].'", label: "'.array_values(select("select nombre from tipo_producto where id='".array_values($lista[$i])[0]."'")[0])[0].'", value: '.array_values($lista[$i])[1].'},');
    }       
  }

  //Se llena la grafica con los usuarios activos e inactivos
  function activeAndInactive(){
    $admin = array_values(select("select count(*) from usuario where activo=0")[0])[0];
    $user = array_values(select("select count(*) from usuario where activo=1")[0])[0];
    echo('{label: "Activos", value: '.$admin.'},
              {label: "Inactivos", value: '.$user.'},');
  }

  //Se llena la grafica con los productos activos e inactivos
  function prod_activeAndInactive(){
    $activo = array_values(select("select count(*) from producto where activo=1")[0])[0];
    $inactivo = array_values(select("select count(*) from producto where activo=0")[0])[0];
    echo('{label: "Activos", value: '.$activo.'},
              {label: "Inactivos", value: '.$inactivo.'},');
  }

  //Se obtiene la grafica con las ventas diarias
  function getDateGraph(){
    $lista=select('select fecha, SUM(total), count(*) from venta group by fecha limit 10');

    for($i=0;$i<sizeof($lista);$i++){
      echo('{week:"'.array_values($lista[$i])[0].'", "venta":"'.array_values($lista[$i])[1].'",  "precio":'.array_values($lista[$i])[1].'},');
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
        <title>Dashboard</title>
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
        <link href="assets/plugins/fullcalendar/css/fullcalendar.min.css" rel="stylesheet" />

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
                 

                  <div class="card-box widget-inline" style=" width: 99%; height: 150px; overflow: hidden;">
                      <div class="row" style="width:90%; ">
                        <div class="pull-left">
                          <h4 style="margin-left: 25px;">Mensaje del Dia</h4>
                        </div>
                        <div class="pull-left" style="padding-left: 10px; padding-top: 8px;">
                          <?php
                            if(get_role_usrbyID($_SESSION['id'])==0)
                              echo('<a href="motd.php"><button class="btn btn-icon btn-info btn-xs"> <i class="fa fa-wrench"></i> </button></a>');
                          ?>
                        </div>
                      <?php
                        motd();
                      ?>
                    </div>
                  </div>
                  <div class="card-box widget-inline" style=" width: 100%;"">
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

                  <?php
                  if(get_role_usrbyID($_SESSION['id'])==0)
                  echo('
                    <h4 style="padding-left: 20px;"> Distribucion de usuarios </h4>
                    <div id="grafica_cantidad_top_productos" style="height: 250px;"></div>
                    <div class="row">
                            <div style="padding-left:40px" class="col-lg-6 col-sm-6">
                              <h4> Distribucion de usuarios </h4>
                            </div>
                            <div style="padding-left:40px" class="col-lg-6 col-sm-6">
                              <h4> Productos mas caros<h4>
                            </div>
                       </div>
                    <div class="row">
                       
                        <div class="row">
                          <br><br>
                           
                           <div class="col-lg-3 col-sm-3">
                            <br><br>
                                <div id="usuarios_activosEInactivos" style="height: 250px;"></div>
                           </div>
                            <div class="col-lg-3 col-sm-3">
                              <br><br>
                                <div id="usuarios_y_administradores" style="height: 250px;"></div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                               <div style="padding-left:40px" class="col-lg-11 col-sm-11">
                              
                              </div>
                                <div id="productos_mas_caros" style="height: 250px;"></div>
                            </div>
                      </div>
                    </div>
                    <br><br>
                    <div class="row">
                       <div class="row">
                          
                          <div class="col-lg-6 col-sm-6">
                            <div style="padding-left:40px" class="col-lg-11 col-sm-11">
                              <h4> Tipos de Producto mas Vendidos </h4>
                            </div>
                            <div id="tipos_producto" style="height: 250px;"></div>
                          </div>
                          <div class="col-lg-6 col-sm-6">
                            <div style="padding-left:40px" class="col-lg-11 col-sm-11">
                              <h4> Estado de productos </h4>
                            </div>
                            <div id="productos_activosEInactivos" style="height: 250px;"></div>
                          </div>
                        </div>
                      </div>');
                      ?>
                    <div class="row">
                    <div style="height: 100px";"></div>
                    <h4 style="padding-left:40px"> Actividades del mes</h4>
                    </div>
                    <div id='calendar'></div>
                    
                       
                  <!-- end container -->
                  <div class="row">
                    <div style="height: 150px";"></div>
                  </div>
                  <div class="footer" style="padding-top:100px;">
                    
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
        
        <script src="assets/plugins/moment/moment.js"></script>
        <script src='assets/plugins/fullcalendar/js/fullcalendar.min.js'></script>
        <script src="assets/pages/jquery.fullcalendar.js"></script>


        <!-- Logout-->
        <script src="lib/fun.js"></script>

        <script>
          //Creando calendario simple
          $(document).ready(function() {
              $('#calendar').fullCalendar({
              })

          });

          //Grafica top de productos
          Morris.Line({
                element:'grafica_cantidad_top_productos',
                data: [           
                    <?php
                      getDateGraph();
                    ?>        
                 ],
                 xkey: 'week', 
                 ykeys: ['venta'],
                 labels: ['Total de venta del dia'],
                 parseTime:false,
                 hideHover:true,
                 lineWidth:'6px',
                 stacked: true           
             
          });

          //Grafica con los tipos de productos
          new Morris.Bar({
          element: 'tipos_producto',
          data: [
            <?php
              getTypes();
            ?>

          ],
          xkey: 'mapname',
          ykeys: ['value'],
          labels: ['Cantidad']
          });

          //Grafica con los productos activos e inactivos
           Morris.Donut({
            element: 'productos_activosEInactivos',
            data: [
            <?php
                prod_activeAndInactive();

              ?>
            ]
          });

           //Grafica con los usuarios activos e inactivos
           Morris.Donut({
            element: 'usuarios_activosEInactivos',
            data: [
            <?php
                activeAndInactive();

              ?>
            ]
          });

           //Grafica con los usuarios y adminsitradores
               Morris.Donut({
            element: 'usuarios_y_administradores',
            data: [
            <?php
                getUserAdminChart();

              ?>
            ]
          });


          //Grafica con los productos mas caros  
          new Morris.Bar({
          element: 'productos_mas_caros',
          data: [
          
                    <?php
              getMostExpensive();
            ?>
   
          ],
          xkey: 'mapname',
          ykeys: ['value'],
          labels: ['Precio']
          });

        </script>

    </body>
</html>