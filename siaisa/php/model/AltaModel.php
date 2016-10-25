<?php
/**
 * Alta de usuarios model
 *
 * @author CESAR LARIOS 27/07/2016
 * @author OSCAR PÉREZ  28/07/2016 (MODIFICACIÓN EN VALIDACIÓN CONTRASEÑAS DESDE AJAX)
 */
include_once(__DIR__ . '/Conexion.php');
class AltaModel {
    private $conn;
    public  function __construct() {
            $conexion=new Conexion();
            $this->conn=$conexion->getConexion();
     }
     
     public function agregarAgente($nombre_agente,$nombre_usuario,$psw,$nivel){
      try{
            $consulta = $this->conn->prepare("INSERT INTO `agente`  (`usuario` ,`password` ,`nombre_completo`, `nivel_acceso`) VALUES(:nombre_usuario,:password_confirm,:nombre_agente,:nivel_acceso)");
            $consulta->bindParam(':nombre_usuario', $nombre_usuario);      
            $consulta->bindParam(':nombre_agente', $nombre_agente);
            $consulta->bindParam(':password_confirm', $psw);
            $consulta->bindParam(':nivel_acceso',$nivel);
            $consulta->execute();
            echo 'Agente registrado correctamente!';
        }
        catch (PDOException $ex){
              //USUARIO DUPLICADO
              if((int)$ex->getCode()===23000){
                  echo 'El nombre de este usuario ya existe';
              }
              else{
                  echo $ex->getMessage();
              }
        }
     }
}
