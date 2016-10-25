<?php
require_once './php/model/EncuestaModel.php';
try{
    $encuesta=new EncuestaModel();
    $encuesta->resetClientes();
    mail("oemy93@hotmail.com,cesar4085@live.com.mx","RESULTADO CRON PHP","ESTATUS OK");
}
 catch (Exception $ex){
     mail("oemy93@hotmail.com,cesar4085@live.com.mx","RESULTADO CRON PHP",$ex->getMessage());
 }




