<?php
 if (session_status() == PHP_SESSION_NONE)
 {
	session_start();  
                                      
 }
 if($_SESSION['nivel_acceso']==0 || $_SESSION['nivel_acceso']==3)
 {
     include './menu-admin.php';              
         
 }else{
     include './menu-user.php';
     
 }