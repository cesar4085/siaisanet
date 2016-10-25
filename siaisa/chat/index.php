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
  <link rel="stylesheet" href="../css/rome.css">
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
 <form class="form-horizontal"  id="form-registrar-chat"  method="get">
  <fieldset>
    <!-- Form Name -->
    <legend>Registro de chat.</legend>
    <!-- Text input-->
     <div class="form-group">
      <!-- Contraseña -->
      <label class="col-md-4 control-label" for="procedencia">Procedencia:</label>
      <div class="col-md-4">
        <select type="list" id="procedencia" name="procedencia" placeholder="" class="form-control input-md" required="">
            <option value="1" selected>Chat</option>
            <option value="2">SMS</option>
      
       </select>
     </div>
   </div>
    <div class="form-group" style="padding-top:30px">
      <label class="col-md-4 control-label" for="nombre_cliente">Nombre del cliente</label>  
      <div class="col-md-4">
        <input id="name" name="nombre_cliente" type="text" placeholder="Nombre:" class="form-control input-md" required="" >
         <input id="nombre_agente" name="nombre_agente" type="hidden" value= "<?php
        echo $menu->imprimirNombre();?>">
      </div>
    </div>
    <!-- Entrada Texto-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="folio">Folio</label>  
      <div class="col-md-4">
        <input id="folio" name="folio" type="text" placeholder="folio del chat" class="form-control input-md" required="" >
      </div>
    </div>
        <!-- Contraseña input-->
        <div class="form-group">
      <label class="col-md-4 control-label" for="mail">Email</label>
      <div class="col-md-4">
        <input id="mail"  name="mail" type="text" placeholder="Email" class="form-control input-md" required="" pattern="[a-zA-Z0-9.!#$%&'@*+/=?^_`{|}~-]{6,40}">
      </div>
    </div>
    <!-- Contraseña input-->
    <div class="form-group">
      <label class="col-md-4 control-label" for="tel_1">Telefono </label>
      <div class="col-md-4">
        <input id="tel_1"  name="tel_1" type="text" placeholder="Telefono" class="form-control input-md" required="" pattern="[0-9]{6,40}">
      </div>
    </div>

    <div class="form-group">
      <!-- Contraseña -->
      <label class="col-md-4 control-label" for="status">Status:</label>
      <div class="col-md-4">
        <select type="list" id="status" name="status" placeholder="Elige al menos uno" class="form-control input-md" required="">
            <option value="0"></option>
            <option value="1">Si le interesa</option>
            <option value="2">No le interesa</option>
            <option value="3">No es el titular</option>
             <option value="4">cliente sin status: Abandono de chat</option>
       </select>
     </div>
   </div>
  

   <div class="form-group" style="padding-top:30px">
      <label class="col-md-4 control-label" for="notas">Notas</label>  
      <div class="col-md-4">
        <textarea id="notas" name="notas" type="text" placeholder="Notas" class="form-control input-md"  style="WIDTH: 100%; HEIGHT: 98px" row="3"></textarea>
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
<script src="../js/vendor/wow.min.js"></script>
<script src="../js/vendor/rome.js"></script>
<script src="../js/vendor/jquery-1.11.2.js"></script>
<script src="../js/notiny.min.js"></script>
<script src="../js/chat/chatCtrl.js"></script>

</body>
</html>