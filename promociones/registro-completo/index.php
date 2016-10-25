<!DOCTYPE html>
  <?php
 require_once '../php/Model/CandidatoModel.php'; 
 require_once '../php/Model/HtmlHelper.php';
    if(!empty($_POST)){
                          
        
                            $id_candidato=$_POST['id_candidato'];
                            $nombre=$_POST['nombre'];
                            $tel_movil=$_POST['tel_movil'];
                            $tel_opcional=$_POST['tel_opcional'];
                            $cons=$_POST['consentimiento'];
                            $candidatoModel= new CandidatoModel();
                            $candidatoModel->setProcesoSolicitud($tel_movil, $tel_opcional, $id_candidato,$cons);
                            $mensaje=$cons==1? utf8_encode('Muchas gracias, en breve un ejecutivo se comunicará con usted.'): 
                                              utf8_encode('Financiera Ayudamos Agradece su respuesta y
                                                                esperamos poder atenderle en el futuro, contacto al 55-99-15-50 en la
                                                                Ciudad de México o al 01 800 999 15 50 para el Interior de la República.');
                            
                            $html = new HtmlHelper();
                            echo $html->paginaMensajeFinanciera($mensaje);
                            
       }
       else{
           var_dump($_POST);
       }
                       
                           
                                
                           
                         
                                
                            
                        
                          
                        
                        
?>

