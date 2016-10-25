<?php
require_once '../Model/ProspectoModel.php';
if(filter_has_var(INPUT_GET, 'folio')){
   $prospecto = new ProspectoModel();
    echo $prospecto->getProspectoByFolio(filter_input(INPUT_GET,'folio'));
   
}else{
    $prospecto = new ProspectoModel();
    echo $prospecto->getProspecto(); 
}
