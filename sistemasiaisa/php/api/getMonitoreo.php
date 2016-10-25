<?php
 header('Access-Control-Allow-Origin: *');
 require_once '../model/MonitoreoModel.php';
 if(isset($_GET)){
    
    $monitor=new MonitoreoModel();
    
     if(isset($_GET["fecha_inicio"]) && isset($_GET['fecha_fin']))
      {
         echo $monitor->getMonitoreoByDate($_GET['fecha_inicio'],$_GET['fecha_fin']);
     }
     else if(isset($_GET['isCita'])){
         echo $monitor->getMonitoreoAndCitas();
     }
     else{
           echo $monitor->getMonitoreo(true);
     }
    
 }