<?php
          include_once '../../model/EmailModel.php';
          if(isset($_POST))
          {
              if(!empty($_FILES)){
                try{
                 $tmpName = $_FILES['csv']['tmp_name'];
                 $handle = fopen($tmpName, "r");
                 $count=0;
                 $email= new EmailModel();
                 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                      
                    $email->agregarSusbscriptores($data[0], $data[1], $data[2],$count);
                    $count++;
                }
                    echo $count;
                }
                catch(PDOException $ex){
                        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
                        echo $ex->getMessage();
    
                }
             }
          }
    
    ?>