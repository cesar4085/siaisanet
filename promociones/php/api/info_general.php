<?php
        require_once '../Model/ReporteModel.php';
        $reporte = new ReporteModel();
        
        if(filter_has_var(INPUT_GET, 'id_segmento') && filter_has_var(INPUT_GET,'is_menu')){
            $id=filter_input(INPUT_GET,'id_segmento');
            echo $reporte->getInfoGeneral($id);
        }
        else{
             $id=filter_input(INPUT_GET,'id_segmento');
              echo $reporte->getInfoGeneralById($id);
        }
       
    
  

