<?php
require_once '../Model/Conexion.php';
$data = file_get_contents("php://input");
$events = json_decode($data, true);
foreach ($events as $event) {
 // mail('oemy93@hotmail.com', 'Prueba', json_encode($event)); //SOLO PARA PROBAR SI ENTRA AL WEBHOOK DE SENDGRID
  $conexion = new Conexion();
  $con=$conexion->getConexion();
  $click=NULL; //EL STORE PROCEEDURE NOS PIDE UN PARAMETRO PARA VER SI ES CLICK
  if($event['event']=='click'){ //EL EVENTO CLICK 
      $_url_cortada=substr($event['url'],40); //CORTAMOS LA URL PARA VER  SI ES REGISTRO O NO INTERESA
      //¿LA URL CORTADA TIENE LA PALABRA REGISTRO?
      if (strpos($_url_cortada, 'registro') !== false) {
          $click=1;
      }
      else{ //EL USUARIO DIO CLICK A NO INTERESA 
          $click=0;
      }
              
  }
  $query=$con->prepare("call sendGridWebHook(:evento_nombre,:mensaje_id,:email,:click)");
  $query->bindParam(":evento_nombre",$event['event']);
  $query->bindParam(":mensaje_id",$event['sg_message_id']);
  $query->bindParam(":email",$event['email']);
  $query->bindParam(":click",$click);
  $query->execute();  
  
}



