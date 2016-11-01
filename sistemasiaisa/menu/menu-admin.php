<!doctype html>
 <html class="no-js" lang="" ng-app="app"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SIAISA</title>
    </head>
    <body>
        <?php
                require_once '../php/model/MenuModel.php';
                $menu = new MenuModel();
         ?>
        
        <iframe src="<?php echo '../dashboard/#/inicio/'.$menu->getUsuarioNombre()?>" frameborder="0" width="100%" height="100%" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding-top:0px; overflow:hidden;">
            
        </iframe>
        
    </body>
</html>