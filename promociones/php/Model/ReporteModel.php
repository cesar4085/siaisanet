<?php
include_once(__DIR__ . '/Conexion.php');
class ReporteModel {    
    private $conn;
    public function __construct() {
        $conexion=new Conexion();
        $this->conn=$conexion->getConexion();
    }
    
    
    
    public function getProductividad(){
        $sp=$this->conn->prepare("call sistem80_precalificacion.info_citas_agente();");
        $sp->execute();
        $res=$sp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res);
    }
    public function getProdutividadByDate($inicio,$fin){
        $sp=$this->conn->prepare("call sistem80_precalificacion.info_citas_agente_date(:inicio,:fin);");
        $sp->bindParam(":inicio",$inicio);
        $sp->bindParam(":fin",$fin);
        $sp->execute();
        $res=$sp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res);
    }
    public function getInfoGeneralProspecto(){
        $sp=$this->conn->prepare("call sistem80_precalificacion.info_general();");
        $sp->execute();
        $res=$sp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res[0]);
    }
     public  function segmentosDisponibles(){
        $query=$this->conn->prepare("SELECT DISTINCT id_segmento FROM candidato ORDER BY id_segmento ASC");
        $query->execute();
        return json_encode($query->fetchAll(PDO::FETCH_OBJ));
    }
    public  function getInfoGeneralById($id_segmento){
        $sp=$this->conn->prepare("call sp_infoBySegmento(:id)");
        $sp->bindValue(":id", trim($id_segmento),  PDO::PARAM_INT);
        $sp->execute();
        $res=$sp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res[0]);
    }
    public function  getInfoGeneral($id_segmento){
        $sp=$this->conn->prepare("call sp_informacion(:id)");
        $sp->bindValue(":id", trim($id_segmento),  PDO::PARAM_INT);
        $sp->execute();
        $res=$sp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res[0]);
    }
    public  function getGrafica(){
        $sp=$this->conn->prepare("call sp_grafica()");
        $sp->execute();
        $res=$sp->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res[0]);
    }
    public  function getInteresados(){
       $nombre="interesados.csv";
       $sql="SELECT interesado.folio,interesado.nombre,interesado.email,interesado.movil,interesado.opcional,interesado.consentimiento FROM interesado where id_segmento = 2;";
       $encabezados=['FOLIO','NOMBRE','MAIL','MOVIL','OPCIONAL','CONSENTIMIENTO'];
       $this->reporteBase($nombre, $sql, $encabezados);
    }
    public  function getInvalidos(){
        $nombre="invalidos.csv";
        $sql="SELECT folio,nombre, email FROM candidato where valido=0;";
        $encabezados=['FOLIO','NOMBRE','EMAIL'];
        $this->reporteBase($nombre, $sql, $encabezados);
    }
    public  function getReporteGeneral($id_segmento){
        $nombre="ReporteGeneral.csv";
        $sql="SELECT nombre,folio,email,enviado,valido,eliminado,spam,desuscrito,abierto,interesados,no_interesado FROM sistem80_emailing.REPORTE_GENERAL WHERE id_segmento=".$id_segmento;
        $encabezados=['nombre','folio','email','enviado','valido','eliminado','spam','desuscrito','abierto','interesado','No me interesa'];
        $this->reporteBase($nombre, $sql, $encabezados);
    }
    public function getNoMeInteresa(){
        $nombre= "no_MeInteresa.csv";
        $sql= "SELECT folio,nombre,email FROM sistem80_emailing.no_me_interesa;";
        $encabezados=['FOLIO','NOMBRE','EMAIL'];
        $this->reporteBase($nombre, $sql, $encabezados);
        
    }
    
    public function getAtendidos(){
        $this->reporteBase('Atendidos.csv',"SELECT* FROM atendido_detalle",['FOLIO','NOMBRE','EMAIL','MENSAJE','FECHA ENVIO','ATENDIDO POR','STATUS']);
    }
    public function  getGeneralPre(){
          $this->reporteBase('general.csv',"SELECT * FROM sistem80_precalificacion.reporte_general_precalificados",['NOMBRE','FOLIO','CANAL','CARGA','SUCURSAL','INTENTOS','INICIO','MARCADO A','STATUS LLAMADA','CONTACTO','MOTIVO NO CONTACTO','TIPO INTERES','NO INTERESADO','FECHA CITA']);
    }

    public function getCitas(){
        $this->reporteBase('citas.csv',"SELECT * FROM sistem80_precalificacion.cliente_citas",['NOMBRE','FOLIO','BC','CANAL','SUCURSAL','FECHA CITA']);
    }
    
    public  function getAtendidosTabla(){
        $query=$this->conn->prepare("SELECT atendido_por, COUNT(*) as total,  MAX(fecha_envio) as ultimo_envio FROM atendido_detalle group by atendido_por");
        $query->execute();
        $res=$query->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($res);
    }
    public function  getMonitoreoAndCitas(){
       $query=$this->conn->prepare("SELECT*FROM usuario");
       $query->execute();
       $resAgentes=$query->fetchAll(PDO::FETCH_ASSOC);
       $arrayMonitoreo=array();
       foreach($resAgentes as $agente){
          $agentesMonitoreo=array();  
          $monitoreo=$this->callMonitoreoCitaStore($agente["id_usuario"]);
          $agentesMonitoreo['id_agente']=$agente['id_usuario'];
          $agentesMonitoreo['nombre_completo']=  utf8_encode($agente['nombre_completo']);
          $agentesMonitoreo['contactos']=$monitoreo['contactos'];
          $agentesMonitoreo['llamadas']=$monitoreo['llamadas'];
          $agentesMonitoreo['citas']=$monitoreo['citas'];
          array_push($arrayMonitoreo,$agentesMonitoreo);
         
       }
       return json_encode($arrayMonitoreo);
     }
      public function callMonitoreoCitaStore($id_agente){
       $query=$this->conn->prepare("call sistem80_precalificacion.info_agent(:id_agente)");
       $query->bindParam(":id_agente",$id_agente);
       $query->execute(); 
       $res=$query->fetchAll(PDO::FETCH_ASSOC);
       return $res[0];
   }
    private function reporteBase($nombre,$sql, $encabezados){
        $query=$this->conn->prepare($sql);
        $query->execute();
        $fp = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$nombre.'"');
        fputcsv($fp, $encabezados);
       while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
    }
    /*SMS*/
    public  function getLayoutInfo(){
        $instancia = new Conexion();
        $conn=$instancia->getConexionSMS();
        $query=$conn->prepare("SELECT * FROM promoc23_SMS.info_layouts");
        $query->execute();   
        echo json_encode($query->fetchAll(PDO::FETCH_OBJ));
    }
    
    public function getReporteSms($producto,$tipo){
        $instancia = new Conexion();
        $conn=$instancia->getConexionSMS();
        $archivo='';
        $sql='';
        if($tipo==2){
         $encabezado=array("TELEFONO","MENSAJE","FECHA","TIPO_RESPUESTA");
         $sql="call promoc23_SMS.reporte_respuestas_por_producto(:producto);";
         $archivo="reporte-respuesta.csv";
        }
        else{
            $encabezado=array("PRODUCTO","CUENTA","TELEFONO","MENSAJE","RESULTADO","FECHA ENVIO","TIPO");
            $sql="call promoc23_SMS.reporte_envios_por_producto(:producto);";
            $archivo="reporte-envio.csv";
        }
        $query=$conn->prepare($sql);
        $query->bindParam(":producto",$producto);
        $query->execute();
        $fp = fopen('php://output', 'w');
        header('Content-Type: text/csv');
       
        header('Content-Disposition: attachment; filename='.$archivo);
        fputcsv($fp,$encabezado);
       while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
    }
}
