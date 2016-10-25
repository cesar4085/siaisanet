<?php
class Conexion {
     private $connexion;
     private $host;
     private $dbName;
     private $user;
     private $password;
     
     public  function getConexion(){
       
         try{
                         $this->dbName="evnsmx_cobra";
                         $this->user="evnsmx_sisa";
                         $this->password="53926340";
                         $this->host="evn7s.mx";
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
