<?php
/*
    AUTOR OSCAR PEREZ
    FECHA: 28/07/2016
 */
 class MenuModel
{
    
     //IMPRIME EL NOMBRE DEL USUARIO ACTUAL 
    public  function imprimirNombre(){
        
         if (session_status() == PHP_SESSION_NONE)
         {
                   session_start();  

         }
          
            if(!isset($_SESSION['nombre']))
            { 
               header("Location:index.html");

            }
            else{
                return $_SESSION['nombre'];
            }
            
        
    }
    //DETERMINA SI LA PERSONS QUE INICIO SESIÓN ES  ADMIN O AGENTE
    //IMPORTANTE admin=0 monitorista=1 agente=2
    //REGLA DE NEGOCIO LOS ADMINISTRADORES Y MONITORISTAS PUEDEN AGREGAR AGENTES
    public function isAdmin(){
      
       return  $_SESSION["nivel_acceso"]==0||  $_SESSION["nivel_acceso"]==3;
      
    }
    public  function isFinanciera(){
        return $_SESSION["nivel_acceso"]==3;
    }
    
   
}