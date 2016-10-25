<?php

require_once '../model/EmailModel.php';
 if(isset($_POST)){
     
     $email = new EmailModel();   
    
  
  /*  
    foreach($email->getSubscriptores() as $user){
        $email->enviarEmail($user['email'],$user['nombre'],"$4500");   
    }*/
     
    echo $email->enviarEmail('oemy93@hotmail.com','Oscar Pérez',"$9500");   
 
 }


?>