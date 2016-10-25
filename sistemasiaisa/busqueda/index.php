<!doctype html>
 <html class="no-js" lang="" > <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>BUSQUEDA ENCUESTA</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="..//animate.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/responsive-tabs.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    </head>
    <body >
      
        <?php
     
           require_once '../php/model/MenuModel.php';
           require_once '../php/model/BusquedaModel.php';
           require_once '../php/model/CustomHelpers.php';
           $menu=new MenuModel();
         
           $busqueda=new BusquedaModel(); 
           $resHistorial=array();
           $promesas=array();
           $cliente=array();
           if(isset($_POST)){
             if(!empty($_POST['id_cliente'])){ 
                $id_cliente=$_POST["id_cliente"];
                $cliente=$busqueda->buscarCliente($id_cliente);
                if(!empty($cliente))
                {
                        $resHistorial=$busqueda->getBitacora($id_cliente);
                       // $promesas=$busqueda->getPromesaReporte($id_cliente);
                }
                unset($_POST);
             }
           }
         
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
                    <li><a href="../logout.php">CERRAR SESIÓN</a></li>
                </ul> 
               
              </div>
            </div>
   </nav>

<div class="container-fluid" style="padding-top:80px">
    <a href="../menu/"><button  type="button" class="btn btn-primary btn-lg "id="regresar" style="margin-bottom:20px;" >Regresar</button></a>
    <form id="formBuscar" action="index.php" method="POST">
    <div class="row">    
        <div class="col-md-5 col-xs-12">
        <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <span id="search_concept">Buscar por:</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#num_cuenta">Número de Cuenta</a></li>
                      <li><a href="#clientes">Nombre</a></li>
                      <li><a href="#fijo">Teléfono Fijo</a></li>
                      <li><a href="#movil">Celular</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param"  value="clientes" id="search_param"> 
                <input type="hidden" name="id_cliente" id="input-id">
                <input type="text" class="form-control" name="palabra_buscada"  id="buscar-input" placeholder=" " required> 
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" value="Submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>

  </div>
