<?php
require_once '../../model/EncuestaModel.php';
if(isset($_POST)){
    
    $jsonInput=file_get_contents('php://input');
    $data= json_decode($jsonInput);
    $encuesta=new EncuestaModel();

    
    if(isset($data->type)){
        
        
        switch ($data->type){
            
            case "noContesto":
                    $encuesta->guardarNoEntraLlamada($data);
                break;
            
            case "motivoContacto":
                $encuesta->guardarMotivoNoContactado($data);
                break;
            
            case "interesCredito":
                $encuesta->guardarInteresCredito($data);
             break;
         
            case "todo":
                $encuesta->guardarRestoLlamada($data);
                break;
            
        }
        
        
    }
}