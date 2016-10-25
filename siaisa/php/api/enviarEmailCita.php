<?php
require '../Model/ProspectoModel.php';
$prospecto=new ProspectoModel();
$prospecto->enviarEmail(585, '2016-10-03 16:00:00');