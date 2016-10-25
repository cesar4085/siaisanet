<?php
require_once '../Model/ImapReader.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $_to=$_POST['to'];
     $_mensaje=$_POST['mensaje'];
     $_uid=$_POST['uid'];

     $headers.="From:financiera-ayudamos@mailing.sistema-siaisa.net\r\n";
     $headers.="MIME-Version: 1.0\r\n";
     $headers.="Content-Type: text/html; charset=UTF-8\r\n";
     mail($_to,'RE: TIENE UN CREDITO PREAUTORIZADO',$_mensaje,$headers);
     
     
    $imap=new ImapReader();
    $imap->markReply($_uid,$_to, $_mensaje);
    
    echo 'Enviado correctamente';
     
}