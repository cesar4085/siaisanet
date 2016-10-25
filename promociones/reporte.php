<?php
require_once './php/Model/ReporteModel.php';
       if(isset($_GET["tipo"])){
           
           switch($_GET["tipo"])
           {
            case "generalPre":
                $reporte=new ReporteModel();
                $reporte-> getGeneralPre();
            break;
            case "productividad":
                $reporte=new ReporteModel();
                echo $reporte->getProductividad();
                break;
            case "productividadDate":
                $reporte=new ReporteModel();
                $inicio=$_GET['inicio'];
                $fin=$_GET['fin'];
                echo $reporte->getProdutividadByDate($inicio, $fin);
           break;
           case "citas":
               $reporte= new ReporteModel();
               $reporte->getCitas();
               break;
           case "NoMeInteresa":
               $reporte= new ReporteModel();
               $reporte->getNoMeInteresa();
               break;
           case "atendidoTabla":
               $reporte=new ReporteModel();
               echo $reporte->getAtendidosTabla();
               break;
           case "ReporteGeneral":
               if(isset($_GET['id_segmento'])){
                    $reporte = new ReporteModel();
                    $reporte->getReporteGeneral($_GET['id_segmento']);
               }
               break;    
           case "interesados":
                $reporte=new ReporteModel();
                $reporte->getInteresados();
                break;
            case "invalidos":
                $reporte=new ReporteModel();
                $reporte->getInvalidos();
                break;
            case "grafica":
                $reporte=new ReporteModel();
                echo $reporte->getGrafica();
                break;
           case "atendidos":
               $reporte=new ReporteModel();
               echo $reporte->getAtendidos();
               break;
            case "layoutInfo":
                $reporte=new ReporteModel();
                echo $reporte->getLayoutInfo();
              break;
          
            case "reporte-sms":
                 $reporte=new ReporteModel();
                 $reporte->getReporteSms($_GET['producto'],$_GET['tipo-reporte']);
                break;
           }
       }
