<?php
 header('Content-Type: text/event-stream');
 header('Cache-Control: no-cache');
 require_once '../../model/Conexion.php';
 $jsonInput=file_get_contents('php://input');
    
    if(!empty($jsonInput)){
        
        $data_json= json_decode($jsonInput);
        $handle = fopen("upload/".$data_json->nombre_archivo, "r");
        $count=0;
        $instancia= new Conexion();
        $conn=$instancia->getConexion();
        
         set_time_limit(300); 
        if (session_status() == PHP_SESSION_NONE)
         {
                       session_start();  

        }
      	

    
        while (($csv = fgetcsv($handle, 1000, ",")) !== FALSE) {


           if($count>=1){
      
            $count++;
    
            $query=$conn->prepare("call encuesta_agregar_layout(:no_contrato,:nombre,:telefono_fijo,:telefono_movil,:id_prioridad,
            :periodicidad,:plazo,:monto_autorizado,:monto_autorizado_2,:pago,:monto_adicional,:monto_adicional_2,:tipo_credito )");

            $id_prioridad= isset( $data_json->id_prioridad) || $data_json->id_prioridad=="ninguno"? $csv[$data_json->id_prioridad]: null;
            $monto_autorizado_2=isset($data_json->monto_autorizado_2) || $data_json->monto_autorizado_2=="ninguno"? $csv[$data_json->monto_autorizado_2]: null;
            $monto_adicional_2=  isset($data_json->monto_adicional_2) || $data_json->monto_adicional_2=="ninguno"? $csv[$data_json->monto_adicional_2]: null; 
            
            $query->execute(array(
                "no_contrato"=>$csv[$data_json->no_contrato],
                "nombre"=>$csv[$data_json->nombre],
                "telefono_fijo"=>$csv[$data_json->telefono_fijo],
                "telefono_movil"=>$csv[$data_json->telefono_movil],
                "id_prioridad"=>$id_prioridad,
                "periodicidad"=>$csv[$data_json->periodicidad],
                "plazo"=>$csv[$data_json->plazo],
                "monto_autorizado"=>$csv[$data_json->monto_autorizado],
                "monto_autorizado_2"=>$monto_autorizado_2,
                "pago"=>$csv[$data_json->pago],
                "monto_adicional"=>$csv[$data_json->monto_adicional],
                "monto_adicional_2"=>$monto_adicional_2,
                "tipo_credito"=>$csv[$data_json->tipo_credito]
            ));
            
           $_SESSION['progreso']=$count;
        }else{
             $queryTruncar=$conn->prepare("call encuesta_layout_truncar()");
             $queryTruncar->execute();
             $_SESSION['progreso']=0;
             $count++;
        }
          
       }
        echo 'EL LAYOUT SE HA GUARDADO CORRECTAMENTE';
    }
  