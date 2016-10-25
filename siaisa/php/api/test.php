<?php
$time=strtotime('Tue, 6 Sep 2016 22:03:29 +0000 (UTC)');
$dateInLocal = date("Y-m-d H:i:s", $time);
echo $dateInLocal;