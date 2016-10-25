<?php
 if (session_status() == PHP_SESSION_NONE)
 {
                   session_start();  
 }
 $logged=$_SESSION['logged'];
if(session_destroy()){
    if($logged=="encuesta"){
        header('location:http://sistema-siaisa.net');
        
    }else{
            header('location: index.html');
    }
}
