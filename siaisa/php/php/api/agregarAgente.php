
<?php
require_once '../model/AltaModel.php';
 if (isset($_POST)) {
    if(!empty($_POST)){
    $nombre_agente = isset($_POST['nombre_agente'])? $_POST['nombre_agente']:null;
    $nombre_usuario =isset($_POST['nombre_usuario'])? $_POST['nombre_usuario']:null;
    $psw = isset($_POST['password_confirm'])? $_POST['password_confirm']:null; 
    $nivel=isset($_POST['nivel_usuario'] ) ?$_POST['nivel_usuario']: null; 
    $alta=new AltaModel();
    $alta->agregarAgente($nombre_agente, $nombre_usuario, $psw, $nivel);
   }
    
  }

 