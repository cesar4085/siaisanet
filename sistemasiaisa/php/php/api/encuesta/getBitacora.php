<?php

require_once '../../model/EncuestaModel.php';
 if(isset($_POST)){
      
     $id_cliente=  filter_input(INPUT_POST, "id_cliente");
     $encuesta=new EncuestaModel();
     echo  $encuesta->getBitacora($id_cliente);
 }
