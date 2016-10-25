<?php
include_once(__DIR__ . '/Conexion.php'); 
include_once(__DIR__ . '/CustomHelpers.php'); 
class CobranzaModel {
   private $conn;
   public  function __construct() {
        $conexion=new Conexion();
        $this->conn=$conexion->getConexion();
    }
    /*
      MÉTODO QUE OBTIENE CONTACTACIÓN DEL AGENTE
      SE MUESTRA EN LA GRAFICA DE CONTACTACIÓN
    */
   public  function getContactacion(){
       $id_agente;
       session_start();
       if(isset($_SESSION['id_agente']))
       {
            $id_agente=$_SESSION['id_agente'];
     
            $query=$this->conn->prepare("call evnsmx_cobra.sp_llamadas_filtro_agente_now_to_curtime(?)");

            $query->bindParam(1,$id_agente,PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 4000);

            $query->execute(); 

            $res=$query->fetchAll(PDO::FETCH_ASSOC);

            return json_encode($res);
       }
    }    
    /*
        OBTIENE INFORMACIÓN SOBRE EL HISTORIAL DE LLAMADAS DE UN CLIENTE
        @PARAM $ID_CLIENTE-> CLIENTE A QUIEN SE LE ESTÁ HACIENDO LA LLAMADA AHORA MISMO
    */
   public function getBitacora($id_cliente){        
      try{
           $query=$this->conn->prepare("SELECT*FROM historial WHERE id_cliente=:id_cliente");
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
            }
       
           //SELECIONAMOS UN NUEVO CLIENTE DE LA BD CON STATUS EN_LINEA=0 
            $this->conn->beginTransaction();
            $querySelect=$this->conn->query("SELECT*FROM cliente WHERE  en_linea=0 AND DATE(ultimo_intento)<>CURDATE() OR DATE(ultimo_intento)=NULL  ORDER BY id_cliente ASC LIMIT 1 FOR UPDATE ");
            $clienteActual=$querySelect->fetch();
            //NO HAY MÁS CLIENTES DISPONIBLES EN LA BD
            if(empty($clienteActual)){
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                die("No hay más clientes");
            }
            //HAY CLIENTES DISPONIBLES 
            else{
                $ultimo_intento=CustomHelpers::getCurrentFecha();
                setcookie("inicio",$ultimo_intento);
                $queryUpdate=$this->conn->prepare("UPDATE cliente SET en_linea=1, en_linea_con=:id_agente, ultimo_intento=:ultimo_intento WHERE id_cliente=:id_cliente");
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
      //HA OCURRIDO ALGUNA EXCEPCIÓN DURANTE EL PROCESO DE SELECCIÓN
      catch(PDOException $ex){
          $this->conn->rollBack();
          die($ex->getMessage());
      }
        
    }
    /*
                    
   /*
        MÉTODO PARA GUARDAR LA LLAMADA QUE HA HECHO UN AGENTE!
    */
   public function guardarInfo($data)
    {
        try{
  
            $motivo_no_contacto=0;
            $status_razon=0;
            
            if(isset($data->id_motivo_no_contacto) || !empty($data->id_motivo_no_contacto)){
                 $motivo_no_contacto= $data->id_motivo_no_contacto;
            }
            
            if(isset($data->id_status_razon) || !empty($data->id_status_razon))
            {
               $status_razon=$data->id_status_razon;
            }
            
            
            $query=$this->conn->prepare("INSERT INTO bitacora(inicio,fin,contacto,id_motivo_no_contacto,id_status_llamada,id_status_razon,id_tipo_llamada,notas,id_agente,id_cliente)
           VALUES(:inicio,:fin,:contacto,:id_motivo_no_contacto,:id_status_llamada,:id_status_razon,:id_tipo_llamada,:notas,:id_agente,:id_cliente)");

            $query->bindParam(":inicio",$_COOKIE['inicio']);
            $query->bindParam(":fin",$data->fin);
            $query->bindParam(":contacto",$data->contacto);
            $query->bindParam(":id_motivo_no_contacto",$motivo_no_contacto);
            $query->bindParam(":id_status_llamada",$data->id_status_llamada);
            $query->bindParam(":id_status_razon",$status_razon);
            $query->bindParam(":id_tipo_llamada",$data->id_tipo_llamada);
            $query->bindParam(":notas",$data->notas);
            $query->bindParam(":id_agente",$data->id_agente);
            $query->bindParam(":id_cliente",$data->id_cliente);
            $query->execute();
                     
            //ACTUALIZAR LA TABLA CLIENTE     
            $queryCliente=$this->conn->prepare("UPDATE cliente SET contactado=:contactado,
            ultimo_intento=:ultimo_intento,fin_ultimo_intento=:fin_ultimo_intento,
            en_linea=:en_linea,en_linea_con=:en_linea_con WHERE id_cliente=:id_cliente");
            
            $queryCliente->bindParam(":contactado",$data->contacto);
            $queryCliente->bindParam(":ultimo_intento",$data->inicio);
            $queryCliente->bindParam(":fin_ultimo_intento",$data->fin);
            $queryCliente->bindValue(":en_linea",0);
            $queryCliente->bindValue(":en_linea_con",0);
            $queryCliente->bindParam(":id_cliente",$data->id_cliente);
            $queryCliente->execute();
            
            foreach ($data->promesas as $promesa){
                
                $queryPromesa=$this->conn->prepare("INSERT INTO promesas(importe,fecha) VALUES (:importe,STR_TO_DATE(:fecha,'%d/%m/%Y'))");
                $queryPromesa->bindParam(":importe",$promesa->importe);
                $queryPromesa->bindParam(":fecha",$promesa->fecha);
                $queryPromesa->execute();

                $last_id=$this->conn->lastInsertId();
                $queryCliente_promesa=$this->conn->prepare("INSERT INTO cliente_promesas(id_cliente,id_promesa)
                VALUES(:id_cliente,:id_promesa)");
                $queryCliente_promesa->bindParam(":id_cliente",$data->id_cliente);
                $queryCliente_promesa->bindValue(":id_promesa",$last_id);
                $queryCliente_promesa->execute();             
                
            }
            unset($_COOKIE['inicio']);
            
            echo 'Información guardad correctamente';
        }
        catch (PDOException $ex){
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                die($ex->getMessage());
        }

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
