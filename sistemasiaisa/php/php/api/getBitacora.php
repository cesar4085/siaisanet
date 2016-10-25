<?php

 require_once '../model/CobranzaModel.php';
 if(isset($_POST)){
      
     $id_cliente=  filter_input(INPUT_POST, "id_cliente");
     $cobranza=new CobranzaModel();
     echo  $cobranza->getBitacora($id_cliente);
 }
