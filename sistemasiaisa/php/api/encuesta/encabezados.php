<?php
require_once '../../model/Conexion.php';
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
    $conexion=new Conexion();
    $conn=$conexion->getConexion();
    $res=$conn->query("select cliente_encuesta.no_contrato,cliente_encuesta.nombre,cliente_encuesta.telefono_fijo,cliente_encuesta.telefono_movil,cliente_encuesta.id_prioridad, credito_encuesta.monto_adicional,credito_encuesta.monto_adicional_2,credito_encuesta.monto_autorizado,credito_encuesta.monto_autorizado_2,credito_encuesta.pago,credito_encuesta.periodicidad,credito_encuesta.plazo,credito_encuesta.tipo_credito from cliente_encuesta INNER JOIN credito_encuesta ON cliente_encuesta.id_cliente=credito_encuesta.id_cliente limit 1");
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
