<!DOCTYPE html>
<html class="no-js" lang="" ng-app="app">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>RESPUESTA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
 
    <link rel="stylesheet" href="../css/main_menu.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/mail.css">
    <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    
    
</head>

<body ng-controller="respuestaCtrl">
 <?php
                require_once '../php/Model/MenuModel.php'; 
                $menu=new MenuModel();
                $nombre=$menu->imprimirNombre()?>
               
 
 ?>
     <div class="modal fade" id="modalRespuesta" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">RESPUESTA DE EMAIL</h4>
                </div>
                   <div class="modal-body" style="overflow: visible;">
                        <div class="alert alert-danger" ng-if="mensajeError.length>0">
                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <span>{{mensajeError}}</span>
                       </div>
                       <div class="form-group">
                        <h3 class="md-subhead">Folio: <strong>{{currentEmail[0].folio}}</strong></h3>
                        <h3  class="md-subhead">Cliente:<strong>{{currentEmail[0].nombre}}</strong></h3>
                        <h3 class="md-subhead"><i>Selecciona el status de la respuesta</i></h3>
                        <label class="radio-inline" style="margin-left: 0px!important"><input ng-model="respuesta.status" value="1" type="radio" name="optradio">Si le interesa</label>
                        <label class="radio-inline" style="margin-left: 0px!important"><input ng-model="respuesta.status" value='0' type="radio" name="optradio">No le interesa</label>
                        <label class="radio-inline" style="margin-left: 0px!important"><input ng-model="respuesta.status" value="2" type="radio" name="optradio">Saldo deudor</label>
                        <label class="radio-inline" style="margin-left: 0px!important"><input ng-model="respuesta.status" value="3" type="radio" name="optradio">Cliente molesto</label>
                        <label class="radio-inline" style="margin-left: 0px!important"><input ng-model="respuesta.status" value="4" type="radio" name="optradio">Ya no es la cuenta del usuario</label>
                        <label class="radio-inline" style="margin-left: 0px!important"><input ng-model="respuesta.status" value="5" type="radio" name="optradio">Queja</label>
                        <br>
                        <br>
                        <textarea id="mensaje" class="form-control" ng-model="respuesta.mensaje" placeholder="Mensaje de respuesta"></textarea>
                       </div>
                       
                
                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-4">
                             <button type="button"  class="btn btn-red" data-dismiss="modal">CANCELAR ENVIO</button>  
                        </div>
                        <div class="col-md-8">
                            <button type="button"  class="btn btn-red"  ng-click="enviarRespuesta()">ENVIAR EMAIL</button>
                        </div>
                    </div>
                  
                  
                </div>

            </div>

        </div>
    </div>
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
                     <?php echo $nombre?>
                 </a>
            </div>
    
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../logout.php">CERRAR SESIÓN</a>
                    </li>
                </ul>

            </div>
    </nav>
    <div class="container-fluid" ng-cloak style="padding-top:100px">
        
          
                <div class="row">
                    <div class="col-sm-3 col-md-2">
                        <div class="btn-group">
                            <button type="button"  ng-click="onActualizar()" class="btn btn-default" data-toggle="tooltip" title="Refresh">
                                     <span class="fa fa-refresh"></span> Actualizar
                                 </button>
                         
                            </div>
                    </div>
                    <div class="col-sm-9 col-md-10">
 
                        <!-- Single button -->
                        <div class="pull-right">
                            <div class="btn-group btn-group-sm">
                                <button ng-click="onRespuesta()" type="button" class="btn btn-default">
                                    <span class="fa fa-reply"></span> Responder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                  
                    <div class="col-sm-6 col-md-6">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                            </span>Bandeja entrada ({{inboxCount}}) </a></li>
                            <li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>
                                Pendientes ({{pendienteCount}})</a></li>
                            <li><a href="#messages" data-toggle="tab"><span class="glyphicon glyphicon-tags"></span>
                                Atendidos ({{atendidoCount}}) </a></li>
                            <li><a href="#settings" data-toggle="tab"><span class="glyphicon glyphicon-plus no-margin">
                            </span></a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <div class="list-group">
                                   
                                    <a ng-click="clickEmaiInbox($index,inbox.uid_imap,inbox.id_inbox,true)" style="cursor: pointer" ng-repeat="inbox in inboxBandeja"  ng-show="inbox.status==0" class="list-group-item">
                                        <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;
                                            display: inline-block;">{{inbox.nombre}}</span> <span class=""></span>
                                        <span class="text-muted" style="font-size: 11px;">-{{inbox.asunto!==""? inbox.asunto: 'Sin asunto'}}</span> <smal class="badge">{{inbox.fecha|date}}</small></a>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="profile">
                                <div class="list-group">
                                    <div class="list-group-item">
                                                
                                        <a  ng-click="clickEmaiInbox($index,inbox.uid_imap,inbox.id_inbox,false)" style="cursor: pointer" ng-repeat="inbox in inboxBandeja" ng-show="inbox.status==1" class="list-group-item">
                                        <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;
                                            display: inline-block;">{{inbox.nombre}}</span> <span class=""></span>
                                        <span class="text-muted" style="font-size: 11px;">-{{inbox.asunto!==""? inbox.asunto: 'Sin asunto'}}</span>
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade in" id="messages">
                                 <a  style="cursor: pointer" ng-repeat="inbox in inboxBandeja" ng-show="inbox.status==2" class="list-group-item">
                                        <span class="glyphicon glyphicon-star-empty"></span><span class="name" style="min-width: 120px;
                                            display: inline-block;">{{inbox.nombre}}</span> <span class=""></span>
                                        <span class="text-muted" style="font-size: 11px;">-{{inbox.asunto!==""? inbox.asunto: 'Sin asunto'}}</span>
                                    </a>
                            </div>
                            <div class="tab-pane fade in" id="settings">
                                This tab is empty.</div>
                        </div>

                    </div>
                    
                    <div class="col-md-6" id="contenedor-preview">
                        <iframe id="previewEmail" style="width: 100%; height: 500px" frameBorder="0"></iframe>
                    </div>
                </div>


  
            
      
    
        </div>
    </div>


    <script src="../js/vendor/wow.min.js"></script>
    <script src="../js/vendor/jquery-1.11.2.js"></script>
    <script src="../js/vendor/bootstrap.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-aria.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-messages.min.js"></script>
    <script src="../js/angular/controladores/respuestaCtrl.js?id=1.4.1"></script>

  
</body>

</html>
        <span id="result">
            
        </span>
      
  
