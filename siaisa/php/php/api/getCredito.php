<?php
require_once '../model/CobranzaModel.php';
$id_cliente=  filter_input(INPUT_GET, "id_cliente");
if(!empty($id_cliente)){
    $cobranza=new CobranzaModel();
    echo $cobranza->getCredito($id_cliente);
}
