<?php
include_once(__DIR__ . '/Conexion.php');
class CodigosModel {
 
    private  $conn;
    public function __construct() {
         $conexion=new Conexion();
         $this->conn=$conexion->getConexion();
    }
 
    /*
        Devuelve todos los codigos postales disponibles
    */
    public function getCps(){
        $query=$this->conn->prepare("SELECT DISTINCT cp FROM codigos");
        $query->execute();
        echo json_encode($query->fetchAll(PDO::FETCH_OBJ));
    }
    /*
        Devuelve las delgaciones existentes en la bd 
     */
    public function getDelegaciones(){
        $query=$this->conn->prepare("SELECT DISTINCT delegacion FROM codigos");
        $query->execute();
        $resultados=$query->fetchAll(PDO::FETCH_OBJ);
 
        foreach ($resultados as $res){
           $res->delegacion=utf8_encode($res->delegacion);
        }
        echo json_encode($resultados);
    }
    /*
        Devuelve todas las colonias existentes en la bd
     */
    public function getColonias(){
        $query=$this->conn->prepare("SELECT DISTINCT colonia FROM codigos");
        $query->execute();
        $resultados=$query->fetchAll(PDO::FETCH_OBJ);
        foreach($resultados as $res){
            $res->colonia=  utf8_encode($res->colonia);
        }
        echo json_encode($resultados);
    }
 
    /*
        Devuelve informaciÃ³n como colonia, sucursal, no sucursal 
        @param $cp cÃ³digo postal que ingrese el usuario
    */
    public  function getData($cp){
      try{  
         $query=$this->conn->prepare("SELECT*FROM codigos WHERE  cp=:cp");
         $query->bindParam(":cp",$cp);
         $query->execute();
         $resultados=$query->fetchAll(PDO::FETCH_OBJ);
 
         foreach ($resultados as $res){
             $res->delegacion=  utf8_encode($res->delegacion);
             $res->colonia=  utf8_encode($res->colonia);
             $res->sucursal=  utf8_encode($res->sucursal);
         }
 
         echo json_encode($resultados);  
 
      }
      catch (PDOException $ex){
          echo $ex->getMessage();
      }
    }
 
      public  function getSucursales(){
      try{  
         $query=$this->conn->prepare("SELECT DISTINCT sucursal FROM codigos");
         $query->execute();
         $resultados=$query->fetchAll(PDO::FETCH_OBJ);
         $sucursales=array();
         foreach ($resultados as $res){;
             $res->sucursal=  utf8_encode($res->sucursal);
             array_push($sucursales, $res->sucursal);
         }
 
         echo json_encode($sucursales);  
 
      }
      catch (PDOException $ex){
          echo $ex->getMessage();
      }
    }
 
}