<?php
require_once '../../Model/MonitoreoModel.php';
if(isset($_GET)){
   $monitor= new MonitoreoModel();
   echo $monitor->getContactacion();
}
