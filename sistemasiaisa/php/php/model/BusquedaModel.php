<?php //
/*
    AUTOR CESAR LARIOS 26/07/2016
 */
include_once(__DIR__ . '/Conexion.php');
class BusquedaModel 
{ 
    private $conn;
    
    public  function __construct() {
            $conexion=new Conexion();
            $this->conn=$conexion->getConexion();
     }
   
     
     
   public function inputResults()
   {
          $palabra = isset($_POST['palabra_buscada']) ? $_POST['palabra_buscada']: null;
          $resBusqueda=array();
          if(isset($_POST)){
              if (!empty($palabra)) {
                  if(isset($_POST["search_param"])){

                     if($_POST["search_param"]=="clientes"){
                        return $this->busquedaCore(true,"SELECT*FROM cliente_encuesta WHERE nombre  LIKE CONCAT(:palabra, '%') OR paterno   LIKE CONCAT(:palabra, '%') OR materno LIKE CONCAT(:palabra, '%')",$palabra);
                     }
                     else if ($_POST["search_param"]=="fijo" ) {
                        return $this->busquedaCore(true,"SELECT*FROM cliente_encuesta WHERE telefono_fijo LIKE CONCAT(:palabra, '%')",$palabra);
                     }
                     else if($_POST["search_param"]=="movil"){
                         return $this->busquedaCore(true,"SELECT*FROM cliente_encuesta WHERE telefono_movil LIKE CONCAT(:palabra,'%')",$palabra);
                     }
                     else if($_POST["search_param"]=="num_cuenta"){
                         return $this->busquedaCore(true,"SELECT*FROM cliente_encuesta WHERE no_contrato LIKE CONCAT(:palabra,'%')", $palabra);
                     }
                  }    
             }
         }
    }
    
    public function  showSugerencias(){
        $palabra = isset($_POST['palabra_buscada']) ? $_POST['palabra_buscada']: null;
          $resBusqueda=array();
          if(isset($_POST)){
              if (!empty($palabra)) {
                  if(isset($_POST["search_param"])){

                     if($_POST["search_param"]=="clientes"){
                        return $this->busquedaCore(false,"SELECT*FROM cliente_encuesta WHERE nombre  LIKE CONCAT(:palabra, '%') OR paterno   LIKE CONCAT(:palabra, '%') OR materno LIKE CONCAT(:palabra, '%')",$palabra);
                     }
                     else if ($_POST["search_param"]=="fijo" ) {
                        return $this->busquedaCore(false,"SELECT*FROM cliente_encuesta WHERE telefono_fijo LIKE CONCAT(:palabra, '%')",$palabra);
                     }
                     else if($_POST["search_param"]=="movil"){
                         return $this->busquedaCore(false,"SELECT*FROM cliente_encuesta WHERE telefono_movil LIKE CONCAT(:palabra,'%')",$palabra);
                     }
                      else if($_POST["search_param"]=="num_cuenta"){
                         return $this->busquedaCore(false,"SELECT*FROM cliente_encuesta WHERE no_contrato LIKE CONCAT(:palabra,'%')", $palabra);
                     }
                  }    
           }
    }
  }
   
  
   
   public function buscarCliente($id_cliente){
       $queryBusqueda=$this->conn->prepare("SELECT cliente_encuesta.*, credito_encuesta.periodicidad,credito_encuesta.plazo,credito_encuesta.monto_adicional,credito_encuesta.pago FROM cliente_encuesta INNER JOIN credito_encuesta ON cliente_encuesta.id_cliente=credito_encuesta.id_cliente  WHERE cliente_encuesta.id_cliente=:id_cliente");
       $queryBusqueda->bindParam(":id_cliente",$id_cliente);
       $queryBusqueda->execute();
       $res=$queryBusqueda->fetchAll(PDO::FETCH_ASSOC);
       return $res[0];
   }
   
   public function getBitacora($id_cliente){        
      try{
           $query=$this->conn->prepare("SELECT*FROM encuesta_historial WHERE id_cliente=:id_cliente");
           $query->bindParam(":id_cliente",$id_cliente);
           $query->execute();
           $res=$query->fetchAll(PDO::FETCH_ASSOC);
           return $res;
       }
      catch(PDOException $ex){
         
          die($ex->getMessage());
      }
        
    }
    public function getPromesaReporte($id_cliente){
         try{
           $query=$this->conn->prepare("SELECT*FROM promesa_reporte WHERE id_cliente=:id_cliente");
           $query->bindParam(":id_cliente",$id_cliente);
           $query->execute();
           $res=$query->fetchAll(PDO::FETCH_ASSOC);
           return $res;
       }
      catch(PDOException $ex){
         
          die($ex->getMessage());
      }
    }
 
   private function busquedaCore($tojson,$sql,$param){
        $queryBusqueda=$this->conn->prepare($sql);
        $queryBusqueda->bindParam(":palabra",$param);
        $queryBusqueda->execute();
        $resBusqueda=$queryBusqueda->fetchAll(PDO::FETCH_ASSOC);
        return $tojson==true?json_encode($resBusqueda): $resBusqueda;
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