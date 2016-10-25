<?php
require_once '../model/CobranzaModel.php';
if(isset($_POST)){
    $jsonInput=file_get_contents('php://input');
    $data= json_decode($jsonInput);
    $cobranza=new CobranzaModel();
    $cobranza->guardarInfo($data);
    
}
