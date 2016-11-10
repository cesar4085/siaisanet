<?php
require_once './php/model/ReporteModel.php';
if(!empty($_GET)){
       if(isset($_GET["tipo"])){
           
           switch($_GET["tipo"])
           {
           	/*ReportesChat*/
               case "ReporteChatGeneral":
                    $reporte=new ReporteModel();
                    $reporte->getReporteChatGeneral();
                   break;

              case "ReporteChatHoy":
                    $reporte=new ReporteModel();
                    $reporte->getReporteChatHoy();
                   break;
             
           }
       }
}