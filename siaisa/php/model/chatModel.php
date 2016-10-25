<?php
/**
 * Alta de usuarios model
 *
 * @author CESAR LARIOS 27/07/2016
 * @author OSCAR PÉREZ  28/07/2016 (MODIFICACIÓN EN VALIDACIÓN CONTRASEÑAS DESDE AJAX)
 */
include_once(__DIR__ . '/Conexion.php');
class ChatModel {
    private $conn;
    public  function __construct() {
            $conexion=new Conexion();
            $this->conn=$conexion->getConexionPromo();
     }
     
     public function agregarChat($nombre_cliente, $folio,$mail, $tel_1, $status,$notas,$agente,$procedencia){
      try{
            $consulta = $this->conn->prepare("INSERT INTO `chatito`  (`nombre_cliente` ,`folio` ,`mail`,`tel_1`, `status`, `notas`,`agente`,`procedencia`) VALUES(:nombre_cliente,:folio,:mail,:tel_1,:status,:notas,:agente,:procedencia)");
            $consulta->bindParam(':nombre_cliente', $nombre_cliente);      
            $consulta->bindParam(':folio', $folio);
            $consulta->bindParam(':mail', $mail);
            $consulta->bindParam(':tel_1', $tel_1);
            $consulta->bindParam(':status',$status);
            $consulta->bindParam(':notas',$notas);
            $consulta->bindParam(':agente',$agente);
            $consulta->bindParam(':procedencia',$procedencia);

            $consulta->execute();
            echo 'chat registrado correctamente!';
        }
        catch (PDOException $ex){
              //chat DUPLICADO
              if((int)$ex->getCode()===23000){
                  echo 'chat malito';
              }
              else{
                  echo $ex->getMessage();
              }
        }
     }
}
