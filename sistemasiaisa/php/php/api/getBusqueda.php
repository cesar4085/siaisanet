<?php

require_once '../model/BusquedaModel.php';
if(isset($_POST)){  
 $busqueda=new BusquedaModel();
 echo $busqueda->inputResults();
    
}
