<?php
    require_once '../Model/ProspectoModel.php';
    $jsonInput=file_get_contents('php://input');
    $data= json_decode($jsonInput);
    if(!empty($data)){
          $prospecto = new ProspectoModel();
          $prospecto->guardarRestoLlamada($data);
    }