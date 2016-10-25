<?php
header('Access-Control-Allow-Origin: *');
require_once './php/model/ReporteModel.php';
if(!empty($_GET)){
       if(isset($_GET["tipo"])){
           
           switch($_GET["tipo"])
           {
               case "citas":
                    $reporte=new ReporteModel();
                    $reporte->getReporteCitas();
                   break;
               
               case "invalidos":
                   $reporte=new ReporteModel();
                    $reporte->getReporteInvalidos();
                   break;
               case "fuera":
                    $reporte=new ReporteModel();
                    $reporte->getReporteFueraServicio();
                break;
               case "quejas":
                   $reporte=new ReporteModel();
                   $reporte->getReporteQuejas();
                break;
               case "calificacion":
                   $reporte=new ReporteModel();
                   echo $reporte->getCalificacion();
               break;
           
               case "motivo":
                   $reporte=new ReporteModel();
                   echo $reporte->getNoInteres();
                break;
            
               case "financiera":
                   $reporte=new ReporteModel();
                   echo $reporte->getFinancieras();
                   break;
               case "final":
                   $reporte=new ReporteModel();
                   echo $reporte->getReporteFinal();
                   break;
                
           }
       }
}