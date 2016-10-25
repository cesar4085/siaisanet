<?php
require_once '../model/MonitoreoModel.php';
if(isset($_GET)){
   $monitor= new MonitoreoModel();
   echo $monitor->getContactacion();
}
