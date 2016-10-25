<?php
require_once '../Model/Conexion.php';
$key='key-c5d0b8b911a3c8fbf24a08b5ea72f6b4';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['timestamp']) && isset($_POST['token']) && isset($_POST['signature']) && hash_hmac('sha256', $_POST['timestamp'] . $_POST['token'], $key) === $_POST['signature'])
	{

 
                 $result =  json_encode($_POST);
                // mail('oemy93@hotmail.com', 'WEB HOOK',  json_encode($result));
                 $id_mail= isset($_POST['Message-Id'])? $_POST['Message-Id']:'<'.$_POST['message-id'].'>';
                 $evento=$_POST['event'];
                 $conexion = new Conexion();
                 $con=$conexion->getConexion();
                 $sql=''; 
                 if($evento=='bounced'){
                      $sql="call marcar_no_valido_webhook(:id_mail)";
                      $query=$con->prepare($sql);
                      $query->bindParam(":id_mail",$id_mail);
                      $query->execute();
                 }
                 if($evento=='delivered'){

                      $sql="UPDATE status_mail SET recibido=1 WHERE id_mail=:id_mail";
                      $query=$con->prepare($sql);
                      $query->bindParam(":id_mail",$id_mail);
                      $query->execute();
                  }
                  else if($evento=='opened'){
                       $sql="UPDATE status_mail SET abierto=1 WHERE id_mail=:id_mail";
                       $query=$con->prepare($sql);
                       $query->bindParam(":id_mail",$id_mail);
                       $query->execute();
                  }
                  else if($evento=='unsubscribed')
                  {
                       $sql="UPDATE status_mail SET unsubscribe=1 WHERE id_mail=:id_mail";
                       $query=$con->prepare($sql);
                       $query->bindParam(":id_mail",$id_mail);
                       $query->execute();
                  }
                  else if($evento=='dropped'){
                        $sql="UPDATE status_mail SET eliminado=1 WHERE id_mail=:id_mail";
                        $query=$con->prepare($sql);
                        $query->bindParam(":id_mail",$id_mail);
                        $query->execute();
                  }
                  else if($evento=='clicked'){
                         $str=$_POST['url'];
                         $_url_cortada=substr($str,42); 
                          mail("oemy93@hotmail.com;cesar4085@live.com.mx;",'CLICK',$str);
                          if (strpos($_url_cortada, 'registro') !== false) {
                                $sql='UPDATE status_mail SET click_interesa=1 WHERE id_mail=:id_mail';
                                $query=$con->prepare($sql);
                                $query->bindParam(":id_mail",$id_mail);
                                $query->execute();
                          }
                        else
                         {
                                
                                  $sql='UPDATE status_mail SET click_no_interesa=1 WHERE id_mail=:id_mail';
                                  $query=$con->prepare($sql);
                                  $query->bindParam(":id_mail",$id_mail);
                                  $query->execute();
                            
                       }
                 }
                  
                //mail('oemy93@hotmail.com', 'WEB HOOK', $sql."id_mail=".$id_mail);
                echo 'OK';

                
 
                
	}
}
header('X-PHP-Response-Code: 200', true, 200);
?>