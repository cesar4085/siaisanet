<?php
 require_once '../model/CobranzaModel.php';
 
 if(isset($_GET)){
   
      
      $cobranza=new CobranzaModel();
      echo  $cobranza->getCliente();
    
      
 }
