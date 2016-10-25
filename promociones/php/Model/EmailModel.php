<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailModel
 *
 * @author Victor Ortiz
*/
include_once(__DIR__ . '/Conexion.php');
include_once(__DIR__ .'/CandidatoModel.php');
include_once(__DIR__ .'/HtmlHelper.php');
require_once '../vendor/autoload.php';

use Mailgun\Mailgun;
class EmailModel {
   const API_KEY="key-c5d0b8b911a3c8fbf24a08b5ea72f6b4";
   const API_KEY_OSCAR="key-c5d0b8b911a3c8fbf24a08b5ea72f6b4";
   const API_KEY_PUBLICA="pubkey-8f3adb118b5deb50d2c71193af81457d";
   const DOMINIO="mailfinanciera.sistema-siaisa.net";
   const DOMINIO_OSCAR="mailfinanciera.sistema-siaisa.net";
   private  $count;
   private $candidatoModel;
   public function  _construct(){
       $this->candidatoModel=new CandidatoModel();
   }
   public function validar_email($email)
   {
       $mgClient = new Mailgun(self::API_KEY_PUBLICA);
       $result = $mgClient->get("address/validate", array('address' => $email));
       $isValid = $result->http_response_body->is_valid;
       return $isValid;
   }
   public  function validar_emailByList($list){
       $mgClient = new Mailgun(self::API_KEY_PUBLICA);
       $result = $mgClient->get("address/parse", array('addresses' => 'oemy93@hotmal.com,oscar12@gmail.com,cesar4085@live.com.mx'));
       return var_dump($result);
   }
   public function getInvalidos($str_url_next=''){
        $mgClient = new Mailgun(self::API_KEY);
        $queryString = array('event' => 'failed','limit'        => 300,'severity'=>'permanent');
        $result = $mgClient->get(empty($str_url_next)?self::DOMINIO."/events":$str_url_next, $queryString);
        $items=$result->http_response_body->items;
        foreach($items as $item)
         {
            if(!empty($item->message->headers->to)){
                $email=$item->message->headers->to;
                echo "call sistem80_emailing.markar_invalido('".$email."');";
                echo '<br>';
            }
            else{
                return true;
            }
        }
        if(isset($result->http_response_body->paging->next)){
            $this->getInvalidos($result->http_response_body->paging->next);
        }
        else{
            echo 'STOP';
        }
   }
   public function enviar_emailBase($id_candidato,$email,$html){
      // try{
              $mgClient = new Mailgun(self::API_KEY_OSCAR);
              $result = $mgClient->sendMessage(self::DOMINIO_OSCAR, array(
                        'from'           => 'Financiera ayudamos <financiera-ayudamos@mailfinanciera.sistema-siaisa.net>',
                        'to'             => $email,
                        'subject'        => 'TIENE UN CREDITO PREAUTORIZADO',
                        'text'           => 'TIENE UN CREDITO PREAUTORIZADO',
                        'html'           => $html,
                                     
                    ));
                 $model = new CandidatoModel();
                 if(isset($result->http_response_body->id)){
                     if($model->agregarStatusEmail($result->http_response_body->id,$id_candidato)==true){
                         $this->count++;
                         $this->agregarStatusEnvio($this->count);
                     }
                 }
      // }
       /*
       catch (Exception $ex){
                   
                $this->agregarStatusEnvio('Invalido:'.$id_candidato);
                $this->agregarInvalido('Invalido:'.$id_candidato);
        }*/
    }
    private  function agregarStatusEnvio($mensaje){
                            $fp = fopen("_contador.txt", 'w');  
                            fwrite($fp,$mensaje.PHP_EOL);  
                            fclose($fp);  

    }
    private function agregarStatusEmail($email){
        $fp = fopen("_email_status.txt",'w');
        fwrite($fp, $email.PHP_EOL);
        fclose($fp);
    }
    public  function enviarEmailByIdCandidato($id){
                $model=new CandidatoModel();
                $candidato=$model->getInfoById($id)[0];
                $helper = new HtmlHelper();
                $html=$helper->paginaPrimerSegmento($candidato['nombre'], $candidato['oferta'], $candidato['oferta_letra'], $candidato['pago'], $candidato['plazo'], $candidato['folio'], $candidato['comision'],$candidato['comision_letra'], $candidato['tasa_fija'], $candidato['tasa_letra'], $candidato['cat'], $candidato['guid']);
                $this->enviar_emailBase($candidato['id_candidato'], $candidato['email'], $html);
             
    }

    public  function enviarEmailBySegmento($id_segmento,$numero){
              
                $model=new CandidatoModel();
                $count=0;
                $candidatos=$model->getClienteBySegmento($id_segmento);       
                foreach ($candidatos as $candidato){
                  if($count<$numero){  
                    if($candidato['valido']==1){
                        $helper = new HtmlHelper();
                        $html=$helper->paginaPrimerSegmento($candidato['nombre'], $candidato['oferta'], $candidato['oferta_letra'], $candidato['pago'], $candidato['plazo'], $candidato['folio'], $candidato['comision'],$candidato['comision_letra'], $candidato['tasa_fija'], $candidato['tasa_letra'], $candidato['cat'], $candidato['guid']);   
                        $this->enviar_emailBase($candidato['id_candidato'], $candidato['email'], $html);
                        $count++;
                    }
                    else{
                        $this->agregarStatusEnvio("Email invalido:".$candidato['email']);
                        
                    }
                  }
                }
                $this->agregarStatusEnvio('Envio correcto!');
                return 'Envio correcto!';
                
                                
             
     }
     
     
     public function valid_email($email) {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }
     
     
}
