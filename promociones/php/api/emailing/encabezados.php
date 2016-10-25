<?php
    if(!empty($_FILES)){  
     $tmpName = $_FILES['csv']['tmp_name'];
     $handle = fopen($tmpName, "r");
     $count=0;
     $encabezados=array();
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if($count<1)
        {
              foreach($data as $encabezado){
                  array_push($encabezados, $encabezado);
              }
         }   
         $count++;
         
     }
    $tipo=$_POST['tipo'];
    $nombre=guardarCSV();
    $bd_encabezado=getEncabezadosBd($tipo);
    $retorno=array(
        "encabezado"=>$encabezados,
        "bd_encabezado"=>$bd_encabezado,
        "nombre_archivo"=>$nombre,
        "total"=>($count-1)
        
    );
    echo json_encode($retorno);                
}



function getEncabezadosBd($tipo){
    $dbName="promoc23_SMS";
    $user="promoc23_siaisa";
    $password="director1210";
    $host="promocionesfinancieraayudamos.com";
    $conn= new PDO("mysql:host=".$host.";dbname=".$dbName,$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sql=$tipo==1? "SELECT producto,cuenta,telefono,mensaje,resultado,fecha_envio,tipo_envio FROM envios LIMIT 1": 
            "SELECT telefono,mensaje,fecha,tipo_respuesta FROM respuestas LIMIT 1";
    $res=$conn->query($sql);
    $columnas= array_keys($res->fetch(PDO::FETCH_ASSOC));
    return $columnas;
}

function guardarCSV(){
    if(is_uploaded_file($_FILES["csv"]["tmp_name"])){
                            $nombreDir="upload/";
                            $idUnico=  time();
                            $nombreFichero=$idUnico."_".$_FILES["csv"]["name"];
                            move_uploaded_file($_FILES["csv"]["tmp_name"], $nombreDir.$nombreFichero);
                            return $nombreFichero;
     }
}
