<?php
class Conexion {
     private $connexion;
     private $host;
     private $dbName;
     private $user;
     private $password;
     
     public  function getConexion(){
       
         try{
                         $this->dbName="sistem80_siaisa";
                         $this->user="sistem80_sia";
                         $this->password="53689439";
                         $this->host="www.sistema-siaisa.net";
                         $this->connexion= new PDO("mysql:host=".$this->host.";dbname=".$this->dbName,$this->user,$this->password);
                         $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                         return $this->connexion;
             }
             catch(PDOException $ex)
             {
                                echo "error conexion". $ex->getMessage();
                              
             }
     
     
     }
     
     public  function getConexionEmail(){
        $dbName="sistem80_emailing";
        $user="sistem80_siaisa";
        $password="director1210";
        $host="sistema-siaisa.net";
        $conn= new PDO("mysql:host=".$host.";dbname=".$dbName,$user,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $conn;
     }
     
}
