<?php

/**
 * Description of MonitoreoModel
 *
 * @author OSCAR PEREZ 02/08/2016
 */
include_once(__DIR__ . '/Conexion.php');
class MonitoreoModel {
     
   private $conn;
    public  function __construct() {
            $conexion=new Conexion();
            $this->conn=$conexion->getConexion();
     }
   
     public function  getMonitoreoAndCitas(){
       $query=$this->conn->prepare("SELECT*FROM agente");
       $query->execute();
       $resAgentes=$query->fetchAll(PDO::FETCH_ASSOC);
       $arrayMonitoreo=array();
       foreach($resAgentes as $agente){
         if($agente['nivel_acceso']!=3){
          $agentesMonitoreo=array();  
          $monitoreo=$this->callMonitoreoCitaStore($agente["id_agente"]);
          $agentesMonitoreo['id_agente']=$agente['id_agente'];
          $agentesMonitoreo['nombre']=  utf8_encode($agente['nombre']);
          $agentesMonitoreo['contactados']=$monitoreo['_contactados'];
          $agentesMonitoreo['total_contactados']=$monitoreo['_total_contactados'];
          $agentesMonitoreo['citas']=$monitoreo['_citas'];
          array_push($arrayMonitoreo,$agentesMonitoreo);
         }
       }
       return json_encode($arrayMonitoreo);
     }
     
     public function getMonitoreoByDate($fecha_inicio,$fecha_fin){
         
       $query=$this->conn->prepare("SELECT*FROM agente");
       $query->execute();
       $resAgentes=$query->fetchAll(PDO::FETCH_ASSOC);
       $arrayMonitoreo=array();
       foreach($resAgentes as $agente){
          if($agente['nivel_acceso']!=3){
          $agentesMonitoreo=array();  
          $monitoreo=$this->callMonitoreoStoreByDate($agente["id_agente"],$fecha_inicio,$fecha_fin);
          $agentesMonitoreo['id_agente']=$agente['id_agente'];
          $agentesMonitoreo['nombre']=  utf8_encode($agente['nombre']);
          $agentesMonitoreo['contactados']=$monitoreo['_contactados'];
          $agentesMonitoreo['total_contactados']=$monitoreo['_total_contactados'];
          $agentesMonitoreo['citas']=$monitoreo['_citas'];
          array_push($arrayMonitoreo,$agentesMonitoreo);
          }
       }
       return json_encode($arrayMonitoreo);
       
     }
     
    //_total_contactados  _contactados
      public function getMonitoreo($toJson){
        
       $query=$this->conn->prepare("SELECT*FROM agente");
       $query->execute();
       $resAgentes=$query->fetchAll(PDO::FETCH_ASSOC);
    
       $arrayMonitoreo=array();
       foreach($resAgentes as $agente){
         if($agente['nivel_acceso']!=3){
          $agentesMonitoreo=array();  
          $monitoreo=$this->callMonitoreoStore($agente["id_agente"]);
          $agentesMonitoreo['id_agente']=$agente['id_agente'];
          $agentesMonitoreo['nombre']=  utf8_encode($agente['nombre']);
          $agentesMonitoreo['contactados']=$monitoreo['_contactados'];
          $agentesMonitoreo['total_contactados']=$monitoreo['_total_contactados'];
          array_push($arrayMonitoreo,$agentesMonitoreo);
         }
       }
      return $toJson==true? json_encode($arrayMonitoreo): $arrayMonitoreo;
      
       
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
  
    //OBTIENE ESTADO GENERAL DE LA BD
    //CONTACTOS, LLAMADAS, CITAS EN TOTAL
    public  function getInformacionGeneral(){
        $query=$this->conn->prepare("call sp_encuesta_informacion_general()");
        $query->execute();
        $res=$query->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res[0]);
    }
    
    public  function getReporteCitas(){
        
         $query=$this->conn->prepare("SELECT * FROM reporte_citas;");
           $query->execute();
           // Output array into CSV file
           $filename="reporte-citas.csv";
           $fp = fopen('php://output', 'w');
           $encabezados=["CUENTA","CLIENTE","NO LLAMADA","AGENTE","CITA"];
           header('Content-Type: text/csv');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           fputcsv($fp, $encabezados);
           while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
        
       
    }


    public function callMonitoreoStore($id_agente){
        
       $query=$this->conn->prepare("call sp_encuesta_llamadas_filtro_agente_now_to_curtime(:id_agente)");
       $query->bindParam(":id_agente",$id_agente);
       $query->execute(); 
       $res=$query->fetchAll(PDO::FETCH_ASSOC);
       return $res[0];
    }
    public function callMonitoreoStoreByDate($id_agente,$fecha_inicio,$fecha_fin){
            $query=$this->conn->prepare("call sp_encuesta_llamadas_filtro_agente_by_date(:id_agente,:fecha_inicio,:fecha_fin)");
            $query->bindParam(":id_agente",$id_agente);
            $query->bindParam(":fecha_inicio",$fecha_inicio);
            $query->bindParam(":fecha_fin",$fecha_fin);
            $query->execute(); 
            $res=$query->fetchAll(PDO::FETCH_ASSOC);
            return $res[0];  
       
   }
   public function callMonitoreoCitaStore($id_agente){
       $query=$this->conn->prepare("call sp_encuesta_filtro_contactacion(:id_agente)");
       $query->bindParam(":id_agente",$id_agente);
       $query->execute(); 
       $res=$query->fetchAll(PDO::FETCH_ASSOC);
       return $res[0];
   }
   
      public  function getContactacion(){
       $id_agente;
       session_start();
       if(isset($_SESSION['id_agente']))
       {
            $id_agente=$_SESSION['id_agente'];
     
            $query=$this->conn->prepare("call sp_encuesta_llamadas_filtro_agente_now_to_curtime(:id_agente)");

            $query->bindParam(":id_agente",$id_agente);

            $query->execute(); 

            $res=$query->fetchAll(PDO::FETCH_ASSOC);

            return json_encode($res);
         }
     }
     
         
}
