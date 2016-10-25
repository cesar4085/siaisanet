<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginPage
 *
 * @author Victor Ortiz
 */
include_once(__DIR__ . '/Conexion.php');


class LoginModel {
     private $conn;

      public  function __construct() {
            $conexion=new Conexion();
            $this->conn=$conexion->getConexion();
     }
    public function redirect($url)
    {
        header("Location: $url");
    }

     public function iniciarLogin($uname,$upass)
     {
       try
       {
          $stmt = $this->conn->prepare("SELECT * FROM agente WHERE usuario=:uname  LIMIT 1");
          $stmt->execute(array(':uname'=>$uname));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             $hash = password_hash($upass, PASSWORD_DEFAULT);
             if(password_verify($userRow['password'],$hash))
             {
               session_start();
               $_SESSION['id_agente'] = $userRow['id_agente'];
               $_SESSION['usuario']=$userRow['usuario'];
               $_SESSION['nombre_completo']=$userRow['nombre'];
               $_SESSION['nivel_acceso']=$userRow['nivel_acceso'];
               return true;
             }
             else
             {
                return false;
             }
          }
          else {
           return false;
          }
       }
       
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
}
