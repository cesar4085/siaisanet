<?php
require_once '../Model/ReporteModel.php';
$rpt = new ReporteModel();
echo $rpt->segmentosDisponibles();