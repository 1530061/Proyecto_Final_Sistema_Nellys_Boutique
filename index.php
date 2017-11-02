<?php 
	include ("lib/db.php");
	include ("lib/log.php");

	session_start();

	if (!empty($_SESSION["logg"]))
	header('Location: /final/dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Nelly's Boutique</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

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
    	<?php
    		if(!empty($_POST['usr'])&&!empty($_POST['password']))
    			exists_user($_POST['usr'], $_POST['password']);
		?>
        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 card-box">
                                <div class="text-center">
                                    <h2 class="text-uppercase m-t-0 m-b-30">
										<a href="dashboard.php" class="text-success">
											<span><img src="assets/images/logo.png" alt="" height="130"></span>
										</a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="index.php" method="POST">

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="usr">Usuario</label>
                                                <input class="form-control" type="text" id="usr" name="usr" required="" placeholder="" maxlength="50">
                                            </div>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <div class="col-xs-12">
                                                <label for="password">Contraseña</label>
                                                <input class="form-control" type="password" required="" id="password" name="password" placeholder="" maxlength="50">
                                            </div>
                                        </div>


                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">  
												    <button class="btn btn-lg btn-primary btn-block" type="submit"> Ingresar</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            <div class="clearfix">
                            	
                            </div>

                            </div>
                        </div>
                            <!-- end card-box-->



                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>

        </section>
        <!-- END HOME -->

        <script>
          document.addEventListener( 'keydown', function( event ) {
            var caps = event.getModifierState && event.getModifierState( 'CapsLock' );
            console.log( caps ); // true when you press the keyboard CapsLock key
          });
        </script>


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/metisMenu.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>

        <!-- App Js -->
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>)
