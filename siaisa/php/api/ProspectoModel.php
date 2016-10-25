<?php
include_once(__DIR__ . '/Conexion.php');
class ProspectoModel {
   
    private  $conn;
    public function __construct() {
         $conexion=new Conexion();
         $this->conn=$conexion->getConexion(true);
    }
     public function guardarRestoLlamada($data){

         
             
            $fin=$this->getCurrentFecha();          
            $query=$this->conn->prepare("INSERT INTO  sistem80_precalificacion.bitacora(inicio,fin,contacto,notas,interlocutor_nombre,interlocutor_paterno,intelocutor_materno,
               id_cliente,id_agente,id_tipo_llamada,id_motivo_no_contacto,id_status_llamada,fecha_cita,fecha_contacto,id_no_interes,id_tipo_interes)
               VALUES(
               :inicio,
               :fin,
               :contacto,
               :notas,
               :interlocutor_nombre,
               :interlocutor_paterno,
               :interlocutor_materno,
               :id_cliente,
               :id_agente,
               :id_tipo_llamada,
               :id_motivo_no_contacto,
               :id_status_llamada,
               :fecha_cita,
               :fecha_contacto,:id_no_interes,:id_tipo_interes)"); 
            $inicio= getCurrentFecha();
                $query->bindValue(":id_agente",$data->id_agente);
                $query->bindParam(":id_cliente",$data->id_cliente);
                $query->bindParam(":inicio",$inicio);
                $query->bindParam(":fin",$fin);
                $query->bindParam(":id_tipo_llamada",$data->id_tipo_llamada);
                $query->bindParam(":notas", utf8_decode(utf8_encode($data->notas)));
                $query->bindParam(":id_status_llamada",$data->id_status_llamada);
                $query->bindParam(":contacto",$data->contacto);
                $query->bindValue(":interlocutor_nombre",(isset($data->interlocutor_nombre)?$data->interlocutor_nombre:null),PDO::PARAM_STR);
                $query->bindValue(":interlocutor_paterno",(isset($data->interlocutor_paterno)?$data->interlocutor_paterno:null),PDO::PARAM_STR);
                $query->bindValue(":interlocutor_materno",(isset($data->interlocutor_materno)?$data->interlocutor_materno:null),PDO::PARAM_STR);
                $query->bindValue(":id_motivo_no_contacto",(isset($data->id_motivo_no_contacto)?$data->id_motivo_no_contacto:8),PDO::PARAM_INT);
                $query->bindValue(":fecha_cita",(isset($data->agendar_cita)?$data->agendar_cita:"0000-00-00 00:00:00"));
                $query->bindValue(":fecha_contacto",(isset($data->fecha_contacto)?$data->fecha_contacto:"0000-00-00 00:00:00"));
                $query->bindValue(":id_no_interes",isset($data->manejo_objecion)?$data->manejo_objecion:NULL);
                $query->bindValue(":id_tipo_interes",isset($data->tipo)?$data->tipo:NULL);
                $query->execute();
            
            if(isset($data->agendar_cita))
             {
                //Enviar email aqui 
                
                $querySelect=$this->conn->query("SELECT * FROM sistem80_precalificacion.cliente WHERE id_cliente=".$data->id_cliente);
                $cliente=$querySelect->fetch();
                $mensaje='<div style="background-color:#262368;padding:5px 12px;"><table cellspacing="0" border="0"><tbody><tr><td><img src="http://sistema-siaisa.net/img/logo-siaisa.png" style="width:32px;"></td><td><span style="font-family:sans-serif;color:white;font-size:18px;">SIAISA</span></td></tr></tbody></table></div>';
                $mensaje.="<i>FOLIO:</i><strong>".$cliente["folio"]."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>BC:</i><strong>".$cliente["bc"]."</strong>";
                $mensaje.="<i>NOMBRE:</i><strong>".$cliente["nombre"]."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>SUCURSAL:</i><strong>".  strtoupper($cliente['sucursal'])."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>TELEFONO MOVIL:</i><strong>".$cliente["tel_celular"]."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>FECHA CITA:</i><strong>".$data->agendar_cita."</strong>";
                $mensaje.="<br>";
                $headers.="From:precalificado@promocionesfinancieraayudamos.com\r\n";
                $headers.="MIME-Version: 1.0\r\n";
                $headers.="Content-Type: text/html; charset=UTF-8\r\n";
                mail("m.orozco@siaisa.com.mx,oemy93@hotmail.com,daniel.diaz.1@bbva.com,f.grego@bbva.com,tanyapamela.cantu@bbva.com","NOTIFICACIONES PRECALIFICADO",$mensaje,$headers);
            }
            
            echo 'OK';
     
     
           
       
    }
    public function getProspecto(){
        $ultimo_intento=$this->getCurrentFecha();
        setcookie("inicio",$ultimo_intento);
        $this->conn->beginTransaction();
        $querySelect=$this->conn->query("SELECT * FROM sistem80_precalificacion.cliente where ultimo_intento = '0000-00-00 00:00:00' AND en_linea=0 AND visible=1 and carga = 5 order by id_cliente desc LIMIT 1");
        $clienteActual=$querySelect->fetch();
        if(!empty($clienteActual)){
            $queryUpdate=$this->conn->prepare("UPDATE sistem80_precalificacion.cliente SET en_linea=1, ultimo_intento=:ultimo_intento WHERE id_cliente=:id_cliente");
                        $queryUpdate->bindParam(":id_cliente",$clienteActual["id_cliente"]);
                        $queryUpdate->bindParam(":ultimo_intento",$ultimo_intento);
                        $queryUpdate->execute();
        } 
        $this->conn->commit();
        //RETORNAMOS LOS DATOS DEL CLIENTE EN FORMATO JSON
        return json_encode($this->utf8_converter($clienteActual));
    }
    public static  function getCurrentFecha(){
        date_default_timezone_set('America/Mexico_City');
        return   $date = date('Y-m-d H:i:s');
   }
    public function utf8_converter($array)
    {
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
            }
        });

        return $array;
    }
}
