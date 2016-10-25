<?php
/**
* 
* This Example shows how to authenticate a user using XML-RPC.
* Note that we are using the PEAR XML-RPC client and recommend others do as well.
*/
 require_once './vendor/autoload.php';
 require_once './model/EmailModel.php';
 if(isset($_POST)){
     $mail = new PHPMailer();
    $model=new EmailModel();

    $output = ob_get_contents(); //Grab output
    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'postmaster@sistema-siaisa.net'; // SMTP username from https://mailgun.com/cp/domains
    $mail->Password = '6d82a73f75f5bf67ae9d7f047a73f6c7'; // SMTP password from https://mailgun.com/cp/domains
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; 
    $mail->FromName = 'Financiera ayudamos test'; // The NAME field which will be displayed on arrival by the email client
    foreach($model->getSubscriptores() as $user){
        $mail->addAddress($user['email'],$user['nombre']);     // Recipient's email address and optionally a name to identify him
    }
    
    $mail->addAddress('siaisagrupo@gmail.com', 'SIAISA TEST');
    
    $mail->isHTML(true);   // Set email to be sent as HTML, if you are planning on sending plain text email just set it to false
    // The following is self explanatory
    $mail->Subject = 'PRUEBA FINANCIERA AYUDAMOS EMAIL';
    $mail->Body    = utf8_encode($model->getCustomHtml('ok'));
    $mail->CharSet = 'UTF-8';
    $mail->AltBody = 'FINANCIERA AYUDAMOS PRUEBA';
    

    if(!$mail->send()) {  
        echo "Message hasn't been sent.";
        echo 'Mailer Error: ' . $mail->ErrorInfo . "\n";
    } else {
        echo "Message has been sent :) \n";

    }
 }


?>