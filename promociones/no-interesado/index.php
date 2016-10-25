<!DOCTYPE html>


        <?php
            require_once '../php/Model/HtmlHelper.php';
                            session_start();  
                            $html = new HtmlHelper();
                            echo $html->paginaMensajeFinanciera(utf8_encode('<p>Financiera Ayudamos Agradece su respuesta y esperamos poder atenderle en el futuro, contacto al 55-99-15-50 en la Ciudad de México</p><p> o al 01 800 999 15 50 para el Interior de la República.</p>'));
        ?>
