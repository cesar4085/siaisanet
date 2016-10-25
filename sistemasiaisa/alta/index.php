<!doctype html>
<html class="no-js" lang="" > <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>COBRANZA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/main.css">
  <link rel="stylesheet" href="../css/animate.css">
  <link rel="stylesheet" href="../css/notiny.min.css">
  <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body >
 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a  class="navbar-brand animacion" href="#"><span><img src="../img/logo-siaisa.png" width="35" height="35"/></span> <?php
        require_once '../php/model/MenuModel.php';
        $menu=new MenuModel();
        echo $menu->imprimirNombre();
      ?></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
          <li><a href="../logout.php">CERRAR SESIÓN</a></li>
      </ul> 
    </div>
  </div>
</nav>
    <a href="../menu/"><button  type="button" class="btn btn-primary btn-lg "id="regresar" style="margin-top:80px; margin-left:25px;" >Regresar</button></a>
<div class="container" style="padding-top:20px">
 <form class="form-horizontal"  id="form-registrar" >
  <fieldset>
    <!-- Form Name -->
    <legend>Agregar Agente</legend>
    <!-- Text input-->
    <div class="form-group" style="padding-top:30px">
      <label class="col-md-4 control-label" for="name">Nombre agente</label>  
      <div class="col-md-4">
        <input id="name" name="nombre_agente" type="text" placeholder="ejemplo: Victor Gomez Reyes" class="form-control input-md" required="" pattern="[a-zA-Z ]{8,45}">
      </div>
    </div>
    <!-- Entrada Texto-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="email">Nombre Usuario</label>  
      <div class="col-md-4">
        <input id="email" name="nombre_usuario" type="text" placeholder="ejemplo: victor-siaisa" class="form-control input-md" required="" pattern="[a-zA-Z0-9- ]{7,40}">
      </div>
    </div>
    <!-- Contraseña input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="password">Contraseña</label>
      <div class="col-md-4">
        <input id="password"  name="password" type="password" placeholder="minimo 6 caracteres" class="form-control input-md" required="" pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]{6,40}">
      </div>
    </div>
    <div class="form-group">
      <!-- Contraseña -->
      <label class="col-md-4 control-label" for="password_confirm">Confirmar Contraseña</label>
      <div class="col-md-4">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="Por favor confirma la contraseña" class="form-control input-md" required="" pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]{6,40}">
      </div>
    </div>
    <div class="form-group">
      <!-- Contraseña -->
      <label class="col-md-4 control-label" for="password_confirm">Nivel De Usuario</label>
      <div class="col-md-4">
        <select type="list" id="nivel_usuario" name="nivel_usuario" placeholder="Elige al menos uno" class="form-control input-md" required="">
            <option value="3">Agente</option>
            <option value="2">Monitorista</option>
            <option value="1">Administrador</option>
       </select>
     </div>
   </div>
   <!-- Boton -->
   <div class="form-group">
    <label class="col-md-4 control-label" for="signup"></label>
    <div class="col-md-4">
      <button id="signup" name="signup" class="btn btn-red" type="Submit" value= "submit">Registrar</button>
    </div>
  </div>
 
</fieldset>
</form>
</div>
<footer>
  <span>2016 SIAISA</span>
</footer>
<script src="../js/vendor/jquery-1.11.2.js"></script>
<script src="../js/notiny.min.js"></script>
<script src="../js/main.js?id=1.1"></script>
</body>
</html>