<!DOCTYPE html>
<html class="no-js" lang="" ng-app="app">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ENCUESTAS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css?id=1">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/notiny.min.css">
    <link rel="stylesheet" href="../css/rome.css">
    <script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body ng-controller="encuestaCtrl">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- MODAL REPORTE -->
    <div class="modal fade" data-keyboard="false" data-backdrop="static" id="modalReporte" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registro guardado</h4>
                </div>
                   <div class="modal-body">
                    <h3 class="md-subhead">HAS CONTACTADO A <span class="rojo">{{contactacion._contactados}}</span> DE <span class="rojo">{{contactacion._total_contactados}}</span></h3>
                    <h3 class="md-subhead">TU PORCENTAJE DE CONTACTACIÓN ES DEL <span class="rojo">{{(contactacion._contactados*100)/contactacion._total_contactados|number:1}}%</span> </h3>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{(contactacion._contactados*100)/contactacion._total_contactados|number:1}}%">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"  class="btn btn-red" data-dismiss="modal" ng-click="reloadPage()">SIGUIENTE LLAMADA</button>
                </div>

            </div>

        </div>
    </div>
    
    
    <!--MODAL  NO MÁS CLIENTES-->
    <div class="modal fade" id="modalNoClientes" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>HA OCURRIDO ALGO INESPERADO</strong></h4>
                </div>
                <div class="modal-body">
                    <h3 class="md-subhead">
                       {{mensajeServer}}
                    </h3>
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
                <a ng-cloak ng-show="angularLoaded" class="navbar-brand animacion" href="#"><span><img src="../img/logo-siaisa.png" width="35" height="35"/></span> {{agente.nombre_usuario}}</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../logout.php">CERRAR SESIÓN</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right hidden">
                    <li>
                        <a data-toggle="modal" data-target="#modalReporte" id="contactacion"></a>
                        <a data-toggle="modal" data-target="#modalNoClientes" id="noClientes"></a>
                     </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../menu/">REGRESAR</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="centro-loader" ng-hide="angularLoaded">
            <img src="../img/rolling.svg" alt="loader" />
        </div>
        <div ng-cloak ng-show="angularLoaded" class="row animacion-loaded principal-row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                 <h2 class="md-title">Información cliente</h2>
                <dl>
					<dt>Cuenta</dt>
                                        <dd class="rojo">{{cliente.no_contrato}}</dd>
					<dt>Nombre</dt>
					<dd>{{cliente.nombre}} {{cliente.paterno}} {{cliente.materno}}</dd>
					<dt>Casa</dt>
					<dd>
                                             {{cliente.telefono_fijo}}
					</dd>
                                        <dt>Celular</dt>
					<dd>
                                            {{cliente.telefono_movil}}
                                        </dd>
                </dl>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4" style="display: none">
                <h2 class="md-title">Información cliente</h2>
                <h3 class="md-subhead-datos"><strong>Cuenta</strong></h3>
                <h3 class="md-subhead-datos"><i>{{cliente.id_financiera}}</i> </h3>
                <h3 class="md-subhead-datos"><strong>Nombre</strong></h3>
                <h3 class="md-subhead-datos">{{cliente.nombre}} {{cliente.paterno}} {{cliente.materno}}</h3>
                <h3 class="md-subhead-datos"><strong>Teléfono casa</strong></h3>
                <h3 class="md-subhead-datos">{{cliente.telefono_fijo}}</h3>
                <h3 class="md-subhead-datos"><strong>Teléfono celular</strong></h3>
                <h3 class="md-subhead-datos">{{cliente.telefono_movil}}</h3>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <h3 class="md-title">Información de llamada</h3>
                <br>
                <form>
                    <div class="form-group">
                        <label>MARCANDO A</label>
                        <br>
                        <select ng-model="bitacora.id_tipo_llamada" class="form-control form-control-shadow" ng-change="tipoChange()">
                            <option value="1">Celular</option>
                            <option value="2">Casa</option>
                        </select>
                    </div>
                    <br>
                    <label>ESTATUS LLAMADA </label>
                    <br>
                    <select ng-show="bitacora.id_tipo_llamada" ng-model="bitacora.id_status_llamada" class="form-control form-control-shadow animacion" ng-change="statusChange()">
                        <option ng-value="1">Contestan</option>
                        <option ng-value="2">No contestan</option>
                        <option ng-value="3">Teléfono Inválido</option>
                        <option ng-value="4">Fuera de Servicio</option>
                        <option ng-value="5">Buzón de Voz</option>
                    </select>



                </form>
            </div>
        </div>
        <div class="row contedor-espacio animacion" id="presentacion" ng-show="bitacora.id_status_llamada==1" ng-cloak>
            <div class="col-md-12">
                <h2 class="md-title">PRESENTACIÓN</h2>
                <h3 class="md-subhead">Buenos días, mi nombre es <strong>{{agente.nombre_usuario|uppercase}}</strong> hablo de  parte de Financiera Ayudamos. </h3>
                <h3 class="md-subhead">¿Con quíen tengo el gusto?</h3>
                <div class="col-md-12" style="margin-left: -30px;">
                    <div class="col-md-12" style="margin-left: -10px;">
                        <form>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <input type="text" ng-model="datalleContacto.interlocutor_nombre" class="form-control form-control-shadow" placeholder="Nombre" />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <input type="text" ng-model="datalleContacto.interlocutor_paterno" class="form-control form-control-shadow" placeholder="Paterno" />
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <input type="text" ng-model="datalleContacto.interlocutor_materno" class="form-control form-control-shadow" placeholder="Materno" />
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-12">
                        <h3 class="md-subhead">¿Has contactado a <strong>{{cliente.nombre}} {{cliente.paterno}}  {{cliente.materno}}</strong>?</h3>
                        <div class="col-md-12">
                            <label class="radio-inline">
                                <input  ng-value="true" type="radio"  name="contacto" ng-click="onContacto()">SI
                            </label>
                            <label class="radio-inline">
                                <input  ng-value="false" type="radio" name="contacto"  ng-click="onContactoNo()">NO
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                      <div id="motivo_no_contacto" ng-show="opcion.contactoOpcion==false" class="col-md-12 animacion">
                        <div class="form-group">
                            <h3 class="md-subhead">Motivo de no contacto</h3>
                            <select ng-model="datalleContacto.id_motivo_no_contacto" ng-change="isActivo=true" class="form-control form-control-shadow">
                                <option value="1">No se encuentra/Recado</option>
                                <option value="2">No lo conocen</option>
                                <option value="3">Ya no vive ahí</option>
                                <option value="4">Falleció</option>
                                <option value="5">Cliente molesto</option>
                                <option value="6">Contesta menor de edad</option>
                                <option value="7">No localizable en horario</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    
             
                    <br>
                    <div id="script_credito" ng-show="opcion.contactoOpcion==true" class="col-md-12   animacion">
                        <h2 class="md-subhead">Hola, mi nombre es <strong>{{agente.nombre_usuario|uppercase}}</strong>, el motivo de nuestra llamada es para informarle que debido a su buen historial Financiera Ayudamos le está otorgando un crédito preautorizado. </h2>
                        <h2 class="md-subhead">¿Ya estaba enterado de esto? </h2>
                        <div class="col-md-12 no-padding">
                            <label class="radio-inline">
                                <input type="radio" ng-model="opcion.enteradoOpcion" name="enterado" ng-click="onEnterado()" value="true">SI
                            </label>
                            <label class="radio-inline">
                                <input type="radio" ng-model="opcion.enteradoOpcion" name="enterado" ng-click="onEnteradoNo()" value="false">NO
                            </label>
                            <!--ng-show="propuestaOpcion=='true'"-->
                            <div id="enterado" ng-show="opcion.enteradoOpcion=='true'" class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 no-padding">
                                        <h3 class="md-subhead">¿Por qué medio se entero?</h3>
                                        <select ng-model="interes_credito.id_medio_entero" ng-change="onMedioChange()" class="form-control form-control-shadow">
                                            <option value="1">Llamada de sucursal</option>
                                            <option value="2">Mensaje de Voz</option>
                                            <option value="3">Mensaje de texto</option>
                                            <option value="4">Correspondencia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="informacion_credito" ng-show="opcion.enteradoOpcion=='false'|| medioEnterado=='true'" class="contenedor-espacio animacion">
                                <div class="col-md-4 col-sm-4 col-xs-4 no-padding">
                                    <h3 class="md-subhead">El crédito que le estámos autorizando tiene las siguiente características</h3>
                                    <h3 class="md-subhead"><strong>INFORMACIÓN CRÉDITO</strong></h3>
                                    <h3 class="md-subhead rojo"><strong>MONTO ADICIONAL</strong></h3>
                                    <h3 class="md-subhead">{{cliente.monto_adicional|currency}}</h3>
                                    <h3 class="md-subhead rojo"><strong>MONTO AUTORIZADO</strong></h3>
                                    <h3 class="md-subhead">{{cliente.monto_autorizado|currency}}</h3>
                                    <h3 class="md-subhead rojo"><strong>PAGOS</strong></h3>
                                    <h3 class="md-subhead"><strong>{{cliente.plazo}}</strong> pagos  <strong>{{cliente.periodicidad}}</strong> de <i>{{cliente.pago|currency}}</i></h3>
                                      
                                </div>
                                
                                <div class="col-md-8 col-sm-8 col-xs-8 no-padding">
                                       <h3 class="md-subhead"><strong>¿Qué día podremos esperarlo?</strong></h3>
                                        <select class="form-control" ng-model="interes_credito.tipo"  ng-change="onInteresariaCredito()" >
                                            <option ng-value="1">SI</option>
                                            <option ng-value="0">NO</option>
                                            <option ng-value="2">INTERESADO SIN FECHA</option>
                                            <option ng-value="3">TIENE CITA CON EJECUTIVO</option>
                                            <option ng-value="4">YA LO RENOVO</option>
                                            <option ng-value="5">LE RECHAZARON SOLICITUD</option>
                                     </select>
                                </div>
                                
                                <div ng-show="interes_credito.tipo" class="col-md-12 col-sm-12 col-xs-12 no-padding">
                              
                                    <!--Opcion si en le interesa tomar credito? -->
                                    <div class="row" ng-cloak ng-show="interes_credito.tipo==1 || interes_credito.tipo==3 " id="cita">
                                        <div class="col-md-12">
                                            <h3 class="md-subhead">
                                                <strong ng-if="interes_credito.tipo==1">AGENDAR CITA</strong>
                                                <strong ng-if="interes_credito.tipo==3">CONFIRMAR CITA</strong>
                                            </h3>
                                            <h3 ng-if="interes_credito.tipo==1" class="md-subhead">¿Qué día podemos esperarlo? {{fecha_cita}}</h3>
                                            <h3 ng-if="interes_credito.tipo==3" class="md-subhead">{{fecha_cita}} Como confirmación podría indicarme ¿Para qué día tiene agendada su cita en la sucursal?</h3>
                                            <input id='inputCita1'  ng-model="interes_credito.agendar_cita" class='input form-control'  />
                                        </div>
                                        <div class="col-md-12">
                                            <h3 class="md-subhead">Recuerde llevar la documentación necesaria</h3>
                                            <ul>
                                                <li>Identificación Oficial</li>
                                                <li>Comprobante de Domicilio</li>
                                                <li>Comprobante de Ingresos (FORMERS)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    
                               
                                    <!--Opcion no  le interesa tomar credito? -->
                                    <div class="row" ng-cloak ng-show="interes_credito.tipo==0" id="manejo_objeciones">
                                        <div class="col-md-12">
                                            <div id="no_interesado" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead"><strong>Manejo de Objeciones</strong></h3>
                                                        <h3 class="md-subhead">Podría ayudarme a mejorar nuestro servicio indicándome ¿Cuál fue el motivo por el que no está interesado en renovar su crédito?</h3>
                                                        <select ng-model="interes_credito.manejo_objecion" ng-change="onManejoObjeciones()" class="form-control form-control-shadow">
                       
                                                            <option ng-value="1">Mayor tiempo para pagar</option>
                                                            <option ng-value="2">Necesita más dinero</option>
                                                            <option ng-value="3">Los intereses son altos</option>
                                                            <option ng-value="4">Mal servicio en sucursal</option>
                                                            <option ng-value="5">La mensualidad es muy alta</option>
                                                            <option ng-value="6">No le interesa</option>
                                                            <option ng-value="7">No lo necesita</option>
                                                            <option ng-value="8">Está pagando otro crédito (FINAYUDAMOS)</option>
                                                            <option ng-value="9">Está pagando otro crédito (OTRO)</option>
                                                            <option ng-value="10">Lo va a pensar</option>
                                                            <option ng-value="11">Luego pasa a la sucursal</option>
                                                            <option ng-value="12">No tiene su identificación actualizada/extraviada</option>
                                                            <option ng-value="13">No tiene para pagarlo</option>


                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 1 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==1" id="manejo_objeciones_1">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">En Financiera Ayudamos estamos seguros podemos encontrar una opción que se acomode a sus necesidades, lo invitamos a visitar la sucursal que le atiende y esperamos seguir contando con su preferencia </h3>
                                                        <h3 class="md-subhead"><strong>¿A qué plazo preferiría que se le diera el nuevo crédito?</strong></h3>
                                                        <input type="text" ng-model="manejo_objecion.plazo" class="form-control form-control-shadow" placeholder="*pagos semanales o quincenales"  />
                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-change="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-change="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 2 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==2" id="manejo_objeciones_2">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Esta oferta que le hacemos es única y con una tasa especial por ser cliente predilecto, sin embargo en Financiera Ayudamos estamos seguros que podemos encontrar una opción que se acomode a sus necesidades presentando sus comprobantes de ingresos, lo invitamos a visitar la sucursal que le atiende y esperamos seguir contando con su preferencia.</h3>
                                                        <h3 class="md-subhead"><strong>¿A partir de qué monto estaría dispuesto a aceptar el crédito?</strong></h3>
                                                        <input type="text" ng-model="manejo_objecion.monto" class="form-control form-control-shadow" placeholder="monto " />
                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 3 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==3" id="manejo_objeciones_3">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Esta oferta que le hacemos es única y con una tasa especial por ser cliente predilecto, lo invitamos a visitar la sucursal que le atiende para conocer con más  ésta oferta y esperamos seguir contando con su preferencia.</h3>
                                                        <h3 class="md-subhead"><strong>¿A partir de qué monto estaría dispuesto a aceptar el crédito?</strong></h3>
                                                        <input type="text" ng-model="manejo_objecion.monto" class="form-control form-control-shadow" placeholder="monto " />
                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 4 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==4" id="manejo_objeciones_4">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">En Financiera Ayudamos su opinión es importante, para ayudarnos a mejorar el servicio le agradeceré me pueda comentar qué queja tiene del servicio que le brindamos y de ser posible el nombre de la persona que la atendió mal para pasar el reporte al área correspondiente?</h3>
                                                        <h3 class="md-subhead">Sucursal</h3>
                                                        <input type="text" ng-model="manejo_objecion.sucursal" class="form-control form-control-shadow" placeholder=" " />
                                                        <h3 class="md-subhead">Ejecutivo</h3>
                                                        <input type="text" ng-model="manejo_objecion.ejecutivo" class="form-control form-control-shadow" placeholder=" " />
                                                        <h3 class="md-subhead">¿Qué problemática ha tenido con el servicio?</h3>
                                                        <input type="text" ng-model="manejo_objecion.problematica" class="form-control form-control-shadow" placeholder="" />
                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 5 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==5" id="manejo_objeciones_5">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                      
                                                        <h3 class="md-subhead">
                      
									Esta oferta que le hacemos es única y con una tasa especial por ser cliente predilecto, sin embargo en Financiera Ayudamos estamos seguros podemos encontrar una opción que se acomode a sus necesidades presentando sus comprobantes de ingresos, lo invitamos a visitar la sucursal que le atiende y esperamos seguir contando con su preferencia
									¿Cuál es el pago mensual que podría realizar?
                                                        </h3>
                                                        <input type="text" ng-model="manejo_objecion.pago" class="form-control form-control-shadow" placeholder=" " />
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 6 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==6" id="manejo_objeciones_6">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Le menciono que ésta oferta que le hacemos es única y por tiempo limitado, con una tasa especial para usted ser cliente predilecto de Financiera Ayudamos. Estamos convencidos que éste crédito podrá ayudarlo a realizar aquello que quizá ha estado pensado y que por alguna razón no había podido, tal como:</h3>
                                                        <ul>
                                                            <li>Remodelar su vivienda</li>
                                                            <li>Muebles nuevos</li>
                                                            <li>Enfermedad de algún pariente</li>
                                                            <li>Plan de Vacaciones</li>
                                                            <li>Inversión en su negocio</li>
                                                            <li>Pagar deudas</li>
                                                            <li>Evento Familiar</li>
                                                        </ul>

                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 7 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==7" id="manejo_objeciones_7">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Le menciono que ésta oferta que le hacemos es única y por tiempo limitado, con una tasa especial para usted ser cliente predilecto de Financiera Ayudamos. Estamos convencidos que éste crédito podrá ayudarlo a realizar aquello que quizá ha estado pensado y que por alguna razón no había podido, tal como:</h3>
                                                        <ul>
                                                            <li>Remodelar su vivienda</li>
                                                            <li>Muebles nuevos</li>
                                                            <li>Enfermedad de algún pariente</li>
                                                            <li>Plan de Vacaciones</li>
                                                            <li>Inversión en su negocio</li>
                                                            <li>Pagar deudas</li>
                                                            <li>Evento Familiar</li>
                                                        </ul>

                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 8 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==8" id="manejo_objeciones_8">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Precisamente ésta oferta es para invitarlo a que renueve su crédito con nosotros con condiciones especiales por ser cliente predilecto, su crédito anterior se liquidaría con el nuevo, pero con la ventaja de podrá contar con un poco más de dinero para continuar realizando sus proyectos.</h3>


                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 9 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==9" id="manejo_objeciones_9">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Precisamente ésta oferta que le hacemos es para invitarlo a que obtenga o renueve su crédito con nosotros con condiciones especiales por ser cliente predilecto, que quizá podría utilizar para liquidar algún crédito del que esté pagando más en éste momento.</h3>


                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 10 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==10" id="manejo_objeciones_10">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Le menciono que ésta oferta que le hacemos es única y por tiempo limitado, con una tasa especial para usted ser cliente predilecto de Financiera Ayudamos. Estamos convencidos que éste crédito podrá ayudarlo a realizar aquello que quizá ha estado pensado y que por alguna razón no había podido, tal como:</h3>
                                                        <ul>
                                                            <li>Remodelar su vivienda</li>
                                                            <li>Muebles nuevos</li>
                                                            <li>Enfermedad de algún pariente</li>
                                                            <li>Plan de Vacaciones</li>
                                                            <li>Inversión en su negocio</li>
                                                            <li>Pagar deudas</li>
                                                            <li>Evento Familiar</li>
                                                        </ul>

                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 11 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==11 " id="manejo_objeciones_11">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Estamos a sus órdenes cualquier día que usted quiera visitarnos, sin embargo es importante expresarle que estas promociones son temporales y pueden tener cambios por parte de la Financiera, le invitamos a que nos visite en la sucursal y verifique esta promoción que le beneficie a usted y a su familia.</h3>


                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Manejo de Objeciones objeción 12 -->
                                    <div class="row" ng-cloak ng-show="interes_credito.manejo_objecion==12 " id="manejo_objeciones_12">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">A fin de atenderlo lo mejor posible, le informo que en Financiera Ayudamos aceptamos las siguientes identificaciones:</h3>
                                                        <ul>
                                                            <li>Credencial de Elector Vigente.</li>
                                                            <li>Pasaporte vigente.</li>
                                                            <li>Credencial SEDENA (Secretaría de la Defensa Nacional en caso de militares)</li>
                                                            <li>Cartilla militar con antigüedad no mayor a 10 años (Hombres).</li>
                                                            <li>Cédula Profesional no mayor a 10 años</li>
                                                            <li>Credencial de INAPAM (Adultos Mayores)</li>
                                                        </ul>

                                                        <h3 class="md-subhead">¿Le gustaría que le programáramos una cita en su sucursal para darle mayor información?</h3>
                                                        <div class="col-md-12">
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCita()" value="true">SI
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" ng-model="programarCita" name="" ng-click="onprogramarCitaNo()" value="false">NO
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--Opcion PROGRAMAR CITA -->

                                    <div class="row" ng-cloak ng-show="programarCita=='true'" id="programar_cita">
                                        <div class="col-md-12">
                                            <h3 class="md-subhead"><strong>AGENDAR CITA</strong></h3>
                                            <h3 class="md-subhead">¿Qué día podemos esperarlo?</h3>
                                            <input id="inputCita2" ng-model="manejo_objecion.agendar_cita" class="input form-control "/>
                                        </div>
                                        <div class="col-md-12">
                                            <br>Recuerde llevar la documentación necesaria
                                            <ul>
                                                <li>Identificación Oficial</li>
                                                <li>Comprobante de Domicilio</li>
                                                <li>Comprobante de Ingresos (FORMERS)</li>
                                            </ul>
                                        </div>
                                    </div>
                                 
                                    <!--Opcion le gustaria recomendar a alguien? -->
                                    <div name="recomendar" ng-show="interes_credito.tipo==1 || interes_credito.tipo==3 || programarCita=='true'">
                                        <div class="col-md-12 no-padding">
                                            <h3 class="md-subhead"><strong> ¿Le gustaría recomendar a alguien para que pueda ser candidato a recibir un crédito con nosotros?</strong></h3>
                                        </div>
                                        <div class="col-md-12 no-padding">
                                             <label class="radio-inline">
                                                    <input type="radio" ng-model="recomendarOpcion" name="recomendar" ng-click="onRecomendar()" value="true">SI
                                              </label>
                                             <label class="radio-inline">
                                                    <input type="radio" ng-model="recomendarOpcion" name="recomendar" ng-click="onRecomendarNo()" value="false">NO
                                        </div>
                                        <div id="recomendado" ng-show="recomendarOpcion=='true'" class="col-md-12 no-padding contedor-espacio">
                                            <div class="row">
                                                <form>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input ng-model="prospecto.nombre_prospecto" type="text" class="form-control form-control-shadow" placeholder="Nombre" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input ng-model="prospecto.telefono_prospecto" type="text" class="form-control form-control-shadow" placeholder="Telefono" />
                                                        </div>
                                                    </div>

                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                       <!--Opcion no  le interesa tomar credito? o ya lo renovo y le rechazaron la solicitud -->
                                    <div class="row" ng-cloak ng-show="programarCita=='false' ||interes_credito.tipo==2 || interes_credito.tipo==4 || interes_credito.tipo==5 || interes_credito.manejo_objecion==13 || recomendarOpcion" id="encuesta">
                                        <div class="col-md-12">
                                            <div id="cierre" class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead"><strong>Encuesta Cierre</strong></h3>
                                                        <h3 class="md-subhead">Permítame aplicar una pequeña encuesta para mejorar la calidad de nuestro servicio.</h3>
                                                        <h3 class="md-subhead">En una escala del 1 a 10 ¿Qué calificación le otorga a nuestro servicio?</h3>
                                                        <select ng-model="encuesta.calificacion" ng-change="onEncuesta()" class="form-control form-control-shadow">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div ng-show="encuesta.calificacion" id="recomendarProducto" class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">¿Recomendaría nuestro producto a algún familiar o amigo?</h3>
                                                        <input type="radio" name="recomendaria_familiar_amigo" id="si-recomendaria_familiar_amigo" ng-change="onRecomendarFamiliar()" value="1" ng-model="encuesta.recomendaria_producto" required=""><label for="si-recomendaria_familiar_amigo">Sí</label>
                                                        <input type="radio" name="recomendaria_familiar_amigo" id="no-recomendaria_familiar_amigo" ng-change="onRecomendarFamiliar()" value="0" ng-model="encuesta.recomendaria_producto" required=""><label for="no-recomendaria_familiar_amigo">No</label><br>
						
                                                    </div>
                                                    
                                                    <div ng-show="encuesta.recomendaria_producto" id="tomadoCredito" class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">¿Ha tomado algún crédito con otra entidad financiera desde que fue cliente de Financiera Ayudamos?</h3>
                                                        <input type="radio" name="tomadoCredito"  ng-change="onTomadoCredito()" value="1" ng-model="encuesta.credito_otra_financiera" required=""><label for="tomadoCredito">Sí</label>
                                                        <input type="radio" name="tomadoCredito"  ng-change="onEntidadFinanciera()" value="0" ng-model="encuesta.credito_otra_financiera" required=""><label for="tomadoCredito">No</label><br>
						
                                                    </div>
                                                    
                                                    <div id="entidadFinanciera"  ng-show="encuesta.credito_otra_financiera==1" class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">¿Con qué entidad financiera?</h3>
                                                       

                                                        <select class="form-control" ng-model="encuesta.entidad_financiera" ng-change="onEntidadFinanciera()">
                                                            <option value="NINGUNO">NINGUNO</option>
                                                            <option value="OTRO">OTRO</option>
                                                            <option value="APOYO ECONOMICO">APOYO ECONOMICO</option>
                                                            <option value="COMPARTAMOS">COMPARTAMOS</option>
                                                            <option value="BANCO AZTECA">BANCO AZTECA</option>
                                                            <option value="ELEKTRA">ELEKTRA</option>
                                                            <option value="FIN COMUN">FIN COMUN</option>
                                                            <option value="FAMSA">FAMSA</option>
                                                            <option value="CAJA BIENESTAR">CAJA BIENESTAR</option>
                                                            <option value="CAME">CAME</option>
                                                            <option value="COPPEL">COPPEL</option>
                                                            <option value="CREDITO FAMILIAR">CREDITO FAMILIAR</option>
                                                            <option value="CAJA POPULAR MEXICANA">CAJA POPULAR MEXICANA</option>
                                                            <option value="MICRO APOYO">MICRO APOYO</option>                                                         
                                                        </select> 
                                                       <br>
                                                    </div>
                                                    
                                                    <div id="finalEncuesta" ng-show="encuesta.finalShow" class="col-md-12 col-xs-12 no-padding">
                                                        <h3 class="md-subhead">Finalmente para mantenerlo informado sobre futuras promociones ¿Me podría proporcionar su correo electrónico por favor?</h3>
                                                        <input class="form-control" ng-model="encuesta.correo_electronico" placeholder="Correo electronico"/>
                                                        <h3 class="md-subhead">Agradezco su atención, sus comentarios serán tomados en cuenta para mejorar nuestro servicio y los productos que Financiera Ayudamos tiene para usted.</h3>
                                                        <h3 class="md-subhead">
                                                            <strong> Le invitamos a visitar nuestro aviso de privacidad en nuestra página: 
                                                               www.financiera-ayudamos.com.mx</strong>
                                                        </h3>
                                                    </div>
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
         </div>
            <!--ROW DE NOTAS Y HISTORIAL DE LLAMADAS-->
            <div class="row no-padding" ng-show="angularLoaded" ng-cloak>
                <div class="col-md-7 col-xs-12">

                    <label class="md-subhead"><strong>NOTAS</strong>
                    </label>
                    <textarea ng-model="bitacora.notas" class="form-control-shadow-text-area" style="width: 100%;background:#ecf0f" rows="3" placeholder="ESCRIBE AQUÍ LAS NOTAS"></textarea>
                    <div class="col-md-6 pull-right">
                        <input type="submit" value="Guardar" ng-click="guardarLlamada()" ng-disabled="llamadaInvalida()" class="btn btn-red" />
                    </div>

                </div>
                <div class="col-md-5 col-xs-12 padding-top">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                          Historial Llamadas ({{historial.length}})</a>
                        </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
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
                                                <tr ng-repeat="h in historial">
                                                    <td>{{h.nombre|uppercase}}</td>
                                                    <td>{{h.tipo_llamada==1? "CELULAR":"CASA"}}</td>
                                                    <td>{{h.inicio}}</td>
                                                    <td>{{h.status|uppercase}}</td>         
                                                    <td>{{h.notas}}</td>
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
        <script src="../js/vendor/wow.min.js"></script>
        <script src="../js/vendor/rome.js"></script>
        <!-- Angular Material Library -->
        <script src="../js/vendor/jquery-1.11.2.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular-animate.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
        <script src="../js/Chart.min.js"></script>
        <script src="http://cdn.jsdelivr.net/angular.chartjs/latest/angular-chart.min.js"></script>
        <script src="../js/notiny.min.js"></script>
        <script src="../js/vendor/notify.min.js"></script>
      <!--  <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.3.3.js"></script>-->
        <script src="../js/vendor/angular-smooth-scroll.js"></script>
        <script src="../js/angular/app.js?id=2.15"></script>
        <script src="../js/angular/controladores/encuestaCtrl.js?id=2.16"></script>
</body>
</html>