<?php
require_once '../Model/CodigosModel.php';
 if($_POST["tipo"]=="getCodigos"){
                $codigos=new CodigosModel();
                echo $codigos->getCps();
            }
            else if($_POST["tipo"]=="getData"){
                $cp=$_POST["cp"];
                $codigos=new CodigosModel();
                echo $codigos->getData($cp);
            }
            else if($_POST["tipo"]=="getDelegaciones"){
                $codigos=new CodigosModel();
                echo $codigos->getDelegaciones();
            }
            else if($_POST["tipo"]=="getColonias"){
                $codigos=new CodigosModel();
                echo $codigos->getColonias();
            }