<?php
 require_once '../Model/EmailModel.php';
 require_once '../Model/CandidatoModel.php';
           $email = new EmailModel();
           
           /*
            * $model_candidato=new CandidatoModel();
           $candidatos=$model_candidato->getEmailBySegmento(5);
           $list_candidatos='';
           foreach($candidatos as $candidato){
                  $list_candidatos.=$candidato['email'].',';
           }*/
         
         echo $email->getInvalidos();
          
           
        

