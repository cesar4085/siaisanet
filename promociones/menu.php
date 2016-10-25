<!doctype html>
<html class="no-js" lang="" ng-app="menuApp">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SIAISA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css?id=1.0">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/menu-admin.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body ng-controller="menuCtrl"> 
    <div id="menu" class="panel" role="navigation">
        <ul>

            <li><a href="layout/"><span class="fa fa-upload fa-2x nav-icon"></span>Cargar Layout.</a>
            </li>
            <li><a href="envio/"><span class="fa fa-paper-plane fa-2x nav-icon"></span>Enviar Email.</a>
            </li>
            <li><a href="respuesta/"><span class="fa fa-inbox fa-2x nav-icon"></span>Bandeja de entrada</a>
            </li>
            <li><a href="pre-calificados/"><span class="fa  fa-user fa-2x nav-icon"></span>Precalficados</a>
            </li>
            <li><a href="http://precalificado-busqueda.azurewebsites.net/" target="_blank"><span class="fa fa-search fa-2x nav-icon"></span>Búsqueda</a></li>
            <li><a href="reporte.php?tipo=ReporteGeneral&amp;id_segmento={{cache.selectedSegmento}}"><span class="fa fa-file-excel-o fa-2x nav-icon"></span>Reporte General.</a>
            </li>
            <li><a href="logout.php"><span class="fa fa-sign-out fa-2x nav-icon"></span>Cerrar Sesión.</a>
            </li>
            
            
        </ul>

    </div>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <!--TODO modificar estilo en responsive-->
                <a href="#menu" style="color: white; margin-top: 10px" class="menu-link pull-left navbar-brand">
                    <span>
                          <i class="fa fa-bars fa-1x" aria-hidden="true"></i>
                         
                      </span>

                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a id="email" href="respuesta/" class="navbar-brand" target="blank" style="font-size: 12px;"><i class="fa  fa-envelope-o fa-2x"></i><span  class="badge"></span></a>


                </ul>
            </div>



    </nav>
     <div class="centro-loader" ng-hide="cache.complete">
            <img src="img/rolling.svg" alt="loader" />
    </div>
    <div class="col-md-12" style="padding-top: 80px">
        <select id="info" ng-model="dashboard" ng-change="onChangeDashboard()" style="margin-left: 30px">
            <option value="0" ng-selected="true">EMAILING</option>
             <option value="1">PRECALIFICADOS</option>
        </select>
    
        <ng-include  src="src"></ng-include>
    </div>
    
    <script src="js/vendor/wow.min.js"></script>
    <script src="js/vendor/jquery-1.11.2.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/vendor/bigSlide.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.menu-link').bigSlide({
                easyClose: true
            });
            $("#menu").css("visibility", "visible");
        });
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>
    <script src="https://jtblin.github.io/angular-chart.js/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="http://cdn.jsdelivr.net/angular.chartjs/latest/angular-chart.min.js"></script>
    <script src="js/angular/controladores/menuCtrl.js?id=1.2.6"></script>
    <script src="js/jquery.blockUI.js"></script>

</body>

</html>