<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html class="no-js" lang="" ng-app="app"> <!--<![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="Violate Responsive Admin Template">
        <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

        <title>SIAISA</title>
            
        <!-- CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/animate.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/form.css" rel="stylesheet">
        <link href="../css/calendar.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/icons.css" rel="stylesheet">
        <link href="../css/generics.css" rel="stylesheet"> 
        
    </head>
    <body id="skin-blur-blue" >
 <?php
                require_once '../php/model/MenuModel.php';
                $menu = new MenuModel();
         ?>
        <header id="header" class="media">
            <a href="" id="menu-toggle"></a> 
            <a class="logo pull-left" href="../menu"> <?php echo strtoupper($menu->imprimirNombre());   ?></a>
            
            <div class="media-body">
                <div class="media" id="top-menu">
                    <div class="pull-left tm-icon">
                        <a data-drawer="messages" class="drawer-toggle" href="">
                            <i class="sa-top-message"></i>
                            <i class="n-count animated">5</i>
                            <span>Mensajes</span>
                        </a>
                    </div>
                    <div class="pull-left tm-icon">
                        <a data-drawer="notifications" class="drawer-toggle" href="">
                            <i class="sa-top-updates"></i>
                            <i class="n-count animated">9</i>
                            <span>Tareas</span>
                        </a>
                    </div>

                    

                    <div id="time" class="pull-right">
                        <span id="hours"></span>
                        :
                        <span id="min"></span>
                        :
                        <span id="sec"></span>
                    </div>
                    
                    <div class="media-body">
                        <input type="text" class="main-search">
                    </div>
                </div>
            </div>
        </header>
        
        <div class="clearfix"></div>
        
        <section id="main" class="p-relative" role="main">
            
            <!-- Sidebar -->
            <aside id="sidebar">
                
                <!-- Sidbar Widgets -->
                <div class="side-widgets overflow">
                    <!-- Profile Menu -->
                    <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
                        <a href="" data-toggle="dropdown">
                            <img class="profile-pic animated" src="../img/profile-pic.jpg" alt="">
                        </a>
                        <ul class="dropdown-menu profile-menu">
                            <li><a href="">Mi cuenta</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="">Mensajes</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="">Configuraciones</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                            <li><a href="../logout.php">Cerrar Sesion</a> <i class="icon left">&#61903;</i><i class="icon right">&#61815;</i></li>
                        </ul>
                        <h4 class="m-0"> <?php echo strtoupper($menu->imprimirNombre());   ?></h4>
                        magui.orozco@gmail.com
                    </div>
                    
                    <!-- Calendar -->
                    <div class="s-widget m-b-25">
                        <div id="sidebar-calendar"></div>
                    </div>
                    
                    <!-- Feeds -->
                    <div class="s-widget m-b-25">
                        <h2 class="tile-title">
                           Tareas Pendientes
                        </h2>
                        
                        <div class="s-widget-body">
                            <div id="news-feed1">
<ul>
    <li><a href="https://freedcamp.com/victors_Projects_o0B/SMS_CPT/todos/7202951">vista de sistema sms y login</a></li>
    <li><a href="https://freedcamp.com/victors_Projects_o0B/Modulo_de_Clien_pyg/todos/7137654">reporte Gral Precalificados</a></li>
    <li><a href="https://freedcamp.com/victors_Projects_o0B/Modulo_de_Clien_pyg/todos/7147213">cargas de bd (sms / emailing) ordenar por num de carga para tocar todas las bases</a></li>
    <li><a href="https://freedcamp.com/victors_Projects_o0B/Modulo_de_Clien_pyg/todos/7147182">Panel de supervisor (productividad de los asesores) y graficas de productividad</a></li>
</ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Projects -->
                    <div class="s-widget m-b-25">
                        <h2 class="tile-title">
                            Proyectos 
                        </h2>
                        
                        <div class="s-widget-body">
                            <div class="side-border">
                                <small>Estudio de Mercado Financiera</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="progress-bar tooltips progress-bar-danger" style="width: 60%;" data-original-title="60%">
                                          <span class="sr-only">60% Completado</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>Cuestionarios Infra</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-info" style="width: 43%;" data-original-title="43%">
                                          <span class="sr-only">43% Completado</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>Estudio Financierio</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-warning" style="width: 81%;" data-original-title="81%">
                                          <span class="sr-only">81% Completado</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>Estudio Economico</small>
                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 10%;" data-original-title="10%">
                                          <span class="sr-only">10% Completado</span>
                                     </a>
                                </div>
                            </div>
                            <div class="side-border">
                                <small>CEstudio Crediticio</small>

                                <div class="progress progress-small">
                                     <a href="#" data-toggle="tooltip" title="" class="tooltips progress-bar progress-bar-success" style="width: 95%;" data-original-title="95%">
                                          <span class="sr-only">95% Completado</span>
                                     </a>
                                </div>

                            </div>
  
                        </div>
                    </div>
                </div>
                
                

                
                <!-- Side Menu -->
                <ul class="list-unstyled side-menu">
                    <li class="active">
                        <a class="sa-side-home" href="../menu/">
                            <span class="menu-item">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="sa-side-typography" href="">
                            <span class="menu-item">Encuestas</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="../encuestas/">Realizar Encuesta</a></li>
                            <li><a href="../layouts/encuesta">Cargar Base de Datos</a></li>
                             <li><a href="">Reporte Citas</a></li>  
                             <li><a href="">Reporte Invalidos</a></li> 
                            <li><a href="">Reporte General</a></li>                            
                        </ul>
                    </li>
                   <li class="dropdown">
                        <a class="sa-side-widget" href="../cobranza/">
                            <span class="menu-item">Cobranza</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="../cobranza/">Realizar Cobranza</a></li>
                            <li><a href="../layouts/cobranza">Cargar Base de Datos</a></li>
                            <li><a href="">Reporte General</a></li>                            
                        </ul>
                    </li>   
                   <li class="dropdown">
                        <a class="sa-side-table" href="">
                            <span class="menu-item">Chat</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="../chat/">Registrar Chat</a></li>
                            <li><a href="../chat/">Reportes</a><ul class="list-unstyled menu-item">
                                                       
                            <li><a href="../reporte.php?tipo=ReporteChatHoy">Reporte Hoy</a></li>                            
                            <li><a href="../reporte.php?tipo=ReporteChatMes">Reporte Mes</a></li> 
                            <li><a href="../reporte.php?tipo=ReporteChatFiltro">Reporte Filtro</a></li> 
                            <li><a href="../reporte.php?tipo=ReporteChatGeneral">Reporte General</a></li> 
                            </ul>
                        </ul>
                    </li>  
                    <li class="dropdown">
                        <a class="sa-side-table" href="">
                            <span class="menu-item">Captura</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="../captura/">Realizar Captura</a></li>    
                            <li><a href="../layouts/captura">Cargar Base de Datos</a></li>                        
                            <li><a href="">Reporte General</a></li>                            
                        </ul>
                    </li>               
                    <li class="dropdown">
                        <a class="sa-side-page" href="">
                            <span class="menu-item">Precalificados</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="../precalificados/">Realizar Captura</a></li>    
                            <li><a href="../layouts/precalificados">Cargar Base de Datos</a></li>                        
                            <li><a href="">Reporte General</a></li>                            
                        </ul>
                    </li>    
                       <li class="dropdown">
                        <a class="sa-side-page" href="">
                            <span class="menu-item">Mailing</span>
                        </a>
                        <ul class="list-unstyled menu-item">
                            <li><a href="../mailing/">Realizar Envio</a></li>    
                            <li><a href="../layouts/mailing">Cargar Base de Datos</a></li>                        
                            <li><a href="">Reporte General</a></li>                            
                        </ul>
                    </li>               
               
                   
                    
                        <a class="sa-side-folder" href="file-manager.html">
                            <span class="menu-item">Cargar Datos</span>
                        </a>
                    </li>
                    <li>
                        <a class="sa-side-calendar" href="../calendarioo">
                            <span class="menu-item">Calendario</span>
                        </a>
                    </li>
                    
                </ul>

            </aside>
        
            <!-- Content -->
            <section id="content" class="container">
            
                <!-- Messages Drawer -->
             <div id="messages" class="tile drawer animated">
                    <div class="listview narrow">
                        <div class="media">
                            <a href="">Enviar Nuevo Mensaje</a>
                            <span class="drawer-close">&times;</span>
                            
                        </div>
                        <div class="overflow" style="height: 254px">
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Michael Jackson - 2 Hours ago</small><br>
                                    <a class="t-overflow" href="">hi hello</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Juan Gabriel - 5 Hours ago</small><br>
                                    <a class="t-overflow" href="">todo es mejor en la frontera</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/3.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Alejandro cabazos - el 15/12/2013</small><br>
                                    <a class="t-overflow" href="">faltan 5 min para cerrar e irme, se me olvido pedirle el reporte lo tendra en esos 5 min?</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/4.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Sandy Sandoval - el 14/12/2013</small><br>
                                    <a class="t-overflow" href="">Hola</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Susana diosdado- el 15/12/2013</small><br>
                                    <a class="t-overflow" href="">reporte 3</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Felipe Calderon- el 16/12/2013</small><br>
                                    <a class="t-overflow" href="">buen trabajo</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/3.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Victor ORtiz - el 17/12/2013</small><br>
                                    <a class="t-overflow" href="">asi es esto</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/4.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Sandy Sandoval - el 18/12/2013</small><br>
                                    <a class="t-overflow" href="">reporte.</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/5.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Susana Diosdado - el 19/12/2013</small><br>
                                    <a class="t-overflow" href="">reporte</a>
                                </div>
                            </div>
                        </div>
                        <div class="media text-center whiter l-100">
                            <a href=""><small>VER TODAS</small></a>
                        </div>
                    </div>
                </div>
                
                <!-- Notification Drawer -->
                <div id="notifications" class="tile drawer animated">
                    <div class="listview narrow">
                        <div class="media">
                            <a href="">Configuracion Notificaciones</a>
                            <span class="drawer-close">&times;</span>
                        </div>
                        <div class="overflow" style="height: 254px">
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Michael Jackson - 2 Horas antes</small><br>
                                    <a class="t-overflow" href="">Listo</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Felipe Calderon - 5 Horas antes</small><br>
                                    <a class="t-overflow" href="">Gran trabajo son un orgullo p</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/3.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Sandy Sandoval - El 15/12/2013</small><br>
                                    <a class="t-overflow" href="">Hola</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/4.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Sandy Sandoval - El 14/12/2013</small><br>
                                    <a class="t-overflow" href="">Hola.</a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/1.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Michael Jackson - El 15/12/2013</small><br>
                                    <a class="t-overflow" href=""></a>
                                </div>
                            </div>
                            <div class="media">
                                <div class="pull-left">
                                    <img width="40" src="../img/profile-pics/2.jpg" alt="">
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Felipe Calderon - El 16/12/2013</small><br>
                                    <a class="t-overflow" href="">hey</a>
                                </div>
                            </div>
                        </div>
                        <div class="media text-center whiter l-100">
                            <a href=""><small>VER TODO</small></a>
                        </div>
                    </div>
                </div>
                <!-- Breadcrumb -->
                <ol class="breadcrumb hidden-xs">
                    <li><a href="#">Dashboard</a></li>
                    <li class="active">Datos</li>
                </ol>
                
                <h4 class="page-title">DASHBOARD</h4>
                                
                <!-- Shortcuts -->
                <div class="block-area shortcut-area">
                    <a class="shortcut tile" href="">
                        <img src="../img/shortcuts/money.png" alt="">
                        <small class="t-overflow">Ventas</small>
                    </a>
               
                    <a class="shortcut tile" href="">
                        <img src="../img/shortcuts/calendar.png" alt="">
                        <small class="t-overflow">Calendario</small>
                    </a>
                    <a class="shortcut tile" href="">
                        <img src="../img/shortcuts/stats.png" alt="">
                        <small class="t-overflow">Estadisticas</small>
                    </a>
                    <a class="shortcut tile" href="">
                        <img src="../img/shortcuts/connections.png" alt="">
                        <small class="t-overflow">Conexiones clientes</small>
                    </a>
                    <a class="shortcut tile" href="">
                        <img src="../img/shortcuts/reports.png" alt="">
                        <small class="t-overflow">Reportes</small>
                    </a>
                </div>
                
                <hr class="whiter" />
                
               
               
                
               
                <!-- Quick Stats -->

                <div class="block-area">
                    <div class="row">
                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats">
                                <div id="stats-line-2" class="pull-left"></div>
                                <div class="data">
                                    <h2 data-value="98">0</h2>
                                    <small>Capturas hasta hoy</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">
                                <div id="stats-line-3" class="pull-left"></div>
                                <div class="media-body">
                                    <h2 data-value="1452">0</h2>
                                    <small>Encuestas Asignadas</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">

                                <div id="stats-line-4" class="pull-left"></div>

                                <div class="media-body">
                                    <h2 data-value="4896">0</h2>
                                    <small>Revisadas</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="tile quick-stats media">
                                <div id="stats-line" class="pull-left"></div>
                                <div class="media-body">
                                    <h2 data-value="29356">0</h2>
                                    <small>Total Gestionadas.</small>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <hr class="whiter" />
                
                <!-- Main Widgets -->
               
                <div class="block-area">
                    <div class="row">
                        <div class="col-md-8">
                             <!-- Informacion  encuestas-->
                            <div class="tile text-center" ng-controller="menuCtrl">
                                <div >
                                <div class="tile-dark p-10">
                                      <h1>Encuestas</h1>
                                     <div class="row">
                                        <div class="col-md-1 col-xs-3">
                                            
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <div class="tile quick-stats media">
                                                <div id="stats-line" class="pull-left"></div>
                                                <div class="media-body">
                                                    <h2 >{{info._asignadas}}</h2>
                                                    <small> Total Asignadas.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <div class="tile quick-stats media">
                                                <div id="stats-line" class="pull-left"></div>
                                                <div class="media-body">
                                                    <h2 >{{info._cola}}</h2>
                                                    <small>En cola</small>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-3 col-xs-6">
                                            <div class="tile quick-stats media">
                                                <div id="stats-line" class="pull-left"></div>
                                                <div class="media-body">
                                                    <h2 >{{info._llamadas}}  </h2><h5 style="
    text-align: right;
    margin-right: 15px;">({{info._vueltas|number:2}} vueltas) </h5>
                                                    <small>Llamadas Realizadas.</small>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-1 col-xs-3">
                                            
                                        </div>
                                    </div> 
                                  
                                    <div class="pie-chart-tiny" /*data-percent="86"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._contactadas}}</h2> Contactos<i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" /*data-percent="23"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._citas}}</h2>  Citas  <i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" /*data-percent="57"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._fuera_servicio}}</h2> Fuera servicio<i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" /*data-percent="6"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._invalidos}}</h2>  Invalidos <i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" /*data-percent= "1"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._quejas}}</h2> Quejas <a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>
                                </div>
                                 <div class="block-area" id="collapse">
                                        
                    <div class="accordion tile">
                        <div class="panel-group block" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                           Detalles Encuesta
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                            
                                                                  
                                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="col-md-4 no-padding hidden-xs">
                                                             <input id='inputInicio' placeholder="Fecha inicio" class='input form-control input-sm'  />       
                                                         </div>
                                                         <div class="col-md-4 no-padding hidden-xs">
                                                              <input id='inputFin' placeholder="Fecha fin" class='input form-control input-sm'  />      
                                                         </div>
                                                         <div class="col-md-4 no-padding hidden-xs">
                                                             <a class="btn btn-danger btn-block btn-sm" ng-click="onFiltrar()">{{filtrarText}}</a>   
                                                         </div>   
                                                   </div>
                                                                    <div class="col-md-12">
                                                         <table  id="tablaReporte" class=" table table-responsive table-striped table-bordered">
                                                          <thead>
                                                              <tr>
                                                                  <th>N°</th>
                                                                  <th>Agente</th>
                                                                  <th>Llamadas</th>
                                                                  <th>Contactos</th>
                                                                  <th>Citas</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                              <tr ng-repeat="agente in list_monitoreo">
                                                                <td>{{$index+1}}</td>
                                                                <td>{{agente.nombre|uppercase}}</td>
                                                                <td>{{agente.total_contactados}}</td>
                                                                <td>{{agente.contactados}}</td>   
                                                                <td>{{agente.citas}}</td>
                                                             </tr>
                                                             <tr>
                                                                <td></td>
                                                                <td><strong>TOTAL:</strong></td>
                                                                <td><strong>{{total_llamadas}}</strong></td>
                                                                <td><strong>{{total_contactados}}</strong> </td> 
                                                                <td><strong>{{total_citas}}</strong></td>
                                                            </tr>
                                                          </tbody>
                                                      </table>  
                                                       </div>
                                                      
                                                    </div>
                                    </div>
                                </div>
                            </div>
                           
                          
                        </div>
                    </div>
                </div>
                              <div class="clearfix"></div>                                  
                            </div>
                                        <!-- Informacion Precalificados -->
                            <div class="tile text-center">
                                <div class="tile-dark p-10">
                                    <h1>Precalificados</h1>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6">
                                            <div class="tile quick-stats media">
                                                <div id="stats-line" class="pull-left"></div>
                                                <div class="media-body">
                                                    <h2 data-value="29356">0</h2>
                                                    <small>Total Gestionadas.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-6">
                                            <div class="tile quick-stats media">
                                                <div id="stats-line" class="pull-left"></div>
                                                <div class="media-body">
                                                    <h2 data-value="29356">0</h2>
                                                    <small>Total Gestionadas.</small>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-3 col-xs-6">
                                            <div class="tile quick-stats media">
                                                <div id="stats-line" class="pull-left"></div>
                                                <div class="media-body">
                                                    <h2 data-value="29356">0</h2>
                                                    <small>Total Gestionadas.</small>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-3 col-xs-6">
                                            <div class="tile quick-stats media">
                                                <div id="stats-line" class="pull-left"></div>
                                                <div class="media-body">
                                                    <h2 data-value="29356">0</h2>
                                                    <small>Total Gestionadas.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="pie-chart-tiny" data-percent="860">
                                        <span class="percent"></span>
                                        <span class="pie-title">Aprobadas <a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>
                                    <div class="pie-chart-tiny" data-percent="23">
                                        <span class="percent"></span>
                                        <span class="pie-title">Invalidas<a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>

                                    <div class="pie-chart-tiny" data-percent="57">
                                        <span class="percent"></span>
                                        <span class="pie-title">Rechazadas<a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>
                                    <div class="pie-chart-tiny" data-percent="34">
                                        <span class="percent"></span>
                                        <span class="pie-title">Revisiones <a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>
                                    <div class="pie-chart-tiny" data-percent="81">
                                        <span class="percent"></span>
                                        <span class="pie-title">Renovaciones <a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>

                                    </div>
<div class="block-area" id="collapse">
                    <div class="accordion tile">
                        <div class="panel-group block" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle active" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                           Detalles Precalificados
                                        </a>
                                    </h3>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                            
                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>                        
                                                        
                                                      
                                         </div>
                                    </div>
                                </div>
                            </div>                   
                        </div>
                    </div>
                    <div class="clearfix"></div> 
                                </div>
                
                            </div>
                 <!-- Informacion chat -->
                            <div class="tile text-center" ng-controller ="chatMenuCtrl">
                                <div class="tile-dark p-10">
                                    <h1>Chat</h1>
                                     <div class="row">
                                    <div class="col-md-3 col-xs-0"> </div>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="tile quick-stats media">
                                            <div id="stats-line" class="pull-left"></div>
                                            <div class="media-body">
                                                <h2 >{{info._total_chats}}</h2>
                                                <small>{{info._total_chats}} Total Chats Recibidos.<a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="tile quick-stats media">
                                            <div id="stats-line" class="pull-rigth"></div>
                                            <div class="media-body">
                                                <h2 >{{info._total_chats_hoy}}</h2>
                                                <small> {{info._total_chats_hoy}} Total Atendidos Hoy.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-0"> </div>
                                   </div>                                    
                                    <div class="pie-chart-tiny" /*data-percent="10.37"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._abandono}}</h2> Abandonados<a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>
                                    <div class="pie-chart-tiny" /*data-percent="82.96"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._si_le_interesa}} </h2>  Si le interesa<a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a> </span>
                                    </div>
                                    <div class="pie-chart-tiny" /*data-percent="6.66"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2> {{info._no_le_interesa}} </h2>No le interesa <a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>
                                    <div class="pie-chart-tiny" /*data-percent="0"*/>
                                        <span class="percent"></span>
                                        <span class="pie-title"><h2>{{info._no_es_el_titular}} </h2>No es titular <a href="hol.html"><i class="m-l-5 fa fa-retweet"></i></a></span>
                                    </div>                                 
                                </div>
                            </div>
                              <!-- Informacion emailing 
                            <div class="tile text-center">
                                <div class="tile-dark p-10">
                                    <h1>Emailing</h1>
                                     <div class="row">
                                    <div class="col-md-3 col-xs-0"> </div>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="tile quick-stats media">
                                            <div id="stats-line" class="pull-left"></div>
                                            <div class="media-body">
                                                <h2 data-value="29356">0</h2>
                                                <small>Total Gestionadas.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="tile quick-stats media">
                                            <div id="stats-line" class="pull-left"></div>
                                            <div class="media-body">
                                                <h2 data-value="29356">0</h2>
                                                <small>Total Gestionadas.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-0"> </div>
                                   </div>
                                    <div class="pie-chart-tiny" data-percent="95">
                                        <span class="percent"></span>
                                        <span class="pie-title"> 78Atendidos <i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" data-percent="5">
                                        <span class="percent"></span>
                                        <span class="pie-title">Abandonados<i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" data-percent="57">
                                        <span class="percent"></span>
                                        <span class="pie-title">Si le interesa <i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" data-percent="34">
                                        <span class="percent"></span>
                                        <span class="pie-title">No le interesa <i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>
                                    <div class="pie-chart-tiny" data-percent="81">
                                        <span class="percent"></span>
                                        <span class="pie-title">No es titular <i class="m-l-5 fa fa-retweet"></i></span>
                                    </div>                                 
                                </div>
                            </div>-->
                            <!-- Main Chart -->
                            <div class="tile">
                                <h2 class="tile-title">Estadisticas</h2>
                                <div class="tile-config dropdown">
                                    <a data-toggle="dropdown" href="" class="tile-menu"></a>
                                    <ul class="dropdown-menu pull-right text-right">
                                        <li><a class="tile-info-toggle" href="">Chart Information</a></li>
                                        <li><a href="">Actualizar</a></li>
                                        <li><a href="">Configuraciones</a></li>
                                    </ul>
                                </div>
                                <div class="p-10">
                                    <div id="line-chart" class="main-chart" style="height: 250px"></div>

                                    <div class="chart-info">
                                        <ul class="list-unstyled">
                                            <li class="m-b-10">
                                                Total Encuestas  1200
                                                <span class="pull-right text-muted t-s-0">
                                                    <i class="fa fa-chevron-up"></i>
                                                    +12%
                                                </span>
                                            </li>
                                            <li>
                                                <small>
                                                    Aprobadas 640
                                                    <span class="pull-right text-muted t-s-0"><i class="fa m-l-15 fa-chevron-down"></i> -8%</span>
                                                </small>
                                                <div class="progress progress-small">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                                </div>
                                            </li>
                                            <li>
                                                <small>
                                                    Rechazadas 560
                                                    <span class="pull-right text-muted t-s-0">
                                                        <i class="fa m-l-15 fa-chevron-up"></i>
                                                        -3%
                                                    </span>
                                                </small>
                                                <div class="progress progress-small">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>  
                            </div>
    
                           
                            <!--  Recent Postings -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="tile">
                                        <h2 class="tile-title">Clientes</h2>
                                        <div class="tile-config dropdown">
                                            <a data-toggle="dropdown" href="" class="tile-menu"></a>
                                            <ul class="dropdown-menu animated pull-right text-right">
                                                <li><a href="">Actualizar</a></li>
                                                <li><a href="">Configuraciones</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="listview narrow">
                                            <div class="media p-l-5">
                                                <div class="pull-left">
                                                    <img width="40" src="../img/profile-pics/1.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <small class="text-muted">Hace 2 Horas  por Adrian Sanchez</small><br/>
                                                    <a class="t-overflow" href="">Gestioname las demas cuentas</a>
                                                   
                                                </div>
                                            </div>
                                            <div class="media p-l-5">
                                                <div class="pull-left">
                                                    <img width="40" src="../img/profile-pics/2.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <small class="text-muted">Hace 5 Horas por David Villa</small><br/>
                                                    <a class="t-overflow" href="">Gracias por el </a>
                                                    
                                                </div>
                                            </div>
                                            <div class="media p-l-5">
                                                <div class="pull-left">
                                                    <img width="40" src="../img/profile-pics/3.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <small class="text-muted">El 11/03/2016 por Alejandro Calabazos</small><br/>
                                                    <a class="t-overflow" href="">Pendiente reporte de inscritos</a>
                                                    
                                                </div>
                                            </div>
                                            <div class="media p-l-5">
                                                <div class="pull-left">
                                                    <img width="40" src="../img/profile-pics/4.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <small class="text-muted">On 14/12/2013 by Mitch bradberry</small><br/>
                                                    <a class="t-overflow" href="">Cras pulvinar euismod nunc quis gravida. </a>
                                                    
                                                </div>
                                            </div>
                                            <div class="media p-l-5">
                                                <div class="pull-left">
                                                    <img width="40" src="../img/profile-pics/5.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <small class="text-muted">On 13/12/2013 by Mitch bradberry</small><br/>
                                                    <a class="t-overflow" href="">Integer a eros dapibus, vehicula quam accumsan, tincidunt purus</a>
                                                    
                                                </div>
                                            </div>
                                            <div class="media p-5 text-center l-100">
                                                <a href=""><small>VIEW ALL</small></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Tasks to do -->
                                <div class="col-md-6">
                                    <div class="tile">
                                        <h2 class="tile-title">TAREAS PENDIENTES</h2>
                                        <div class="tile-config dropdown">
                                            <a data-toggle="dropdown" href="" class="tile-menu"></a>
                                            <ul class="dropdown-menu pull-right text-right">
                                                <li id="todo-add"><a href="">Agregar Nueva</a></li>
                                                <li id="todo-refresh"><a href="">Actualizar</a></li>
                                                <li id="todo-clear"><a href="">Limpiar todas</a></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="listview todo-list sortable">
                                            <div class="media">
                                                <div class="checkbox m-0">
                                                    <label class="t-overflow">
                                                        <input type="checkbox">
                                                        Generar vistas en sql
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="checkbox m-0">
                                                    <label class="t-overflow">
                                                        <input type="checkbox">
                                                        Actualizar panel de resultados
                                                    </label>
                                                </div>
                                                
                                            </div>
                                            <div class="media">
                                                <div class="checkbox m-0">
                                                    <label class="t-overflow">
                                                        <input type="checkbox">
                                                        Crear formulario para el opt-in
                                                    </label>
                                                </div>
                                                
                                            </div>
                                            <div class="media">
                                                <div class="checkbox m-0">
                                                    <label class="t-overflow">
                                                        <input type="checkbox">
                                                        Modificar vistas sql para que acepte segmento como parametro
                                                    </label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                        <h2 class="tile-title">Tareas Completadas</h2>
                                        
                                        <div class="listview todo-list sortable">
                                            <div class="media">
                                                <div class="checkbox m-0">
                                                    <label class="t-overflow">
                                                        <input type="checkbox" checked="checked">
                                                        Filtro de reportes por segmento
                                                    </label>
                                                </div>
                                                
                                            </div>
                                            <div class="media">
                                                <div class="checkbox m-0">
                                                    <label class="t-overflow">
                                                        <input type="checkbox" checked="checked">
                                                         gráficas y los reportes por segmentos
                                                    </label>
                                                </div>
                                                
                                            </div>stat
                                            <div class="media">
                                                <div class="checkbox m-0">
                                                    <label class="t-overflow">
                                                        <input type="checkbox" checked="checked">
                                                        Modificar reporte general
                                                    </label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Actividad -->
                            <div >
                           

                           
           <!-- Dynamic Chart -->

 

                            <div class="tile">
                                <h2 class="tile-title">PROCESO</h2>
                                <div class="tile-config dropdown">
                                    <a data-toggle="dropdown" href="" class="tile-menu"></a>
                                    <ul class="dropdown-menu pull-right text-right">
                                        <li><a href="">Actualizar</a></li>
                                        <li><a href="">Settings</a></li>
                                    </ul>
                                </div>

                                <div class="p-t-10 p-r-5 p-b-5">
                                    <div id="dynamic-chart" style="height: 200px"></div>
                                </div>

                            </div>
                            
                            <!-- World Map -->
                            <div class="tile">
                                <h2 class="tile-title">ESTADOS</h2>
                                <div class="tile-config dropdown">
                                    
                                    <a data-toggle="dropdown" href="" class="tile-menu"></a>
                                    <ul class="dropdown-menu pull-right text-right">
                                        <li><a href="">Actualizar</a></li>
                                        <li><a href="">Configuraciones</a></li>
                                    </ul>
                                </div>
                                
                                <div id="world-map" style="height: 400px"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                
                <!-- Chat 
                <div class="chat">
                    
                   
                    <div class="pull-left chat-list">
                        <div class="listview narrow">
                            <div class="media">
                                <img class="pull-left" src="../img/profile-pics/1.jpg" width="30" alt="">
                                <div class="media-body p-t-5">
                                    Alex Bendit
                                </div>
                            </div>
                            <div class="media">
                                <img class="pull-left" src="../img/profile-pics/2.jpg" width="30" alt="">
                                <div class="media-body">
                                    <span class="t-overflow p-t-5">David Volla Watkinson</span>
                                </div>
                            </div>
                            <div class="media">
                                <img class="pull-left" src="../img/profile-pics/3.jpg" width="30" alt="">
                                <div class="media-body">
                                    <span class="t-overflow p-t-5">Mitchell Christein</span>
                                </div>
                            </div>
                            <div class="media">
                                <img class="pull-left" src="../img/profile-pics/4.jpg" width="30" alt="">
                                <div class="media-body">
                                    <span class="t-overflow p-t-5">Wayne Parnell</span>
                                </div>
                            </div>
                            <div class="media">
                                <img class="pull-left" src="../img/profile-pics/5.jpg" width="30" alt="">
                                <div class="media-body">
                                    <span class="t-overflow p-t-5">Melina April</span>
                                </div>
                            </div>
                            <div class="media">
                                <img class="pull-left" src="../img/profile-pics/6.jpg" width="30" alt="">
                                <div class="media-body">
                                    <span class="t-overflow p-t-5">Ford Harnson</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    Chat Area 
                    <div class="media-body">
                        <div class="chat-header">
                            <a class="btn btn-sm" href="">
                                <i class="fa fa-circle-o status m-r-5"></i> Chat with Friends
                            </a>
                        </div>
                    
                        <div class="chat-body">
                            <div class="media">
                                <img class="pull-right" src="../img/profile-pics/1.jpg" width="30" alt="" />
                                <div class="media-body pull-right">
                                    Hiiii<br/>
                                    How you doing bro?
                                    <small>Me - 10 Mins ago</small>
                                </div>
                            </div>
                            
                            <div class="media pull-left">
                                <img class="pull-left" src="../img/profile-pics/2.jpg" width="30" alt="" />
                                <div class="media-body">
                                    I'm doing well buddy. <br/>How do you do?
                                    <small>David - 9 Mins ago</small>
                                </div>
                            </div>
                            
                            <div class="media pull-right">
                                <img class="pull-right" src="../img/profile-pics/2.jpg" width="30" alt="" />
                                <div class="media-body">
                                    I'm Fine bro <br/>Thank you for asking
                                    <small>Me - 8 Mins ago</small>
                                </div>
                            </div>
                            
                            <div class="media pull-right">
                                <img class="pull-right" src="../img/profile-pics/2.jpg" width="30" alt="" />
                                <div class="media-body">
                                    Any idea for a hangout?
                                    <small>Me - 8 Mins ago</small>
                                </div>
                            </div>
                        
                        </div>
                    
                        <div class="chat-footer media">
                            <i class="chat-list-toggle pull-left fa fa-bars"></i>
                            <i class="pull-right fa fa-picture-o"></i> 
                            <div class="media-body">
                                <textarea class="form-control" placeholder="Type something..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>-->
            </section>

            <!-- Older IE Message -->
            <!--[if lt IE 9]>
                <div class="ie-block">
                    <h1 class="Ops">Ooops!</h1>
                    <p>You are using an outdated version of Internet Explorer, upgrade to any of the following web browser in order to access the maximum functionality of this website. </p>
                    <ul class="browsers">
                        <li>
                            <a href="https://www.google.com/intl/en/chrome/browser/">
                                <img src="../img/browsers/chrome.png" alt="">
                                <div>Google Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.mozilla.org/en-US/firefox/new/">
                                <img src="../img/browsers/firefox.png" alt="">
                                <div>Mozilla Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com/computer/windows">
                                <img src="../img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://safari.en.softonic.com/">
                                <img src="../img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/downloads/ie-10/worldwide-languages">
                                <img src="../img/browsers/ie.png" alt="">
                                <div>Internet Explorer(New)</div>
                            </a>
                        </li>
                    </ul>
                    <p>Upgrade your browser for a Safer and Faster web experience. <br/>Thank you for your patience...</p>
                </div>   
            <![endif]-->
        </section>
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script> <!-- jQuery Library -->
        <script src="../js/jquery-ui.min.js"></script> <!-- jQuery UI -->
        <script src="../js/jquery.easing.1.3.js"></script> <!-- jQuery Easing - Requirred for Lightbox + Pie Charts-->

        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Charts -->
        <script src="../js/charts/jquery.flot.js"></script> <!-- Flot Main -->
        <script src="../js/charts/jquery.flot.time.js"></script> <!-- Flot sub -->
        <script src="../js/charts/jquery.flot.animator.min.js"></script> <!-- Flot sub -->
        <script src="../js/charts/jquery.flot.resize.min.js"></script> <!-- Flot sub - for repaint when resizing the screen -->

        <script src="../js/sparkline.min.js"></script> <!-- Sparkline - Tiny charts -->
        <script src="../js/easypiechart.js"></script> <!-- EasyPieChart - Animated Pie Charts -->
        <script src="../js/charts.js"></script> <!-- All the above chart related functions -->

        <!-- Map -->
        <script src="../js/maps/jvectormap.min.js"></script> <!-- jVectorMap main library -->
        <script src="../js/maps/usa.js"></script> <!-- USA Map for jVectorMap -->
        <script src="../js/maps/world.js"></script>

        <!--  Form Related -->
        <script src="../js/icheck.js"></script> <!-- Custom Checkbox + Radio -->

        <!-- UX -->
        <script src="../js/scroll.min.js"></script> <!-- Custom Scrollbar -->

        <!-- Other -->
        <script src="../js/calendar.min.js"></script> <!-- Calendar -->
        <script src="../js/feeds.min.js"></script> <!-- News Feeds -->
        

        <!-- All  JS functions -->
        <script src="../js/functions.js"></script>
        <!-- Angular -->
        <script src="../js/vendor/wow.min.js"></script>
       <!-- Angular Material Library -->
   
       <script src="../js/vendor/bigSlide.min.js"></script>
       <script>
        $(document).ready(function() {
            $('.menu-link').bigSlide({
                easyClose:true
            });
            $("#menu").css("visibility","visible");
        });
    </script>
      <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
       <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
       <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
       <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>
       <script src="https://jtblin.github.io/angular-chart.js/node_modules/chart.js/dist/Chart.min.js"></script>
       <script src="http://cdn.jsdelivr.net/angular.chartjs/latest/angular-chart.min.js"></script>
       <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.3.js"></script>
        <script src="../js/vendor/rome.js"></script>
       <script src="../js/app.js?id=1.5.12"></script>
      
       <script src="../js/encuestas/menuCtrl.js?id=1.5.12"></script>
       <script src="../js/chat/chatMenuCtrl.js?id=1.5.12"></script>
    </body>
</html>