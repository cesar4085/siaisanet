

<?php
    set_time_limit(300);  
    $jsonInput=file_get_contents('php://input');
    if(!empty($jsonInput)){
        
        $data_json= json_decode($jsonInput);
        $layout = new Layout();
        if($data_json->tipo==1){
            $layout->guardarEnvios($data_json);
        }else if($data_json->tipo==2){
           $layout->guardarRespuesta($data_json);
        }
     
      
    }
    class Layout{
        
        private $conn;
        public function __construct() {
            
                                $dbName="promoc23_SMS";
                                $user="promoc23_siaisa";
                                $password="director1210";
                                $host="promocionesfinancieraayudamos.com";
                                $this->conn= new PDO("mysql:host=".$host.";dbname=".$dbName,$user,$password);
                                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        }
        public function guardarLayout($producto,$tipo){
            $query=$this->conn->prepare("call sp_crearLayout(:id_producto,:tipo)");
            $query->bindValue(":id_producto",$producto);
            $query->bindValue(":tipo",$tipo);
            $query->execute();
        }
        public function guardarEnvios($data_json){
        $handle = fopen("upload/".$data_json->nombre_archivo, "r");
        $count=0;
        $layoutGuardado=false;
        while (($csv = fgetcsv($handle, 1000, ",")) !== FALSE) {
           if($count>=1){

                $count++;
                $producto= $data_json->producto!="ninguno" ? $csv[$data_json->producto]:null;
                $cuenta=$data_json->cuenta!="ninguno"  ?$csv[$data_json->cuenta]:null;
                $telefono=$data_json->telefono!="ninguno"  ?$csv[$data_json->telefono]:null;
                $mensaje=$data_json->mensaje!="ninguno"  ?$csv[$data_json->mensaje]:null;
                $resultado=$data_json->resultado!="ninguno"  ?$csv[$data_json->resultado]:null;
                $fecha_envio=$data_json->fecha_envio!="ninguno"  ?$csv[$data_json->fecha_envio]:null;
                $tipo_envio=$data_json->tipo_envio !="ninguno"  ?$csv[$data_json->tipo_envio]:null;
               
            //LLAMAR SP AQUÍ
                    if(empty($producto)){
                        $this->enviarError('Producto esta vacio en la fila '.$count);
                    }
                    else if(empty ($cuenta)){
                        $this->enviarError('Cuenta vacia en la fila '.$count);
                    }
                    else if(empty($telefono)){
                        $this->enviarError('Telefono vacio en la fila '.$count);
                    }
                    else if(empty($mensaje)){
                        $this->enviarError('Mensaje vacio en la fila '.$count);
                    }
                    else if(empty($resultado)) {
                         $this->enviarError('Resultado fija vacia en la fila '.$count);
                    }
                    else if(empty ($fecha_envio)){
                        $this->enviarError('Fecha envio letra vacia en la fila '.$count);
                    }
                    else if(empty ($tipo_envio)){
                          $this->enviarError('Tipo vacia en la fila '.$count);
                    }
                    else{

                        try{
                                $this->conn->beginTransaction();
                                $query=$this->conn->prepare("INSERT INTO envios(producto,cuenta,telefono,mensaje,resultado,fecha_envio,tipo_envio) VALUES(:producto,:cuenta,:telefono,:mensaje,:resultado,:fecha_envio,:tipo_envio)");
                                $query->bindParam(":producto",$producto,PDO::PARAM_STR);
                                $query->bindParam(":cuenta",$cuenta,PDO::PARAM_STR);
                                $query->bindValue(":telefono",$telefono);
                                $query->bindParam(":mensaje",$mensaje,PDO::PARAM_STR);
                                $query->bindParam(":resultado",$resultado);
                                $query->bindParam(":fecha_envio",$fecha_envio);
                                $query->bindParam(":tipo_envio",$tipo_envio);
                                $query->execute();
                                if($layoutGuardado==false){
                                    $this->guardarLayout($producto,1);
                                    $layoutGuardado=true;
                                }
                                $this->conn->commit();
                        }
                        catch(Exception $ex){
                            $this->enviarError($ex->getMessage());
                            $this->conn->rollBack();
                        }
                       
                        
                     }
            
           
        }
        else{
            $count++;
        } 
        }
        echo 'OK AGREGADO CORRECTAMENTE';
        }  
        public function guardarRespuesta($data_json){
        $handle = fopen("upload/".$data_json->nombre_archivo, "r");
        $count=0;
        $layoutGuardado=false;
        while (($csv = fgetcsv($handle, 1000, ",")) !== FALSE) {
           if($count>=1){
                $count++;
                $producto=$data_json->id_producto;
                $telefono=$data_json->telefono!="ninguno"  ?$csv[$data_json->telefono]:null;
                $mensaje=$data_json->mensaje!="ninguno"  ?$csv[$data_json->mensaje]:null;
                $fecha=$data_json->fecha!="ninguno"  ?$csv[$data_json->fecha]:null;
                $tipo_respuesta=$data_json->tipo_respuesta !="ninguno"  ?$csv[$data_json->tipo_respuesta]:null;
                if(empty($producto)){
                     $this->enviarError($producto);
                }
                else if(empty($telefono)){
                        $this->enviarError('Telefono vacio en la fila '.$count);
                    }
                    else if(empty ($fecha)){
                        $this->enviarError('Fecha envio letra vacia en la fila '.$count);
                    }
                    else if(empty ($tipo_respuesta)){
                         $this->enviarError('Tipo vacia en la fila '.$count);
                    }
                    else{
                        try{
                             
                                $this->conn->beginTransaction();
                                $query=$this->conn->prepare("INSERT INTO respuestas(producto,telefono,mensaje,fecha,tipo_respuesta) VALUES(:producto,:telefono,:mensaje,:fecha,:tipo_respuesta)");
                                $query->bindParam(":producto",$producto,PDO::PARAM_STR);
                                $query->bindParam(":telefono",$telefono);
                                $query->bindParam(":mensaje",$mensaje,PDO::PARAM_STR);
                                $query->bindParam(":fecha",$fecha);
                                $query->bindParam(":tipo_respuesta",$tipo_respuesta);
                                $query->execute();
                                if($layoutGuardado==false){
                                    $this->guardarLayout($producto,2);
                                    $layoutGuardado=true;
                                }
                                $this->conn->commit();
                        }
                        catch(Exception $ex){
                            $this->enviarError($ex->getMessage());
                        }
                    }
           }
           else{
               $count++;
           }
        }
        echo 'OK AGREGADO CORRECTAMENTE';
       }
        public function enviarError($mensaje){
                        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                        die($mensaje);
        }
    }
    
    
  
    
    
    
       
    
  