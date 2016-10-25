<?php
require_once '../Model/EmailModelSend.php';
$sendGrid = new EmailModelSend();
$sendGrid->enviarEmailByIdCandidato(4);