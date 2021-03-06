﻿<?php

/*

 * @author OSCAR PEREZ MARTINEZ
 */
include_once(__DIR__ . '/IModel.php'); 
include_once(__DIR__ . '/CustomHelpers.php'); 
class EncuestaModel extends IModel {
    /*
      MÉTODO QUE OBTIENE CONTACTACIÓN DEL AGENTE
      SE MUESTRA EN LA GRAFICA DE CONTACTACIÓN
    */
    public function getContactacion(){
       
   }
    /*
        OBTIENE INFORMACIÓN SOBRE EL HISTORIAL DE LLAMADAS DE UN CLIENTE
        @PARAM $ID_CLIENTE-> CLIENTE A QUIEN SE LE ESTÁ HACIENDO LA LLAMADA AHORA MISMO
    */
    public function getBitacora($id_cliente){
       
        try{
           $query=$this->conn->prepare("SELECT*FROM encuesta_historial WHERE inicio between (SELECT fecha_carga as date FROM sistem80_siaisa.base_de_datos where base_activa = 1 ) and  (select current_timestamp()) and id_cliente=:id_cliente");
           $query->bindParam(":id_cliente",$id_cliente);
           $query->execute();
           $res=$query->fetchAll(PDO::FETCH_ASSOC);
           $utf_encode=$this->utf8_converter($res);
           return json_encode($utf_encode);
       }
      catch(PDOException $ex){
         
          die($ex->getMessage());
      }
       
   }
   //NOTA: SOLO LLAMAR A ESTE SP CUANDO YA NO TENGAN MÁS CLIENTES POR CONTACTAR 
   public function darVuelta(){
       try{
           $query=$this->conn->prepare("call sp_dar_vuelta_base(5553926340)");
           $query->execute();
           $this->getCliente();
       } 
       catch (Exception $ex) {
           $this->enviarError("Error al dar vuelta base");
       }
   }
    public function getClienteById($id_cliente){
       try{
           
             if (session_status() == PHP_SESSION_NONE)
              {
                        session_start();  

             }
            if(isset($_SESSION['id_agente']))
            {
                    $id_agente=$_SESSION['id_agente'];
                    //ULTIMO INTENTO DE CONTACTO FECHA DE HOY 
                    $ultimo_intento=CustomHelpers::getCurrentFecha();
                   // setcookie("inicio",$ultimo_intento);
                    //SELECIONAMOS UN NUEVO CLIENTE DE LA BD CON STATUS EN_LINEA=0 
                    $this->conn->beginTransaction();
                    $querySelect=$this->conn->query("SELECT cliente_encuesta.*, credito_encuesta.periodicidad,credito_encuesta.plazo,credito_encuesta.monto_adicional,credito_encuesta.monto_autorizado,credito_encuesta.pago FROM cliente_encuesta INNER JOIN credito_encuesta ON cliente_encuesta.id_cliente=credito_encuesta.id_cliente WHERE  id_base_de_datos = 3 and cliente_encuesta.id_cliente=".$id_cliente);
                    $clienteActual=$querySelect->fetch();
                    //FECHA DE INICIO DE LLAMADA ES IGUAL AL ULTIMO INTENTO YA QUE LO ESTAMOS ACTUALIZANDO EN ESTE MISMO MOMENTO
                    $queryUpdate=$this->conn->prepare("UPDATE cliente_encuesta SET en_linea=1, en_linea_con=:id_agente, ultimo_intento=:ultimo_intento WHERE id_cliente=:id_cliente");
                    $queryUpdate->bindParam(":id_cliente",$clienteActual["id_cliente"]);
                    $queryUpdate->bindParam(":ultimo_intento",$ultimo_intento);
                    $queryUpdate->bindParam(":id_agente",$id_agente);
                    $queryUpdate->execute();              
                    //COMMIT  TRANSACCIÓN
                    $this->conn->commit();
                    //RETORNAMOS LOS DATOS DEL CLIENTE EN FORMATO JSON
                   return json_encode($this->utf8_converter($clienteActual));
           }
           else{
               $this->enviarError("NO SE HA INICIADO SESIÓN");
           }
      }
        //HA OCURRIDO ALGUNA EXCEPCIÓN DURANTE EL PROCESO DE SELECCIÓN
        catch(PDOException $ex){
            $this->conn->rollBack();
            die($ex->getMessage());
        }
   }
    /*
            MÉTODO PARA OBTENER UN NUEVO CLIENTE
            @PARAM ID_AGENTE--> AGENTE ACTUAL CONECTADO
    */
    public function getCliente(){
       try{
            $id_agente;
            session_start();
            if(isset($_SESSION['id_agente']))
            {

                    $id_agente=$_SESSION['id_agente'];
                    //ULTIMO INTENTO DE CONTACTO FECHA DE HOY 
                    //$ultimo_intento=CustomHelpers::getCurrentFecha();
                   // setcookie("inicio",$ultimo_intento);
                    //SELECIONAMOS UN NUEVO CLIENTE DE LA BD CON STATUS EN_LINEA=0 
                    $this->conn->beginTransaction();
                    $querySelect=$this->conn->query("SELECT cliente_encuesta.*, credito_encuesta.periodicidad,credito_encuesta.plazo,credito_encuesta.monto_adicional,credito_encuesta.monto_autorizado,credito_encuesta.pago FROM cliente_encuesta INNER JOIN credito_encuesta ON cliente_encuesta.id_cliente=credito_encuesta.id_cliente WHERE en_linea=0 AND UNIX_TIMESTAMP(fin_ultimo_intento) =0 AND UNIX_TIMESTAMP(ultimo_intento)=0 AND id_status_visible=1 ORDER BY id_prioridad ASC LIMIT 1 FOR UPDATE ");
                    
                    //$qyerySelect=$this->conn->query("SELECT cliente_encuesta.*, credito_encuesta.periodicidad,credito_encuesta.plazo,credito_encuesta.monto_adicional,credito_encuesta.monto_autorizado,credito_encuesta.pago FROM cliente_encuesta INNER JOIN credito_encuesta ON cliente_encuesta.id_cliente=credito_encuesta.id_cliente WHERE en_linea=0 AND  UNIX_TIMESTAMP(ultimo_intento ) =0   ORDER BY id_cliente ASC LIMIT 1 FOR UPDATE");
                    $clienteActual=$querySelect->fetch();
                    //NO HAY MÁS CLIENTES DISPONIBLES EN LA BD
                    if(empty($clienteActual)){
                      $queryVuelta=$this->conn->prepare("UPDATE cliente_encuesta SET ultimo_intento='0000-00-00 00:00:00' , fin_ultimo_intento ='0000-00-00 00:00:00' , en_linea = 0 ,en_linea_con = 0 where id_cliente >0");
                      $queryVuelta->execute();
                      $this->conn->commit();
                      mail('oemy93@hotmail.com','VUELTA BD', 'HE DADO VUELTA A LA BD');
                      $this->enviarError("Al parecer ya no hay más clientes presiona F5 para dar vuelta a la bd");
                    }
                    //HAY CLIENTES DISPONIBLES 
                    else{
                        
  
                        //FECHA DE INICIO DE LLAMADA ES IGUAL AL ULTIMO INTENTO YA QUE LO ESTAMOS ACTUALIZANDO EN ESTE MISMO MOMENTO
                        $queryUpdate=$this->conn->prepare("UPDATE cliente_encuesta SET en_linea=1, en_linea_con=:id_agente, ultimo_intento=:ultimo_intento WHERE id_cliente=:id_cliente");
                        $queryUpdate->bindParam(":id_cliente",$clienteActual["id_cliente"]);
                        $queryUpdate->bindParam(":ultimo_intento",$ultimo_intento);
                        $queryUpdate->bindParam(":id_agente",$id_agente);
                        $queryUpdate->execute();
                    }
                    //COMMIT  TRANSACCIÓN
                    $this->conn->commit();
                    //RETORNAMOS LOS DATOS DEL CLIENTE EN FORMATO JSON
                    return json_encode($this->utf8_converter($clienteActual));
           }
           else{
               $this->enviarError("NO SE HA INICIADO SESIÓN");
           }
      }
        //HA OCURRIDO ALGUNA EXCEPCIÓN DURANTE EL PROCESO DE SELECCIÓN
        catch(PDOException $ex){
            $this->conn->rollBack();
            die($ex->getMessage());
        }
        
   }
    /*
        MÉTODO PARA GUARDAR LA LLAMADA QUE HA HECHO UN AGENTE!
    */
    public function guardarRestoLlamada($data){
          
     try{ 
             
            $fin=CustomHelpers::getCurrentFecha();          
            $query=$this->conn->prepare(
             "call sp_todito(
            :id_agente,
            :id_cliente_encuesta,
             :inicio,
             :fin,
             :id_tipo_llamada,
             :notas,
             :id_status_llamada,
             :id_contacto,
             :interlocutor_nombre,
             :interlocutor_paterno,
             :interlocutor_materno,
             :id_motivo_no_contacto,
             :id_enterado,
             :tipo_interesaria,
             :agendar_cita,
             :id_medio_entero,         
             :tipo_objecion,
             :plazo,
             :monto, 
             :Sucursal,
             :Ejecutivo,
             :problematica,
             :pago_mensual,
             :nombre_prospecto,
             :telefono_prospecto,
             :email_prospecto,
             :calificacion,
             :recomendaria_producto,
             :credito_otra_financiera,
             :tomaria_otra_financiera,
             :correo_electronico,
             :entidad_financiera
             )"); 
            $inicio=CustomHelpers::getCurrentFecha();
            $query->bindParam(":id_agente",$data->id_agente);
            $query->bindParam(":id_cliente_encuesta",$data->id_cliente);
            $query->bindParam(":inicio",$inicio);
            $query->bindParam(":fin",$fin);
            $query->bindParam(":id_tipo_llamada",$data->id_tipo_llamada);
            $query->bindParam(":notas",$data->notas);
            $query->bindParam(":id_status_llamada",$data->id_status_llamada);
            $query->bindParam(":id_contacto",$data->contacto);
            $query->bindValue(":interlocutor_nombre",(isset($data->interlocutor_nombre)?$data->interlocutor_nombre:null),PDO::PARAM_STR);
            $query->bindValue(":interlocutor_paterno",(isset($data->interlocutor_paterno)?$data->interlocutor_paterno:null),PDO::PARAM_STR);
            $query->bindValue(":interlocutor_materno",(isset($data->interlocutor_materno)?$data->interlocutor_materno:null),PDO::PARAM_STR);
            $query->bindValue(":id_motivo_no_contacto",(isset($data->id_motivo_no_contacto)?$data->id_motivo_no_contacto:"8"),PDO::PARAM_INT);
            $query->bindValue(":id_enterado",(isset($data->id_enterado)?$data->id_enterado:"0"),PDO::PARAM_INT);
            $query->bindValue(":tipo_interesaria",(isset($data->tipo)?$data->tipo:NULL),PDO::PARAM_INT);
            $query->bindValue(":agendar_cita",(isset($data->agendar_cita)?$data->agendar_cita:"0000-00-00 00:00:00"));
            $query->bindValue(":id_medio_entero",isset($data->id_medio_entero)?$data->id_medio_entero:"0");
            $query->bindValue(":tipo_objecion", isset($data->manejo_objecion)?$data->manejo_objecion:"0");
            $query->bindValue(":plazo",isset($data->plazo)?$data->plazo:"0.0");
            $query->bindValue(":monto",isset($data->monto)?$data->monto:"0.0");
            $query->bindValue(":Sucursal", isset($data->sucursal)?$data->sucursal:" ");
            $query->bindValue(":Ejecutivo", isset($data->ejecutivo)?$data->ejecutivo:"");
            $query->bindValue(":problematica", isset($data->problematica)?$data->problematica:" ");
            $query->bindValue(":pago_mensual", isset($data->pago_mensual)?$data->pago_mensual:"0");
            $query->bindValue(":nombre_prospecto", isset($data->nombre_prospecto)?$data->nombre_prospecto:" ");
            $query->bindValue(":telefono_prospecto", isset($data->telefono_prospecto)?$data->telefono_prospecto:"0");
             $query->bindValue(":email_prospecto", isset($data->email_prospecto)?$data->email_prospecto:" ");
            $query->bindValue(":calificacion",  isset($data->calificacion)?$data->calificacion:null,  PDO::PARAM_INT);                                              
            $query->bindValue(":recomendaria_producto",isset($data->recomendaria_producto)?$data->recomendaria_producto:"0");
            $query->bindValue(":credito_otra_financiera",isset($data->credito_otra_financiera)?$data->credito_otra_financiera:"0");
            $query->bindValue(":tomaria_otra_financiera",isset($data->tomaria_otra_financiera)?$data->tomaria_otra_financiera:"0");
            $query->bindValue(":correo_electronico", isset($data->correo_electronico)?$data->correo_electronico:" ");
            $query->bindValue(":entidad_financiera", isset($data->entidad_financiera)?$data->entidad_financiera:" ");
            $query->execute();
            
            if(isset($data->agendar_cita))
            {
               //PHP V 5.6 PUEDE ACEPTAR PARAMETROS EN GENERAL
               $this->php->emailEncuesta($data->id_cliente, $data->agendar_cita,$data->id_tipo_llamada);
            }
            
            echo 'OK';
     }
     catch(PDOException $ex){
         $this->enviarError($ex->getMessage());
     }
     
           
       
    }/*
    public  function guardarMotivoNoContactado($data){
       
       try{
           
            $fin=CustomHelpers::getCurrentFecha();          
            $query=$this->conn->prepare(
             "call sp_motivoNoContactado(
             :id_agente,
             :id_cliente_encuesta,
             :inicio,
             :fin,
             :id_tipo_llamada,
             :notas,
             :id_status_llamada,
             :id_contacto,
             :interlocutor_nombre,
             :interlocutor_paterno,
             :interlocutor_materno,
             :id_motivo_no_contacto)"); 
            $query->bindParam(":id_agente",$data->id_agente);
            $query->bindParam(":id_cliente_encuesta",$data->id_cliente);
            $query->bindParam(":inicio",$_COOKIE['inicio']);
            $query->bindParam(":fin",$fin);
            $query->bindParam(":id_tipo_llamada",$data->id_tipo_llamada);
            $query->bindParam(":notas",$data->notas);
            $query->bindParam(":id_status_llamada",$data->id_status_llamada);
            
            $query->bindParam(":id_contacto",$data->contacto);
            $query->bindValue(":interlocutor_nombre",isset($data->interlocutor_nombre)?$data->interlocutor_nombre:" ");
            $query->bindValue(":interlocutor_paterno",isset($data->interlocutor_paterno)?$data->interlocutor_paterno:" ");
            $query->bindValue(":interlocutor_materno",isset($data->interlocutor_materno)?$data->interlocutor_materno:" ");
            $query->bindValue(":id_motivo_no_contacto",isset($data->id_motivo_no_contacto)?$data->id_motivo_no_contacto:"7");
            $query->execute();
            echo 'OK';
           
       } catch (Exception $ex) 
       {
             $this->enviarError($ex->getMessage());
       }
      
   }*/
    //LE INTERESA EL CRÉDITO 
    /*public function  guardarInteresCredito($data){
             
       try{

            $fin=CustomHelpers::getCurrentFecha();          
            $query=$this->conn->prepare(
             "call sp_guardar_detalle_encuesta(
             :id_agente,
             :id_cliente_encuesta,
             :inicio,
             :fin,
             :id_tipo_llamada,
             :notas,
             :id_status_llamada,
             :id_contacto,
             :interlocutor_nombre,
             :interlocutor_paterno,
             :interlocutor_materno,
             :id_motivo_no_contacto,
             :id_enterado,
             :tipo_interesaria,
             :agendar_cita,
             :id_medio_entero)"); 
            $query->bindParam(":id_agente",$data->id_agente);
            $query->bindParam(":id_cliente_encuesta",$data->id_cliente);
            $query->bindParam(":inicio",$_COOKIE['inicio']);
            $query->bindParam(":fin",$fin);
            $query->bindParam(":id_tipo_llamada",$data->id_tipo_llamada);
            $query->bindParam(":notas",$data->notas);
            $query->bindParam(":id_status_llamada",$data->id_status_llamada);
            
            $query->bindParam(":id_contacto",$data->contacto);
            $query->bindValue(":interlocutor_nombre",isset($data->interlocutor_nombre)?$data->interlocutor_nombre:" ");
            $query->bindValue(":interlocutor_paterno",isset($data->interlocutor_paterno)?$data->interlocutor_paterno:" ");
            $query->bindValue(":interlocutor_materno",isset($data->interlocutor_materno)?$data->interlocutor_materno:" ");
            $query->bindValue(":id_motivo_no_contacto",isset($data->id_motivo_no_contacto)?$data->id_motivo_no_contacto:"7");
            
            $query->bindParam(":id_enterado",isset($data->id_medio_entero)?$data->id_medio_entero:"0");
            $query->bindParam(":tipo_interesaria",  isset($data->tipo)?$data->tipo:"0");
            $query->bindParam(":agendar_cita", isset($data->agendar_cita)?$data->agendar_cita:"0");
            $query->bindParam(":id_medio_entero",  isset($data->id_medio_entero)?$data->id_medio_entero:"0");
            $query->execute();
            echo 'OK';
           
       } catch (Exception $ex) 
       {
             $this->enviarError($ex->getMessage());
       }
     }*/
    public  function guardarLlamada(){
     
    }
    public  function enviarCitaEmail(){
        
    }
}
