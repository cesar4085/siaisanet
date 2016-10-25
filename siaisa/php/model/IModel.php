<?php
/**
 * Description of IModel
 * CLASE ABSTRACTA PARA MODELOS DE LA BD 
 * @author OSCAR PEREZ MARTINEZ
 */
include_once(__DIR__ . '/EmailFinanciera.php'); 
include_once(__DIR__ . '/Conexion.php'); 
abstract class IModel {
    public $conn;
    public $php;
    public  function __construct() 
    {
        $conexion=new Conexion();
        $this->conn=$conexion->getConexion();
        $this->php=new EmailFinanciera();
       
    }
    /*
      MÉTODO QUE OBTIENE CONTACTACIÓN DEL AGENTE
      SE MUESTRA EN LA GRAFICA DE CONTACTACIÓN
    */
    abstract protected  function getContactacion();
      /*
        OBTIENE INFORMACIÓN SOBRE EL HISTORIAL DE LLAMADAS DE UN CLIENTE
        @PARAM $ID_CLIENTE-> CLIENTE A QUIEN SE LE ESTÁ HACIENDO LA LLAMADA AHORA MISMO
    */
    abstract protected function getBitacora($id_cliente);    
    
    /*
            MÉTODO PARA OBTENER UN NUEVO CLIENTE
            @PARAM ID_AGENTE--> AGENTE ACTUAL CONECTADO
    */
    abstract  protected function getCliente();
    /*
        MÉTODO PARA GUARDAR LA LLAMADA QUE HA HECHO UN AGENTE!
    */
    abstract protected  function guardarLlamada();
    
    public  function enviarError($mensaje){
                        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                        die($mensaje);
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
}
