<?php
include_once(__DIR__ . '/Conexion.php');
class ReporteModel {
    private $conn;
    public  function __construct() {
            $conexion=new Conexion();
            $this->conn=$conexion->getConexion();
     }
     
        
    public  function getReporteCitas(){
        
           $query=$this->conn->prepare("SELECT * FROM reporte_citas;");
           $query->execute();
           // Output array into CSV file
           $filename="reporte-citas.csv";
           $fp = fopen('php://output', 'w');
           $encabezados=["CUENTA","CLIENTE","NO LLAMADA","AGENTE","CITA"];
           header('Content-Type: text/csv');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           fputcsv($fp, $encabezados);
           while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
          $this->conn=null;
       
    }
    
    public function getReporteFinal(){
         $query=$this->conn->prepare("SELECT  `cuenta`,
 `intentos`,
 `contactado`,
 `contactado 2a parte`,
 `recado`,
 `recado 2a parte`,
 `marcando_a`,
 `status de la llamada`,
 `motivo no contacto`,
 `enterado_propuesta`,
 `medio_entero`,
 `interesado`,
 `manejo de objecion`,
 `cita`,
 `recomendaria_producto`,
 `nombre_prospecto`,
 `telefono_prospecto`,
 `email_prospecto`,
 `calificacion`,
 `correo electronico`,
 `notas`from ((SELECT DISTINCT* FROM PRUEBA_2)
UNION (SELECT DISTINCT * FROM PRUEBA)
UNION (select distinct * FROM  TODOS))as x 
group by cuenta;");
           $query->execute();
           // Output array into CSV file
           $filename="reporte-final.csv";
           $fp = fopen('php://output', 'w');
           $encabezados=["CUENTA","INTENTOS","CONTACTO","CONTACTADO 2A PARTE","RECADO","RECADO 2A PARTE","MARACADO A","STATUS LLAMADA","MOTIVO NO CONTACTO","ENTERADO PROPUESTA",
               "MEDIO ENTERO","INTERESADO","MANEJO OBJECIÓN","AGENDAR CITA","RECOMENDARIA PRODUCTO","NOMBRE PROSPECTO","TELEFONO PROSPECTO","EMAIL","CALIFICACION SERVICIO","EMAIL","NOTAS"];
           header('Content-Type: text/csv');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           fputcsv($fp, $encabezados);
           while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
          $this->conn=null;
    }
    
     public  function getReporteFueraServicio(){
        
           $query=$this->conn->prepare("SELECT * FROM telefonos_malos WHERE status_llamada<>'Invalido' UNION DISTINCT SELECT * FROM encuesta_no_vive_ahi ");
           $query->execute();
           // Output array into CSV file
           $filename="reporte-fuera.csv";
           $fp = fopen('php://output', 'w');
           $encabezados=["CUENTA","CLIENTE","TELEFONO","TIPO","STATUS","AGENTE NOMBRE"];
           header('Content-Type: text/csv');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           fputcsv($fp, $encabezados);
           while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
          $this->conn=null;
       
    }
    
       public  function getReporteInvalidos(){
        
           $query=$this->conn->prepare("SELECT * FROM telefonos_malos WHERE status_llamada='Invalido'");
           $query->execute();
           // Output array into CSV file
           $filename="reporte-invalidos.csv";
           $fp = fopen('php://output', 'w');
           $encabezados=["CUENTA","CLIENTE","TELEFONO","TIPO","STATUS","AGENTE NOMBRE"];
           header('Content-Type: text/csv');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           fputcsv($fp, $encabezados);
           while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
          $this->conn=null;
       
    }
    
         public  function getReporteQuejas(){
        
           $query=$this->conn->prepare("SELECT * FROM encuesta_quejas");
           $query->execute();
           // Output array into CSV file
           $filename="reporte-quejas.csv";
           $fp = fopen('php://output', 'w');
           $encabezados=["CUENTA","CLIENTE","SUCURSAL","EJECUTIVO","PROBLEMATICA"];
           header('Content-Type: text/csv');
           header('Content-Disposition: attachment; filename="'.$filename.'"');
           fputcsv($fp, $encabezados);
           while ($row = $query->fetch(PDO::FETCH_ASSOC)) {   
               
                fputcsv($fp, $row);
           }
           fclose($fp);
          $this->conn=null;
       
    }
    
    public function getCalificacion(){
       return $this->callStore("call sp_encuesta_calificacion()");
    }
    
    public function getNoInteres(){
      return  $this->callStore("call sp_motivo_no_interes()");
       
    }
    
    public function getFinancieras(){
      return  $this->callStore("call sp_financieras()");
    }

    public function callStore($str_store){
        $query=$this->conn->prepare($str_store);
        $query->execute();
        $res=$query->fetchAll(PDO::FETCH_ASSOC);
        $this->conn=null;
        return json_encode($res);
    }
   
}
