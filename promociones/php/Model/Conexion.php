<?php
class Conexion {
     private $connexion;
     private $host;
     private $dbName;
     private $user;
     private $password;
     public function getConexionSMS(){
          try{
              
                     
                         //CONEXION CON LA BD
                        $this->dbName="promoc23_SMS";
                        $this->user="promoc23_siaisa";
                        $this->password="director1210";
                        $this->host="promocionesfinancieraayudamos.com";
                        $this->connexion= new PDO("mysql:host=".$this->host.";dbname=".$this->dbName,$this->user,$this->password);
                        $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                        return $this->connexion;
             }
             catch(PDOException $ex)
             {
                                echo "error conexion". $ex->getMessage();
 
             }
     }
     public  function getConexionEncuesta(){
       
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
     public  function getConexion(){
       
       try{
                         $this->dbName="sistem80_emailing";
                         $this->user="sistem80_siaisa";
                         $this->password="director1210";
                         $this->host="sistema-siaisa.net";
                         $this->connexion= new PDO("mysql:host=".$this->host.";dbname=".$this->dbName,$this->user,$this->password);
                         $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                         return $this->connexion;
             }
             catch(PDOException $ex)
             {
                                echo "error conexion". $ex->getMessage();
                              
             }
     
     
     
     }
     
}
