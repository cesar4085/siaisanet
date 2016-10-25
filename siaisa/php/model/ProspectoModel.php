<?php
include_once(__DIR__ . '/Conexion.php');
class ProspectoModel {
   
    private  $conn;
    public function __construct() {
         $conexion=new Conexion();
         $this->conn=$conexion->getConexion(true);
    }
   public function guardarRestoLlamada($data){
            
  	    $visible=1;
            if($data->contacto==1 || isset($data->agendar_cita))
            {
                    $visible=0;
            }
            else if(isset($data->id_motivo_no_contacto)){
                    if($data->id_motivo_no_contacto==4 || $data->id_motivo_no_contacto==5 ){
                        $visible=0;
                    }
	            else if($data->id_motivo_no_contacto==1)
		    {
		    	$data->contacto=1;
			$visible=0;
		    }

                }
            try{
               $fin=$this->getCurrentFecha();
              //TODO PASAR A UN STORE PROCEDURE TODO ESTO
               $query=$this->conn->prepare("INSERT INTO  sistem80_precalificacion.bitacora(inicio,fin,contacto,notas,interlocutor_nombre,interlocutor_paterno,intelocutor_materno,
               id_cliente,id_agente,id_tipo_llamada,id_motivo_no_contacto,id_status_llamada,fecha_cita,fecha_contacto,id_no_interes,id_tipo_interes)
               VALUES(:inicio,:fin,:contacto,:notas,:interlocutor_nombre,:interlocutor_paterno, :interlocutor_materno,:id_cliente,:id_agente,:id_tipo_llamada,:id_motivo_no_contacto,
               :id_status_llamada,:fecha_cita,:fecha_contacto,:id_no_interes,:id_tipo_interes)"); 
                $inicio=$this->getCurrentFecha();
                $query->bindValue(":id_agente",$data->id_agente);
                $query->bindParam(":id_cliente",$data->id_cliente);
                $query->bindParam(":inicio",$inicio);
                $query->bindParam(":fin",$fin);
                $query->bindParam(":id_tipo_llamada",$data->id_tipo_llamada);
                $query->bindParam(":notas", $data->notas);
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
                
                $queryUpdate=$this->conn->prepare("UPDATE sistem80_precalificacion.cliente SET sucursal=:sucursal, visible=:visible WHERE id_cliente=:id_cliente");
                $queryUpdate->bindValue(":sucursal",$data->sucursal);
                $queryUpdate->bindValue(":visible",$visible);
                $queryUpdate->bindValue(":id_cliente",$data->id_cliente);
                $queryUpdate->execute();
               //VALIDACION BACKEND AHORA VOY HACER DEL FRONTEND CON ANGULARJS 
                if(isset($data->agendar_cita) && isset($data->sucursal))
                {
                    //Enviar email aqui
                    $this->enviarEmail($data->id_cliente,$data->agendar_cita);
                }
                //GET CONTACTACIÓN
                echo $this->getContactacion($data->id_agente);
               
            } catch (PDOException $ex) {
                $this->enviarError($ex->getMessage());
            }
       
    }
    private function getContactacion($id_agente){
        $sp=$this->conn->prepare("call sistem80_precalificacion.info_citas_by_id(:id_agente)");
        $sp->bindParam(":id_agente",$id_agente);
        $sp->execute();
        $res=$sp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res[0]);
    }
   public function getHistorial($id_cliente){
        $query=$this->conn->prepare("SELECT*FROM sistem80_precalificacion.historial WHERE id_cliente=:id group by date(inicio)");
        $query->bindParam(":id",$id_cliente);
        $query->execute();
       return $this->utf8_converter($query->fetchAll(PDO::FETCH_ASSOC));
    }
   public function  enviarEmail($id_cliente,$fecha_cita){
        
                $querySelect=$this->conn->query("SELECT * FROM sistem80_precalificacion.cliente WHERE id_cliente=".$id_cliente);
                $cliente=$querySelect->fetch();
                $mensaje='<div style="background-color:#262368;padding:5px 12px;"><table cellspacing="0" border="0"><tbody><tr><td><img src="http://sistema-siaisa.net/img/logo-siaisa.png" style="width:32px;"></td><td><span style="font-family:sans-serif;color:white;font-size:18px;">SIAISA</span></td></tr></tbody></table></div>';
                $mensaje.="<i>FOLIO:</i><strong>".$cliente["folio"]."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>BC:</i><strong>".$cliente["bc"]."</strong>";
                $mensaje.="<i>NOMBRE:</i><strong>".$cliente["nombre"]."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>SUCURSAL:</i><strong>".strtoupper($cliente['sucursal'])."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>TELEFONO MOVIL:</i><strong>".$cliente["tel_celular"]."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>FECHA CITA:</i><strong>".$fecha_cita."</strong>";
                $mensaje.="<br>";
                $headers.="From:precalificado@promocionesfinancieraayudamos.com\r\n";
                $headers.="MIME-Version: 1.0\r\n";
                $headers.="Content-Type: text/html; charset=UTF-8\r\n";
                mail("m.orozco@siaisa.com.mx,daniel.diaz.1@bbva.com,f.grego@bbva.com,tanyapamela.cantu@bbva.com,oemy93@hotmail.com","NOTIFICACIONES PRECALIFICADO",$mensaje,$headers);
    }
   public function getProspecto(){
        $ultimo_intento=$this->getCurrentFecha();
        setcookie("inicio",$ultimo_intento);
        $this->conn->beginTransaction();
        $querySelect=$this->conn->query("SELECT * FROM sistem80_precalificacion.cliente where en_linea=0 AND UNIX_TIMESTAMP(fin_ultimo_intento) =0 AND UNIX_TIMESTAMP(ultimo_intento)=0 AND visible=1 order by carga asc LIMIT 1");
        $clienteActual=$querySelect->fetch();
        if(!empty($clienteActual)){
            $queryUpdate=$this->conn->prepare("UPDATE sistem80_precalificacion.cliente SET en_linea=1, ultimo_intento=:ultimo_intento WHERE id_cliente=:id_cliente");
                        $queryUpdate->bindParam(":id_cliente",$clienteActual["id_cliente"]);
                        $queryUpdate->bindParam(":ultimo_intento",$ultimo_intento);
                        $queryUpdate->execute();
        }
        else{
                     $queryVuelta=$this->conn->prepare("UPDATE sistem80_precalificacion.cliente SET ultimo_intento='0000-00-00 00:00:00' , fin_ultimo_intento ='0000-00-00 00:00:00' , en_linea = 0  where id_cliente >0");
                     $queryVuelta->execute();
                     $this->conn->commit();
                     $this->enviarError("Al parecer ya no hay más clientes presiona F5 para dar vuelta a la bd");
                     mail('oemy93@hotmail.com','VUELTA BD', 'HE DADO VUELTA A LA BD PRECALIFICADO');
        }
        $this->conn->commit();
        //RETORNAMOS LOS DATOS DEL CLIENTE EN FORMATO 
        //
        $historial=$this->getHistorial($clienteActual["id_cliente"]);
        return json_encode(
                array("cliente"=>$this->utf8_converter($clienteActual), "historial"=>$historial));
       }
    
   public  function getProspectoByFolio($folio){
        $ultimo_intento=$this->getCurrentFecha();
        $this->conn->beginTransaction();
        $querySelect=$this->conn->query("SELECT * FROM sistem80_precalificacion.cliente WHERE folio='".$folio."'");
        $cliente=$querySelect->fetch();
        if(!empty($cliente)){
            $queryUpdate=$this->conn->prepare("UPDATE sistem80_precalificacion.cliente SET en_linea=1, ultimo_intento=:ultimo_intento WHERE id_cliente=:id_cliente");
                        $queryUpdate->bindParam(":id_cliente",$cliente["id_cliente"]);
                        $queryUpdate->bindParam(":ultimo_intento",$ultimo_intento);
                        $queryUpdate->execute();
        }
        
        $this->conn->commit();
        //RETORNAMOS LOS DATOS DEL CLIENTE EN FORMATO JSON
        return json_encode($this->utf8_converter($cliente));
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
    
 
   public  function enviarError($mensaje){
                        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                        die($mensaje);
    }
}
