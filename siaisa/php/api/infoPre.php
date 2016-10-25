<?php
  require_once '../Model/ReporteModel.php';
  $reporte = new ReporteModel();
  echo $reporte->getInfoGeneralProspecto();