<?php
ini_set('max_execution_time', 5100);
date_default_timezone_set("America/New_York");
header("Content-Type: text/event-stream\n\n");

while (1) {
  // Every second, sent a "ping" event.
  session_start();         
  echo "event: ping\n";
  $curDate = date(DATE_ISO8601);
  echo 'data: {"time": "' . $curDate . '"}';
  echo "\n\n";
  if(file_exists("status.txt") && filesize("status.txt") > 0){  
   $arrayData=array_reverse(file("status.txt"));
   $total=$arrayData[0];
   echo 'data:'.$total . "\n\n";
 
  }
  
  ob_flush();
  flush();
  }
  

