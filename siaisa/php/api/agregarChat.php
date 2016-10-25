
<?php
require_once '../model/chatModel.php';

 if (isset($_POST)) {
    if(!empty($_POST)){
    $nombre_cliente = isset($_POST['nombre_cliente'])? $_POST['nombre_cliente']:null;
    $folio =isset($_POST['folio'])? $_POST['folio']:null;
    $mail = isset($_POST['mail'])? $_POST['mail']:null;
    $tel_1 = isset($_POST['tel_1'])? $_POST['tel_1']:null; 
    $status=isset($_POST['status'] ) ?$_POST['status']: null; 
    $notas=isset($_POST['notas']) ? $_POST['notas']:null;
    $agente=isset($_POST['nombre_agente']) ? $_POST['nombre_agente']:null;
    $procedencia = isset($_POST['procedencia'])? $_POST['procedencia']:null;
    $alta=new ChatModel();
    $alta->agregarChat($nombre_cliente, $folio,$mail, $tel_1, $status,$notas,$agente,$procedencia);
   }
    
  }

 