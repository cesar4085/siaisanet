<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of enviarEmailFinanciera
 *
 * @author OSCARITO
 */
include_once(__DIR__ . '/Conexion.php');
class EmailFinanciera {
   private $conn;
   public function __construct() {
       $conexion=new Conexion();
       $this->conn=$conexion->getConexion();
   }

   public  function email($id_cliente,$fecha_cita,$tipo_llamada=1,$to){
        
                $querySelect=$this->conn->query("SELECT cliente_encuesta.*, credito_encuesta.periodicidad,credito_encuesta.plazo,credito_encuesta.monto_adicional,credito_encuesta.monto_autorizado,credito_encuesta.pago FROM cliente_encuesta INNER JOIN credito_encuesta ON cliente_encuesta.id_cliente=credito_encuesta.id_cliente WHERE cliente_encuesta.id_cliente=".$id_cliente);
                $cliente=$querySelect->fetch();
                $mensaje='<div style="background-color:#262368;padding:5px 12px;"><table cellspacing="0" border="0"><tbody><tr><td><img src="http://sistema-siaisa.net/img/logo-siaisa.png" style="width:32px;"></td><td><span style="font-family:sans-serif;color:white;font-size:18px;">SIAISA</span></td></tr></tbody></table></div>';
                $mensaje.="<i>NO CUENTA:</i><strong>".$cliente["no_contrato"]."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>NOMBRE:</i><strong>".$cliente["nombre"]."</strong>";
                $mensaje.="<br>";
                if($tipo_llamada==1){
                $mensaje.="<i>TELEFONO FIJO:</i><strong>".$cliente["telefono_fijo"]."</strong>";
                $mensaje.="<br>";
                }else{
                $mensaje.="<i>TELEFONO MOVIL:</i><strong>".$cliente["telefono_movil"]."</strong>";
                $mensaje.="<br>";
                }
                $mensaje.="<i>FECHA CITA:</i><strong>".$fecha_cita."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>MONTO AUTORIZADO<i/><strong>$".sprintf('%01.2f',$cliente["monto_autorizado"])."</strong>";
                $mensaje.="<br>";
                $mensaje.="<i>MONTO ADICIONAL</i> <strong>$". sprintf('%01.2f',$cliente["monto_adicional"])."</strong>";
                $headers.="From:notificaciones@sistema-siaisa.net\r\n";
                $headers.="MIME-Version: 1.0\r\n";
                $headers.="Content-Type: text/html; charset=UTF-8\r\n";
                mail("m.orozco@siaisa.com.mx,oemy93@hotmail.com,cesar4085@live.com.mx,daniel.diaz.1@bbva.com,f.grego@bbva.com,tanyapamela.cantu@bbva.com","NOTIFICACIONES SIAISA CITA",$mensaje,$headers);
    }
}
