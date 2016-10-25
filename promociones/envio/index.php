<!DOCTYPE html>
<html class="no-js" lang="" ng-app="app">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CARGAR LAYOUT ENCUESTA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/animate.css">
    <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    
    
</head>

<body ng-controller="envioCtrl" init="init()" >
 
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">

                 <a class="navbar-brand animacion" href="#"><span><img src="../img/logo-siaisa.png" width="35" height="35"/></span>
                   SIAISA EMAILING
                 </a>
            </div>
    
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../logout.php">CERRAR SESIÓN</a>
                    </li>
                </ul>

            </div>
    </nav>
    <div class="container-fluid" style="padding-top:100px">
        <div class="row">
            <div class="col-md-5" ng-cloak>
               <label for="opcionEnvio">Selecciona el tipo de envío</label>
               <select name="opcionEnvio" ng-model="opcionEnvio">
                        <option value="0">Envio por segmento</option>
                        <option value="1" ng-selected="true">Envio por usuario</option>
                </select>
               <form ng-submit="enviarFormSegmento()" id="form" ng-show="opcionEnvio==0">
                    <div class="form-group animacion" >
                     <label>
                         Segmentos disponibles <small class="rojo"><i>segmento 0 debe ser usado como prueba</i></small>
                    </label>
                    <br>
                    <select ng-model="form.segmento" ng-options="x.id_segmento for x in segmentos" ng-change="onChange()" class="form-control">
                    </select>
                    <br>
                    <br>
                        <input ng-model="form.numero" placeholder="INGRESA LA CANTIDAD DE EMAILS QUE DESEAS ENVIAR" type="text" class="form-control"/>
                        <br>
                        <input type="submit" class="btn-block btn-lg btn-danger" value="Enviar" id="enviar">
                    </div>
                   
                </form>
               <form ng-submit="enviarFormUsuario()" ng-show="opcionEnvio==1"> 
                 <div class="form-group animacion" >
                        <label>Selecciona el <i class="rojo">id</i> del usuario donde se obtendrá la información (cat, tasa,etc.)</label>
                        <input type="number" min="1" ng-model="formCandidato.id" placeholder="id usuario aqui" class="form-control" required/>
                        <label>¿A qué email se mandará el correo? <small class="rojo"><i>Si lo dejas en blanco se envía al email del usuario por default</i></small></label>
                        <input type="email" placeholder="email" ng-model="formCandidato.email" class="form-control"/>
                        <br>
                        <input type="submit" class="btn-block btn-lg btn-danger" value="Enviar" id="enviar">
                    </div>
               </form>
               
            </div>
            <div class="col-md-7">
                <div  class="list-group col-md-12 col-xs-12" ng-cloak>
                            <a href="#" class="list-group-item visitor">
                                <h3 class="pull-right">
                                   <i class=" fa fa-th-list" aria-hidden="true"></i>
                                </h3>
                                <h4 class="list-group-item-heading count">
                                    <strong id="enviados">Aún no ha iniciado ningún envio</strong></h4>
                                <p class="list-group-item-text">
                                    Enviados ahora mismo</p>
                            </a>
                            <a href="#" class="list-group-item twitter">
                                <h3 class="pull-right">
                                  <i class="fa fa-history" aria-hidden="true"></i>
                                </h3>
                                <h4 class="list-group-item-heading count">
                                    <strong>{{info.no_enviado}}</strong></h4>
                                <p class="list-group-item-text">
                                   Por enviar</p>
                            </a>
                           <a href="#" class="list-group-item facebook-like">
                                <h3 class="pull-right">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </h3>
                                <h4 class="list-group-item-heading count">
                                    <strong>{{info.enviado}}</strong></h4>
                                <p class="list-group-item-text">
                                   Enviados</p>
                            </a>
                        
    
                    </div>
            </div>
            
        </div>
            
      
    
        </div>
    </div>
    <footer>
        <span>2016 SIAISA</span>
    </footer>

    <script src="../js/vendor/wow.min.js"></script>
    <script src="../js/vendor/jquery-1.11.2.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>
    <script src="../js/angular/controladores/envioCtrl.js?id=1.0"></script>
    <script>
       
    </script>
</body>

</html>
        <span id="result">
            
        </span>
      
  
