<?php
require_once '../Model/LoginModel.php';
$jsonInput=file_get_contents('php://input');
if(!empty($jsonInput)){
    $postData=  json_decode($jsonInput);
    $login=new LoginModel();
    $login->isValid($postData->nombre,$postData->password);   
}