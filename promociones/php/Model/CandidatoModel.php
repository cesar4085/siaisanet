<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CandidatoModel
 *
 * @author Victor Ortiz
 */
include_once(__DIR__ . '/Conexion.php');
class CandidatoModel {
    private $con;
    public function __construct() {
        $conexion=new Conexion();
        $this->con=$conexion->getConexion();
    }



    //METÓDO QUE OBTIENE LA INFORMACIÓN DEL CANDIDATO
    public function getInfoByGuid($guid){
            
       $conexion=new Conexion();
       $con=$conexion->getConexion();
       $query=$con->prepare("SELECT*FROM candidato WHERE guid=:guid");
       $query->bindParam(":guid",$guid);
       $query->execute();
       return  $query->fetchAll();
    }
  
    public function  getEmailBySegmento($id_segmento){
           $conexion=new Conexion();
           $con=$conexion->getConexion();
           $query=$con->prepare("SELECT id_candidato, email FROM candidato WHERE id_segmento=:id_segmento and valido=1");
           $query->bindParam(":id_segmento",$id_segmento);
           $query->execute();
           return  $query->fetchAll();
    }

    
    public  function marcarInvalido($id_candidato){
          $conexion=new Conexion();
           $con=$conexion->getConexion();
           $query=$con->prepare("UPDATE candidato SET valido=0 WHERE id_candidato=:id_candidato");
           $query->bindParam(":id_candidato",$id_candidato);
           $query->execute();   
    }
    public function marcarComoInvalidoByEmail($email){
           $query=$this->con->prepare("UPDATE candidato SET valido=0 WHERE email=:email and id_candidato>0");
           $query->bindParam(":email",$email);
           $query->execute();   
    }

    //OBTIENE CANDIDATO POR EL ID
    public  function getInfoById($id){
       
       $conexion=new Conexion();
       $con=$conexion->getConexion();
       $query=$con->prepare("SELECT candidato.id_candidato, candidato.nombre,candidato.guid,candidato.email,candidato.folio,candidato.id_segmento,credito_candidato.oferta,credito_candidato.oferta_letra,
credito_candidato.cat,credito_candidato.tasa_fija,credito_candidato.tasa_letra,credito_candidato.comision,credito_candidato.comision_letra,
credito_candidato.plazo,credito_candidato.pago FROM candidato INNER JOIN credito_candidato ON candidato.id_candidato=credito_candidato.id_candidato WHERE candidato.id_candidato=:id_cliente");
       $query->bindParam(":id_cliente",$id);
       $query->execute();
       return  $query->fetchAll();

    }

    public  function getClienteBySegmento($id_segmento){
            @ini_set('memory_limit', '-1');
            $query=$this->con->prepare("SELECT* FROM  no_enviados WHERE id_segmento=:id_segmento");
            $query->bindParam(":id_segmento",$id_segmento);
            $query->execute();
            return  $query->fetchAll();
    }


    public function  agregarStatusEmail($id_mail, $id_candidato){
     
        $conexion = new Conexion();
        $con=$conexion->getConexion();
        $query=$con->prepare("INSERT INTO status_mail(id_mail,id_candidato) VALUES(:id_mail,:id_candidato)");
        $query->bindParam(":id_mail",$id_mail);
        $query->bindParam(":id_candidato",$id_candidato);
        $query->execute();
        
        return true;
        
    }
    
   
    


    //MÉTODO QUE GUARDA INFORMACIÓN DEL CANDIDATO CUANDO PROCESO SU SOLICITUD
 

    public function setProcesoSolicitud($tel_movil,$tel_opcional,$id_candidato,$cons){
       try{
            $conexion=new Conexion();
            $con=$conexion->getConexion();
            $query=$con->prepare("INSERT INTO candidato_proceso(tel_movil,tel_opcional,consentimiento,id_candidato) VALUES(:tel_movil,:tel_opcional,:cons,:id_candidato)");
            $query->bindParam(":tel_movil",$tel_movil);
            $query->bindParam(":cons",$cons);
            $query->bindParam(":tel_opcional",$tel_opcional);
            $query->bindParam(":id_candidato",$id_candidato);
            $query->execute();
            unset($_POST);
       } catch (Exception $ex) {
            echo $ex->getMessage();
       }
  
       
    }
    
}
