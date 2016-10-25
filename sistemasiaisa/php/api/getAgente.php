<?php
header('Access-Control-Allow-Origin: *');
 if(isset($_GET)){
     session_start();
     if(isset($_SESSION)){
         if(!empty($_SESSION["id_agente"])){
              echo json_encode($_SESSION);
         }
         else{
             header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
             die("Para ingresar a está sección debes de iniciar sesión");
         }
     }
    
 }