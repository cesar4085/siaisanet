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
     
    $nombre=guardarCSV();
    $bd_encabezado=getEncabezadosBd();
    $retorno=array(
        "encabezado"=>$encabezados,
        "bd_encabezado"=>$bd_encabezado,
        "nombre_archivo"=>$nombre,
        "total"=>($count-1)
        
    );
    echo json_encode($retorno);                
}



function getEncabezadosBd(){
    $dbName="sistem80_emailing";
    $user="sistem80_siaisa";
    $password="director1210";
    $host="sistema-siaisa.net";
    $conn= new PDO("mysql:host=".$host.";dbname=".$dbName,$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $res=$conn->query("select no_contrato,nombre,email from subscriptores limit 1");
    $columnas= array_keys($res->fetch(PDO::FETCH_ASSOC));
    return $columnas;
}

function guardarCSV(){
    if(is_uploaded_file($_FILES["csv"]["tmp_name"])){
                            $nombreDir="upload/";
                            $idUnico=  time();
                            $nombreFichero=$idUnico."-".$_FILES["csv"]["name"];
                            move_uploaded_file($_FILES["csv"]["tmp_name"], $nombreDir.$nombreFichero);
                            return $nombreFichero;
     }
}
