<?php
/*
    OBTIENE AL NUEVO CLIENTE QUE SERÁ REGISTRADO EN LA BD
*/
header('Access-Control-Allow-Origin: *');
require_once '../../Model/EncuestaModel.php';
if(isset($_GET)){
     //BUSQUEDA DE CLIENTE POR ID
    if(isset($_GET['id_cliente']))
    {
        $id_cliente=  filter_input(INPUT_GET, "id_cliente");
        $encuesta=new EncuestaModel();
        echo $encuesta->getClienteById($id_cliente);
    }
    else 
    {
         $encuesta=new EncuestaModel();
         echo $encuesta->getCliente();
    }
   
}