</form>
    <div class="row">
      <?php if (is_array($cliente) || is_object($cliente)):?>
        <?php if(!empty($cliente)):?>
            <div class="col-md-4 col-sm-4 col-xs-4  contedor-espacio">
             <h2 class="md-title">Información cliente</h2>
             <h3 class="md-subhead"><strong>Nombre</strong></h3>
             <h3 class="md-subhead"><?php echo $cliente['nombre'].' '.$cliente['paterno'].' '.$cliente['materno']?></h3>
             <h3 class="md-subhead"><strong>Teléfono casa</strong></h3>
             <h3 class="md-subhead"><?php echo $cliente['telefono_fijo']?></h3>
             <h3 class="md-subhead"><strong>Teléfono celular</strong></h3>
             <h3 class="md-subhead"><?php echo $cliente['telefono_movil']?></h3>
             <a  class="btn btn-red initLLamada pull-left"  data-id-cliente="<?php echo $cliente['id_cliente']?>">INICIAR LLAMADA</a>
          </div>Lamada
          <div class="col-md-8 col-sm-8 col-xs-8  contedor-espacio">
             <h3 class="md-title">Gestiones</h3> 
              <div class="responsive-tabs-container accordion-xs accordion-sm">
               <ul class="nav nav-tabs responsive-tabs">
                 <li class="active"><a href="#tab-credito" data-toggle="tab">Información crédito</a></li>
                 <li><a href="#tab-historial" data-toggle="tab">Historial llamadas(<?php echo count($resHistorial)?>)</a></li>        
               </ul>
                 <div class="tab-content">
                       <a href="#tab-credito" data-toggle="tab" class="accordion-link first active">Información crédito</a>
                        <div class="tab-pane active" id="tab-credito">
                      <div class="container-fluid">
                                    <div class="col-md-6">
                                        
                                    <h3 class="md-subhead"><strong>INFORMACIÓN CRÉDITO</strong></h3>
                                    <h3 class="md-subhead rojo"><strong>MONTO</strong></h3>
                                    <h3 class="md-subhead"><?php echo "$".sprintf('%01.2f',$cliente["monto_adicional"])?></h3>
                                    <h3 class="md-subhead rojo"><strong>PAGOS</strong></h3>
                                    <h3 class="md-subhead"><strong><?php echo $cliente['plazo']?></strong> pagos  <strong><?php echo $cliente['periodicidad']?></strong> de <i><?php echo "$".sprintf('%01.2f',$cliente["pago"])?></i></h3>
                                      
                                    </div>
                        
                   <!--   <div class="col-md-6">
                                      <h3 class="md-subhead"><strong>PROMESAS DE PAGO</strong></h3>
                                      <?php if (is_array($promesas) || is_object($promesas)):?>
                                       <?php if(!empty($promesas)):?>
                                         <div class="table-responsive">
                                             <table class="table table-hover">
                                                  <thead>
                                                    <tr>
                                                      <th>Importe</th>
                                                      <th>Fecha</th>
                                                      <th>Vencida</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                     <?php foreach($promesas as $p):?>
                                                        <tr>
                                                            <th>$<?php echo sprintf('%01.2f',$p["importe"])?></th>
                                                            <td><?php echo $p["fecha"]?></td>
                                                            <td>
                                                                <?php 
                                                                    $fecha_promesa= new DateTime($p["fecha"]);
                                                                    $fecha_hoy=  new DateTime(CustomHelpers::getCurrentFecha());
                                                                    $diff = $fecha_hoy->diff($fecha_promesa)->format("%r%a");
                                                                    //NEGATIVO LA FECHA DE PROMESA HA VENDIO
                                                                    if($diff<0){
                                                                            echo "<p class='rojo'>Vencida hace " .($diff*-1). " días </p>";
                                                                    }
                                                                    //POSITIVO
                                                                    else {
                                                                         echo "<p class='rojo'>". $diff." días para vencer </p>";
                                                                    }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                     <?php endforeach?>
                                                  </tbody>
                                             </table>
                                         </div>
                                <?php else:?>
                                <?php echo '<h2 class="md-title">Este cliente no tiene aún promesas de pago</h2>'?>
                                <?php endif?>
                                     
                               <?php endif?>  
                        </div>-->
                        
                    </div>
                                    
                        </div>
                       <a href="#tab-historial" data-toggle="tab" class="accordion-link first">Historial llamadas(<?php echo count($resHistorial)?>)</a>
                        <div class="tab-pane fade" id="tab-historial">
                              <?php if (is_array($resHistorial) || is_object($resHistorial)):?>
                                 <?php if(count($resHistorial)>0):?>
                                        <div class="table-responsive">
                                              <table class="table table-hover">
                                                  <thead>
                                                    <tr>
                                                      <th>Agente</th>
                                                      <th>Marco</th>
                                                      <th>Fecha/Hora</th>
                                                      <th>Status</th>
                                                      <th>Notas</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                       <?php foreach($resHistorial as $h):?>
                                                      <tr>
                                                          <td><?php echo $h['nombre']?></td>
                                                          <td><?php echo $h["tipo_llamada"]==1? "CELULAR":"CASA"?></td>
                                                          <td><?php echo $h['inicio']?></td>
                                                          <td><?php echo strtoupper($h['status'])?></td>
                                                          <td><?php echo utf8_encode($h['notas'])?></td>
                                                          </tr>
                                                          <?php endforeach?>
                                                          <?php else:?>                                    
                                                          <?php echo '<h2 class="md-title">Este cliente no tiene historial de llamadas aun</h2>'?>
                                                          <?php endif?>
                                                          <?php endif?>                                 
                                                  </tbody>
                                              </table>
                                               </div>
                        </div>
                 </div>
              </div>      
           </div>

            
                      
       
      <?php else:?>   
        <div class="col-md-8">
           <?php $sugerencias=$busqueda->showSugerencias()?> 
            <?php if (is_array($sugerencias) || is_object($sugerencias)):?>
            <?php if(!empty($sugerencias)):?>
                <?php echo '<h2 class="md-title">Posibles resultados de clientes para <strong><i>"'.$_POST['palabra_buscada'].'"</i></strong> </h2>';?>
                <?php foreach ($sugerencias as $s):?>
                  <?php echo '<a class="result" style="cursor:pointer"   data-id='.$s['id_cliente'].'>'.$s['nombre'].' ' .$s['paterno'].' '.$s['materno'].'</a>'?>
                  <?php echo '<br>'?>
               <?php endforeach?> 
            <?php else:?>
            <?php echo '<h2 class="md-title">No se encontraron resultados para <strong><i>"'.$_POST['palabra_buscada'].'"</i></strong></h2>'?>
            <?php endif?>       
            <?php endif?>
        </div>     
        <?php endif?>      
        <?php endif?>
          
       
        </div>
</div>

     <footer>
            <span>2016 SIAISA</span>
     </footer>
        <script src="../js/vendor/jquery-1.11.2.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
      <script src="../js/notiny.min.js"></script>
      <script src="../js/main.js?id=1.3"></script>
      
    </body>
</html>