<?php
require_once '../../model/MonitoreoModel.php';

if(isset($_GET)){
  $monitoreo=new MonitoreoModel();
  echo $monitoreo->getInformacionGeneral();
}
