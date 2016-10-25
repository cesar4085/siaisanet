
<html class="no-js" lang="" ng-app="app">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>CARGAR LAYOUT ENCUESTA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootflat.min.css">
    <link rel="stylesheet" href="../css/main_menu.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/animate.css">
    <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body ng-controller="layoutCtrl" >
 
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand animacion" href="#"><span><img src="../img/logo-siaisa.png" width="35" height="35"/></span>
                   
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
            <div class="col-md-5">
                     
                   <div class="col-md-12">
                       <form ng-submit="analizar()">
                            <div class="form-group no-padding">    
                                <h4>Nota* El archivo debe ser .csv delimitado por comas</h4>
                                <img ng-show="isLoading"  src="../img/ellipsis.svg"/>
                                <input type="file" id="csv" name="csv" accept=".csv" class="filestyle" data-buttonText="Elegir archivo"/>
                                <br>
                                <div class="col-md-4">
                                     <input type="submit"  class="btn btn-danger btn-lg btn-block" value="Analizar  "/>
                                </div>
                                 <div class="col-md-4">
                                     <input type="button" ng-click="guardarBD()"   class="btn btn-danger btn-lg btn-block" value="Guardar en BD" ng-disabled="isEmpty()"/>
                                </div>
                                
                                <div class="col-md-4">
                                    <input type="button" ng-click="enviarMail()"   class="btn btn-danger btn-lg btn-block" value="Enviar email"/>
                                </div>
                                
                            </div>
                        </form>
                   </div>
                    <div class="col-md-12">
                        <h3 class="md-subhead">Selección</h3>
                         <pre>{{seleccion | json}}</pre>
                    </div>
            </div>
            <div class="col-md-7" ng-if="layoutCargado==true">
                        <div id="respuesta">
                            <h4>Relaciona las columnas de la BD con las de tu archivo </h4>
                            <h4>
                                Total de registros: <strong><i id="total" style="color: red">{{data.total}}</i></strong>

                            </h4>
                            <form name="form_seleccion">
                            <div class="form-group" ng-repeat="en in data.bd_encabezado">
                                <div class="row">
                                      <div class="col-md-6">
                                          <h3 class="md-subhead" style="color: red; text-transform: uppercase">{{en}}</h3>
                                       </div>
                                
                                        <div class="col-md-6">

                                            <select class="form-control" ng-model="seleccion[en]" >
                                                <option ng-value="#">ninguno</option>
                                                <option ng-repeat="op in data.encabezado track by $index"   ng-value="$index">
                                                    {{op}}
                                                </option>
                                            </select>
                                        </div>
                                </div>
                              
                            </div>
                          </form>
                                
                            </div>
                        </div>

                     </div>
            </div>
            
      
    
        </div>
    </div>
    <footer>
        <span>2016 SIAISA</span>
    </footer>

    <script src="../js/vendor/wow.min.js"></script>
    <!-- Angular Material Library -->
    <script src="../js/vendor/jquery-1.11.2.js"></script>
    <script src="../js/vendor/bootstrap.min.js"></script>
    <script src="../js/vendor/bootstrap-filestyle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>
    <script src="../js/angular/controladores/layoutCtrlEmail.js"></script>
    <script>
   
  
    </script>
</body>

</html>