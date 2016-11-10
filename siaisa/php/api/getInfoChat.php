<?php
require_once '../../model/ChatStd.php';
if (isset($_GET)){
$chatstd= new chatstd();
echo $chatstd->getInfoChat();
}