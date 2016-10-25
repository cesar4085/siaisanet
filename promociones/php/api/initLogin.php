<?php
  if (session_status() == PHP_SESSION_NONE)
 {
                   session_start();  

 }
require_once '../Model/LoginModel.php';
$jsonInput=file_get_contents('php://input');
if(!empty($jsonInput)){
    $postData=  json_decode($jsonInput);
    $login=new LoginModel();
    $login->isValid($postData->nombre,$postData->password);   
}
else{
   if(isset($_GET['usuario_encuesta'])){
       $login=new LoginModel();
       echo $login->loginFromEncuesta($_GET['usuario_encuesta']);
   }
   else if(isset($_GET['usuario_pre'])){
         if(!empty($_SESSION["id_usuario"])){
              echo json_encode($_SESSION);
         }
   }
}