<!doctype html>
 <html class="no-js" lang="" ng-app="app"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>SIAISA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/animate.css">
    
        <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body ng-controller="menuCtrl">
        <?php
                require_once '../php/model/MenuModel.php';
                $menu = new MenuModel();
         ?>
         <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                  <a  class="navbar-brand animacion" href="#"><span><img src="../img/logo-siaisa.png" width="35" height="35"/></span>
                   <?php 
                           echo $menu->imprimirNombre();   
                           
                   ?>
                  </a>
              </div>
                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php">CERRAR SESIÓN</a></li>
                </ul> 
               
              </div>
   </nav>
        <!--  class="tile-progress tile-cyan, tile-green, tile-purple, tile-purple tile-pink"-->
        
            <div class="container-fluid" style="padding-top:100px">
           
                
           <div class="row">
                  <div class="col-md-6 col-sm-12" style="<?php echo "display:". ($menu->isAdmin()==true? "block":"none")?>">
                      <div>
                          <div class="col-md-12 col-sm-12">
                              <div class="col-md-8 col-sm-8 col-xs-8">
                                  <label>Contactación hoy</label>
                                  <br class="visible-xs">
                                  <select>
                                      <option>Encuesta</option>
                                      <option>Cobranza</option>
                                  </select>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4">
                                  <button type="button" ng-click="onUpdate()" class="btn btn-default btn-circle" style="margin-bottom:20px">
                                         <i class="glyphicon glyphicon-refresh"></i>
                                   </button>  
                              </div>
                            </div>
                          
                            <canvas id="bar"  class="chart chart-bar animacion"
                                    chart-data="data" chart-labels="labels"  chart-series="series">
                              </canvas> 
                          
                            <ng-include  src="'../html/menu_info.html'"></ng-include>
                        
                      </div>
                    
             </div>
               
           <?php if(!$menu->isFinanciera()):?> 
            <div class="col-md-6 col-sm-12">  
             <div class="row">
                   <div class="col-md-4 col-xs-6 contedor-espacio">
                       <a href="../encuesta/" class="btn btn-sq-lg btn-warning">
                          <i class="fa fa-list-ul fa-5x"></i>
                          <br/>
                          <br/>
                         Encuesta
                      </a>
                  </div>
                  <div class="col-md-4 col-xs-6 contedor-espacio">
                      <a href="contacto.html" class="btn btn-sq-lg btn-primary">
                          <i class="fa fa-calendar-check-o fa-5x"></i>
                          <br/>
                          <br/>
                         Cobranza
                      </a>
                  </div>
                 <div class="col-md-4 col-xs-6 contedor-espacio">
                     <a href="busqueda.php" class="btn btn-sq-lg btn-success">
                        <i class="fa fa-search fa-5x"></i>
                         <br/>
                         <br/>
                        Búsqueda
                      </a>
                 </div>
                 
                 <div class="col-md-4 col-xs-6 contedor-espacio" style="<?php echo "display:". ($menu->isAdmin()==true? "block":"none")?>">
                     <a href="alta_agente.php" class="btn btn-sq-lg btn-info">
                        <i class="fa fa-user-plus fa-5x"></i>
                        <br/>
                        <br/>
                        Alta de agente
                      </a>
               </div>     
                
                 
               <div class="col-md-4 col-xs-6 contedor-espacio"  style="<?php echo "display:". ($menu->isAdmin()==true? "block":"none")?>"  >
                      <a href="monitoreo.html" class="btn btn-sq-lg btn-danger">
                        <i class="fa fa-line-chart fa-5x"></i>
                        <br/>
                        <br/>
                        Monitoreo
                      </a>
               </div>  
               
                 <div class="col-md-4 col-xs-6 contedor-espacio" style="<?php echo "display:". ($menu->isAdmin()==true? "block":"none")?>">
                     <a href="layout.php" class="btn btn-sq-lg btn-success">
                         <i class="fa fa-file-excel-o fa-5x"></i>
                         <br>
                         <br>
                         Cargar layout
                     </a>
                 </div>
                 
              </div>

             </div>
           <?php endif?>
           
         
           </div>
         

        </div>

       

        <script src="..//vendor/wow.min.js"></script>
       <!-- Angular Material Library -->
       <script src="../js/vendor/jquery-1.11.2.js"></script>
       <script src="../js/vendor/bootstrap.min.js"></script>
     
      <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
       <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
       <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
       <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>
       <script src="https://jtblin.github.io/angular-chart.js/node_modules/chart.js/dist/Chart.min.js"></script>
       <script src="http://cdn.jsdelivr.net/angular.chartjs/latest/angular-chart.min.js"></script>
       <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.3.js"></script>
       <script src="../js/angular/app.js?id=1.5.10"></script>
       <script src="../js/angular/controladores/menuCtrl.js?id=1.5.10"></script>
       
    </body>
</html>