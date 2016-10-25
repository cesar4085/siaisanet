<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImapReader
 *
 * @author OSCARITO
 */
include_once(__DIR__ . '/Imap.php');
include_once(__DIR__ . '/Conexion.php');
class ImapReader {
 
    private $mailbox;
    private $username;
    private $password;
    private $encryption;
    private $imap;
    
     function __construct($initMap=false){
         
         if($initMap==true){
            $this->mailbox = 'servidor1137.il.controladordns.com';
            $this->username = 'webmaster@promocionesfinancieraayudamos.com';
            $this->password = 'oscarito9410';
            $this->encryption = 'tls'; // or ssl or '';
            $this->imap = new Imap($this->mailbox, $this->username, $this->password, $this->encryption);
         }
      

    }
    //Retorna los mensajes no leidos 
    public  function getNuevos(){  
         $this->imap->selectFolder("Inbox");
         return $this->imap->countUnreadMessages();
    }
    
    public  function getTotal(){
        return $this->imap->countMessages();
    }



    public  function getInBox(){
       
        try{
         //Los almacenamos en nuestra Bd
        $instancia = new Conexion();
        $con=$instancia->getConexion();
        
        //Leemos los emails que vienene del proveedor
        $this->imap->selectFolder("Inbox");
        $emails = $this->imap->getMessages();
       
         //Los alamcenamos en nuestra BD
         foreach($emails as $email){
               $this->imap->setUnseenMessage($email['uid'],true);
               $query=$con->prepare("call agregarInbox(:email,:asunto,:uid,:date);");
               $query->bindParam(":email",$email['email_from']);
               $asunto=!empty($email['subject'])? $email['subject']:'sin asunto';
               $query->bindParam(":asunto",$asunto);
               $query->bindParam(":uid",$email['uid']);
               $query->bindParam(":date",$email['date']);
               $query->execute();
         }
        
         //Retornamos cada uno de los emails 
         $querySelect=$con->prepare("SELECT*FROM inbox_detalle");
         $querySelect->execute();
         $res= $this->utf8_converter($querySelect->fetchAll(PDO::FETCH_ASSOC));
         return json_encode($res); 
        }
        catch (Exception $ex){
              $fp = fopen("log.txt", 'w');  
                            fwrite($fp,$ex->getMessage().PHP_EOL);  
                            fclose($fp);  
    }
        
    }
    public function getBodyByUid($uid){
        $this->imap->selectFolder("Inbox");
        $email= $this->imap->getMessage($uid,true);
        return $email['body'];
    }
    //STATUS 0= INBOX 1 = LEIDO Y PENDIENTE, 2= RESPONDIDO
    public function markAsRead($id_inbox){
        $instancia = new Conexion();
        $con=$instancia->getConexion();
        $query=$con->prepare("UPDATE inbox_email SET status=1 WHERE id_inbox=:id_inbox");
        $query->bindParam(":id_inbox",$id_inbox);
        $query->execute();
    }
    
    public  function getInfoById($id_inbox){
        $instancia = new Conexion();
        $con=$instancia->getConexion();
        $query=$con->prepare("SELECT*FROM inbox_detalle WHERE id_inbox=:id_inbox");
        $query->bindParam(":id_inbox",$id_inbox);
        $query->execute();
        $res= $this->utf8_converter($query->fetchAll(PDO::FETCH_ASSOC));
        return json_encode($res); 
    }


    public  function markAtendido($mensaje,$status,$id_inbox,$id_usuario){
        $instancia = new Conexion();
        $con=$instancia->getConexion();
        $query=$con->prepare("call agregarAtendido(:mensaje,:status,:id_inbox,:id_usuario);");
        $query->bindParam(":mensaje",$mensaje);
        $query->bindParam(":status",$status);
        $query->bindParam(":id_inbox",$id_inbox);
        $query->bindParam(":id_usuario",$id_usuario);
        $query->execute();
        return 'ok';
    }
    public function checkExits($uid){
        $instancia = new Conexion();
        $con=$instancia->getConexion();
        $nRows=$query=$con->query("SELECT COUNT(*) FROM respuesta WHERE uid=$uid")->fetchColumn();
        return $nRows;
    }
    
     public function utf8_converter($array)
    {
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
            }
        });

        return $array;
    }
  
}
