

<?php
    require_once '../../model/Conexion.php';
    set_time_limit(300);  
    $jsonInput=file_get_contents('php://input');
    
    if(!empty($jsonInput)){
        
        $data_json= json_decode($jsonInput);
        $handle = fopen("upload/".$data_json->nombre_archivo, "r");
        $count=0;
        $dbName="sistem80_emailing";
        $user="sistem80_siaisa";
        $password="director1210";
        $host="sistema-siaisa.net";
        $conn= new PDO("mysql:host=".$host.";dbname=".$dbName,$user,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        
        while (($csv = fgetcsv($handle, 1000, ",")) !== FALSE) {
           if($count>=1){
            try{
                $count++;
                $no_contrato= isset($data_json->no_contrato)? $csv[$data_json->no_contrato]: null;
                $nombre=isset($data_json->nombre)? $csv[$data_json->nombre]:null;
                $email=isset($data_json->email)?$csv[$data_json->email]:null;
                
                $query=$conn->prepare("INSERT INTO subscriptores(no_contrato,nombre,email) VALUES (:no_contrato,:nombre,:email)");
                $query->bindValue(":no_contrato",$no_contrato);
                $query->bindValue(":nombre",$nombre);
                $query->bindValue(":email",$email);
                $query->execute();
                
            } catch (Exception $ex) {
                    echo $ex->getMessage();
                    break;
            }
           
        }
        else{
            $count++;
        }
        echo 'OK';
          
       }
    }
       
    
  