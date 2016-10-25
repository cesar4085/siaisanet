<?php
/*¨
    PHP LOGIN CON AJAX Y MATERIAL ANGULAR
    OSCAR PEREZ MARTINEZ 17/09/2016
  */
include_once(__DIR__ . '/Conexion.php');

class LoginModel{
    private  $conn;
    public function __construct() {
        $instancia=new Conexion();
         $this->conn=$instancia->getConexion();
    }
    public function loginFromEncuesta($user_name){
        $instancia=new Conexion();
        $this->conn=$instancia->getConexionEncuesta();
         $stmt = $this->conn->prepare("SELECT * FROM agente WHERE usuario=:uname  LIMIT 1");
         $stmt->execute(array(':uname'=>$user_name));
         $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
         if($stmt->rowCount() > 0)
          {
               if (session_status() == PHP_SESSION_NONE)
                {
                   session_start();  
                }
               $id_usuario=$this->getIdUsuario($user_name);
               $_SESSION['nombre_usuario']=$userRow['nombre'];
               $_SESSION['id_agente'] = $userRow['id_agente'];
               $_SESSION['id_usuario']=$id_usuario;
               $_SESSION['nivel_acceso']=$userRow['nivel_acceso'];
               $_SESSION['ultimo_inicio']=  $this->getCurrentFecha();
               $_SESSION['logged']="encuesta";
               return json_encode($_SESSION);
         }
         
    }
    public function getIdUsuario($user_name){
        $instancia=new Conexion();
        $this->conn=$instancia->getConexion();
        $query=$this->conn->prepare("SELECT*FROM usuario WHERE nombre=:nombre");
        $query->bindParam(":nombre",$user_name);
        $query->execute();
        $usuario=$query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount()>0){
           return $usuario['id_usuario'];
        }
    }
    public function getIdAgente($user_name){
        $instancia = new Conexion();
        $this->conn=$instancia->getConexionEncuesta();
        $stmt = $this->conn->prepare("SELECT * FROM agente WHERE usuario=:uname  LIMIT 1");
        $stmt->execute(array(':uname'=>$user_name));
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0)
         {
           return $userRow['id_agente'];
        }
    }
    public function isValid($nombre,$pass){
        
        $query=$this->conn->prepare("SELECT*FROM usuario WHERE nombre=:nombre");
        $query->bindParam(":nombre",$nombre);
        $query->execute();
        $usuario=$query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount()>0){
            if($usuario['password']==$pass){
                 if (session_status() == PHP_SESSION_NONE)
                {
                   session_start();  
                }
                $id_agente=$this->getIdAgente($nombre);
                $_SESSION['nombre_usuario']=$usuario['nombre_completo'];
                $_SESSION['id_usuario']=$usuario['id_usuario'];
                $_SESSION['id_agente']=$id_agente;
                $_SESSION['ultimo_inicio']=  $this->getCurrentFecha();
                $_SESSION['nivel_accesso']=1;
                $_SESSION["logged"]="precalificados";
            }
            else{
                $this->enviarError('Password Invalida');
            }
        
        }
        else{
            $this->enviarError('El nombre de usuario '. $nombre .' no esta registrado aun');
        }
    }
    
    public  function enviarError($mensaje){
                        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                        die($mensaje);
    }
    
    public static  function getCurrentFecha(){
        date_default_timezone_set('America/Mexico_City');
        return   $date = date('Y-m-d H:i:s');
   }
    
    
    
}