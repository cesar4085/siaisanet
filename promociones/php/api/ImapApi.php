<?php
 require_once '../Model/ImapReader.php';
 
 if($_SERVER['REQUEST_METHOD']=='GET'){
     
     if(isset($_GET['tipo'])){
         
         switch($_GET['tipo']){
             case 'inbox':
                    $imap = new ImapReader(true);
                    echo $imap->getInBox();
                break;
             case 'info':
                     $imap = new ImapReader(false);
                     echo $imap->getInfoById($_GET['id_inbox']);
                 break;
             case 'body':
                 
                 if(isset($_GET['uid']))
                 {
                     $imap = new ImapReader(true);
                      
                     if($_GET['read']==true){
                          
                            $imap->markAsRead($_GET['id_inbox']);
                     }
                     
                      echo $imap->getBodyByUid($_GET['uid']);
             
                 }
                 
              break;
                 
             
             
                 
         }
         
     }
     
 }
 
 else if($_SERVER['REQUEST_METHOD']=='POST'){
             if(isset($_POST['id_inbox'])){
                if (session_status() == PHP_SESSION_NONE)
                {
                          session_start();  

                }
                $imap=new ImapReader(false);
                $imap->markAtendido($_POST['mensaje'], $_POST['status'], $_POST['id_inbox'], $_SESSION['id_usuario']);
                $headers.="From:financiera-ayudamos@mailing.sistema-siaisa.net\r\n";
                $headers.="MIME-Version: 1.0\r\n";
                $headers.="Content-Type: text/html; charset=UTF-8\r\n";
                mail('oemy93@hotmail.com',$_POST['asunto'],$_POST['mensaje'],$headers);
                mail($_POST['to'],$_POST['asunto'],$_POST['mensaje'],$headers);
             }
 }
 
 
