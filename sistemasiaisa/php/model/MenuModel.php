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
          
            if(!isset($_SESSION['nombre_completo']))
            { 
               header("Location:index.php");

            }
            else{
                return $_SESSION['nombre_completo'];
            }
            
        
    }
    public function  getUsuarioNombre(){
        if (session_status() == PHP_SESSION_NONE)
         {
                   session_start();  

         }
           if(!isset($_SESSION['nombre_completo']))
            { 
               header("Location:index.php");

            }
            else{
                return $_SESSION['usuario'];
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