<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailModelSend
 *
 * @author OSCARITO
 */
include_once(__DIR__ . '/Conexion.php');
include_once(__DIR__ .'/CandidatoModel.php');
include_once(__DIR__ .'/HtmlHelper.php');
include_once(__DIR__ .'/vendor/autoload.php');
class EmailModelSend {
   //SEND GRID PARAMETROS USUARIO Y PASSWORD
   const USUARIO_NOMBRE="siaisagrupo";
   const PASSWORD="53689439aB"; 
   const SUBJECT="TIENE UN CREDITO PREAUTORIZADO";
   const EMAIL="webmaster@financieraayudamos.com";
   
   //CONTADOR PARA SABER CUANTOS EMAILS SE HAN ENVIADO.
   private  $count;
   private $candidatoModel; //VARIABLE GLOBAL DEL TIPO CANDIDATO
   public function  _construct(){
       $this->candidatoModel=new CandidatoModel();
   }
   //ESTA FUNCIÓN SE USUARÁ EN  TODAS LAS FUNCIONES DE ABAJO. SE PODRÍA DECIR QUE ES LA FUNCIÓN MADRE 
   private function envioBase($to,$html)
   {
        $sendgrid = new SendGrid(self::USUARIO_NOMBRE, self::PASSWORD);
        $email = new SendGrid\Email();
        $email->addTo($to)->
        setFrom(self::EMAIL)->
        setSubject(self::SUBJECT)->
        setText(self::SUBJECT)->
        setHtml($html);
        $res=$sendgrid->sendEmail($email);
        if($res->message=='success'){
            $this->count++;
            $this->agregarStatusEnvio($this->count);
        }
        else{
            $this->agregarStatusEnvio($res->message);
        }
   }
    //ENVIA UN EMAIL POR EL ID DEL CANDIDATO
      public  function enviarEmailByIdCandidato($id,$email=''){
     
          
                $model=new CandidatoModel();
                $candidato=$model->getInfoById($id)[0];
                $helper = new HtmlHelper();
                $html=$helper->paginaPrimerSegmento($candidato['nombre'], $candidato['oferta'], $candidato['oferta_letra'], $candidato['pago'], $candidato['plazo'], $candidato['folio'], $candidato['comision'],$candidato['comision_letra'], $candidato['tasa_fija'], $candidato['tasa_letra'], $candidato['cat'], $candidato['guid']);
                $to=!empty($email)?$email: $candidato['email'];
                $this->envioBase($to, $html);
                return 'enviado correctamente!';
             
    }
   
    //CESAR PRUEBA CON ESTA FUNCION PARA HACER PRUEBAS DE ENVÍO 
    //PARAM $TO = direccion email 
    public  function envioPrueba($to){
        
        $htmlHelper = new HtmlHelper();
        $htmlP=$htmlHelper->paginaPrimerSegmento('MAGUI OROZCO', '4000','CUATRO MIL', '10', '15', 'FOLIOEJEMPLO','20%', 'VEINTE', '10%','EJEMPLO', '110%', 'SOMEGUID');
        $this->envioBase($to, $htmlP);
    }
    //ENVIA EMAIL POR SEGMENTO Y NUMERO CUANTOS EMAILS SE VAN A ENVIAR
        public  function enviarEmailBySegmento($id_segmento,$numero){
                $model=new CandidatoModel();
                $count=0;
                $candidatos=$model->getClienteBySegmento($id_segmento);       
                foreach ($candidatos as $candidato){
                  if($count<$numero){  
                    if($candidato['valido']==1){
                        $helper = new HtmlHelper();
                        $html=$helper->paginaPrimerSegmento($candidato['nombre'], $candidato['oferta'], $candidato['oferta_letra'], $candidato['pago'], $candidato['plazo'], $candidato['folio'], $candidato['comision'],$candidato['comision_letra'], $candidato['tasa_fija'], $candidato['tasa_letra'], $candidato['cat'], $candidato['guid']);   
                        $this->envioBase($candidato['email'], $html);
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
     private  function agregarStatusEnvio($mensaje){
                            $fp = fopen("status.txt", 'w');  
                            fwrite($fp,$mensaje.PHP_EOL);  
                            fclose($fp);  

    }
     public function esValido($email) {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
