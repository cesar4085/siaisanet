<?php
$str='http://promocionesfinancieraayudamos.com/registro/?guid=kakaka';
$_url_cortada=substr($str,40); 
echo $_url_cortada;
if (strpos($_url_cortada, 'registro') !== false) {
    echo 'TIENE REGISTRO';
 }
 else{
     echo 'NO TIENE REGISTRO';
 }