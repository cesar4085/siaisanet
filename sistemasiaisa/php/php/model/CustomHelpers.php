<?php

class CustomHelpers {
    public static function parseFecha($fecha){
       return date('dd/MM/yyyy',strtotime($fecha));
    }
    
    public static function bool2Int($campo){
        return $campo==true? 1 : 0;
    }
    public  static function int2String($campo){
        return $campo==1? "SI": "NO";
    }
    public static function null2Int($campo){
        return is_null($campo)|| empty($campo)==true? 0: $campo;
    }
    public static  function is_localhost() {
        $whitelist = array( '127.0.0.1', '::1' );
        if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ){
            return true;
        }
        else{
            return false;
        }
    }
    public static  function getCurrentFecha(){
        date_default_timezone_set('America/Mexico_City');
        return   $date = date('Y-m-d H:i:s');
   }
    
   
}
