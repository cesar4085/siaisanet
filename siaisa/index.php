
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>SIAISA- Sistema</title>
        <!-- CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/generics.css" rel="stylesheet"> 
        <link href="css/animate.min.css" rel="stylesheet">
    </head>
    <body id="skin-blur-blue">
        <?php
            require_once './php/model/LoginModel.php';
            if(isset($_POST))
           {
               if(filter_has_var(INPUT_POST, "usuario") && filter_has_var(INPUT_POST, "password"))
               {                  
                    $usuario=filter_input(INPUT_POST, "usuario");
                    $password=  filter_input(INPUT_POST, "password");
                    if(empty($usuario)){
                        $error="Necesitas escribir un nombre de usuario";
                    }
                    else if(empty ($password)){
                        $error="Ingresa tu contraseña";
                    }
                    else{
                        $login = new LoginModel();
                        if($login->iniciarLogin($usuario, $password)){
                          $login->redirect("menu/");
                     }
                        else{
                            $error="Tu usuario o password son incorrectos";
                        }
                    }
                         }
                            
           } ?>
        <section id="img" class="encabezado">
          <header class= "img">
                  <img class="profile-pic animated" src="img/profile-pic.jpg" alt="">
                <h1>SIAISA </h1>
                <p>Sistema de datos .</p>
            </header>
        </section>
         <section id="login">
                           
                                                              <?php
                                                                   if(isset($error))
                                                                  {
                                                                        ?>
                                                                        <div class="alert alert-danger">
                                                                            <i class="glyphicon glyphicon-warning-sign"></i><?php echo $error; ?> 
                                                                        </div>
                                                                        <?php
                                                                   }
                                                               ?>
            <div class="clearfix"></div>
            <!-- Login -->
            <form class="box tile animated active"  id="box-login" action="index.php" method="post" role="form" >
                <h2 class="m-t-0 m-b-15">Acceso</h2>
                <input type="text" name="usuario"class="login-control m-b-10" placeholder="Usuario"tabindex="1" >
                <input type="password"name="password" class="login-control" placeholder="Contraseña"tabindex="2">
                <div class="checkbox m-b-20">
                   
                </div>
                <div id="signin">
                      <input type="image"name="login-submit"  src="img/profile-pic.jpg" onclick="document.getElementById('myImage').src='img/profile-pic-blue.jpg'"class="profile-pic animated"id="myImage"alt=""> </input>
                <small>
                    <a class="box-switcher" data-switch="box-reset" href="">Olvidaste tu password?</a>
                </small>
                </div>
            </form> 
            <!-- Forgot Password -->
            <form class="box animated tile" id="box-reset">
                <h2 class="m-t-0 m-b-15">Resetear contraseña</h2>
                <p>Le enviaremos un mail a magy con tu contraseña.</p>
                <input type="email" class="login-control m-b-20" placeholder="Nombre de Usuario">    
                <button class="btn btn-sm m-r-5"value="Entrar">Enviar Password</button>
               <a class="box-switcher" data-switch="box-login" href=""> Ya lo recordaste?,click aqui</a>
            </form>
        </section>                     
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script> <!-- jQuery Library -->
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <!--  Form Related -->
        <script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
        <!-- All JS functions -->
        <script src="js/functions.js"></script>
        <script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->


    </body>
</html>
