
<?php
include_once(__DIR__ . '/Conexion.php');
class chatstd{
	private $conn;
    public  function __construct() {
            $conexion=new Conexion();
            $this->conn=$conexion->getConexionPromo();
     }
 public function getInfoChat(){
 	$consulta=$this->conn->prepare("call promoc23_chat.info_chat_hoy()");
        $consulta->execute();
        $info=$consulta->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($info[0]);
}
}