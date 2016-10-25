<?php
  require_once '../Model/EmailModelSend.php';   
  ini_set('max_execution_time',-1);
  
  if(filter_has_var(INPUT_POST,'id_segmento') && filter_has_var(INPUT_POST,'numero')){
     $id_segmento=  filter_input(INPUT_POST,'id_segmento');
     $numero=  filter_input(INPUT_POST,'numero');
     $sendGridModel = new EmailModelSend();
     echo $sendGridModel->enviarEmailBySegmento($id_segmento,$numero);
  }else if(filter_has_var(INPUT_POST,'id_candidato') && filter_has_var(INPUT_POST,'email')){
      $id_candidato=  filter_input(INPUT_POST,'id_candidato');
      $email=  filter_input(INPUT_POST,'email');
      //Caso de que ingresaron email
      if(!empty($email)){
          if(valid_email($email)==FALSE){
               echo 'Email no valido';
          }
          else{
               $sendGridModel = new EmailModelSend();
               echo $sendGridModel->enviarEmailByIdCandidato($id_candidato,$email);
          }
      }
      //Dejo el input email vacio
      else{
           $sendGridModel = new EmailModelSend();
            echo $sendGridModel->enviarEmailByIdCandidato($id_candidato,$email);
      }
     
      
  }

 function valid_email($email) {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }
 
  



