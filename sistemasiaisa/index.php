<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIAISA INICIO</title>
        <!-- CSS -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic">   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/login-forms.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
    </head>

    <body>
		<!-- Login Form 3 -->
                 <?php
                 require_once './php/model/LoginModel.php';
          
                if(!empty($_POST))
                {

                    if(filter_has_var(INPUT_POST, "usuario") && filter_has_var(INPUT_POST, "password"))
                    {

                         $usuario=filter_input(INPUT_POST, "usuario");
                         $password=  filter_input(INPUT_POST, "password");
                         if(empty($usuario)){
                             $error="¡Ingresa tu nombre de usuario";
                         }
                         else if(empty ($password)){
                             $error="¡Ingresa tu contraseña";
                         }
                         else{
                             $login = new LoginModel();
                             if($login->iniciarLogin($usuario, $password)){


                                $login->redirect("menu/");


                             }
                             else{
                                 $error="¡Tu usuario o password son incorrectos";
                             }
                         }

                    }
               
              
           } ?>
		<div class="l-form-3-container section-container section-container-image-bg">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-8 col-sm-offset-2 l-form-3 section-description wow fadeIn">
	                    <h2>SIAISA </h2>
	                    <div class="divider-1 wow fadeInUp"><span></span></div>
	                    <p>Inicio de sesión</p>
	                </div>
	            </div>
	            <div class="row">
	            	<div class="col-sm-6 col-sm-offset-3 l-form-3-box wow fadeInUp">
	            		
	                    <div class="l-form-3-top">
                    		<div class="l-form-3-top-left">
                                                    <?php
                                                                   if(isset($error))
                                                                  {
                                                                        ?>
                                                                        <div class="alert alert-danger">
                                                                            <i class="fa fa-warning"></i> &nbsp; <?php echo $error; ?> !
                                                                        </div>
                                                                        <?php
                                                                   }
                                                               ?>
                    			<h3>Ingresa tu usuario y password</h3>
								<p>Recuerda que tu usuario y contraseña son sólo para tu uso ¡NO lo prestes!</p>
                    		</div>
                    		<div class="l-form-3-top-right">
                                    <img src="img/logo-siaisa.png"/>
                    		</div>
                        </div>
                        <div class="l-form-3-bottom">
		                    <form role="form" id="login-form" action="#" method="post" role="form">		                        
		                        <div class="form-group">
		                    		<label class="sr-only" for="l-form-3-username">Usuario</label>
		                        	<input type="text"  name="usuario" placeholder="Usuario" class="l-form-3-username form-control" id="l-form-3-username">
		                        </div>
		                        <div class="form-group">
		                        	<label class="sr-only" for="l-form-3-password">Contraseña</label>
		                        	<input type="password"   name="password" placeholder="Contraseña" class="l-form-3-password form-control" id="l-form-3-password">
		                        </div>
		                        <button type="submit" class="btn btn-default">Ingresar</button>
		                    </form>
	                    </div>
	                    
	                </div>
	            </div>
	       
	        </div>
                </div>
        <script src="js/vendor/jquery-1.11.2.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/jquery.backstretch.min.js"></script>
        <script src="js/vendor/wow.min.js"></script>
        <script src="js/vendor/retina-1.1.0.min.js"></script>
        <script src="js/vendor/waypoints.min.js"></script>
        <script src="js/vendor/login-forms.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
        <script src="js/angular/controladores/loginCtrl.js?id=1.1"></script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
    </body>

</html>