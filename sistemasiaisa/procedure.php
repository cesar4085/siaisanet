<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
          require_once './php/model/MonitoreoModel.php';
          $monitor=new MonitoreoModel();
          //var_dump($monitor->getMonitoreo(false));
          echo $monitor->getMonitoreoByDate('2016-08-11');
        ?>
    </body>
</html>
