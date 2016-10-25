var app=angular.module("dashboardApp",['chart.js','ngRoute']);
app.service("cache",function(){
   this.complete=false;
   this.selectedSegmento=1;   
});
app.config(function($routeProvider,ChartJsProvider){
    $routeProvider.when("/",{
       templateUrl:"html/pre.html",
       controller:"dashboardPrecalificado"
   });
   $routeProvider.when("/inicio/:usuario_encuesta",
   {
         templateUrl:"html/pre.html",
         controller:"dashboardPrecalificado"
   });
   $routeProvider.when("/email",
   {
       templateUrl:"html/email.html",
       controller:"dashboardEmail"
   });
   $routeProvider.when("/encuesta",
   {
       templateUrl:"html/encuesta.html",
       controller:"dashboardEncuesta"
   });
   $routeProvider.when("/sms/carga", {
       templateUrl:"html/layout.html",
       controller  :"layoutCtrl"
   });
   $routeProvider.when("/sms",{
       templateUrl:"html/detalle-sms.html",
       controller  :"smsCtrl"
       
   });

    ChartJsProvider.setOptions({
      chartColors: ['#00c0ef', '#FF8A80']
    });

});
app.service("notificacion",function($rootScope){
    $rootScope.notificaciones=new Array();
    this.checkIfNotificacion=function(keyPrefix,value,textNotificacion){
         var d = new Date();
         var n = d.getDate();
         var key=keyPrefix+n;
        if($rootScope.notificaciones.length>5){
            $rootScope.notificaciones.length=0;
        }
        if(localStorage.getItem(key)==null){
		localStorage.setItem(key,value);
	}
	else{
                     
                        
		        var actual=parseInt(localStorage.getItem(key));
			var nueva=parseInt(value);
			if(actual<nueva){
                                                var notificacion={};
                                                var audio = new Audio('notify.mp3');
						notificacion.texto=textNotificacion;
						notificacion.total=nueva-actual;
                                                notificacion.fecha=new Date();
						$rootScope.notificaciones.push(notificacion);
                                                console.log($rootScope.notificaciones);
                                                audio.play();
                                               
			}
                        else{
                            console.log("Iguales o mayor");
                        }
                        localStorage.setItem(key,value);
	}
    };
});
app.service("apiService",function($http){
   this.getInformacionGeneral=function(){
       return $http.get("http://www.sistema-siaisa.net/php/api/encuesta/getInfoGeneral.php");
   };
   this.getClienteEncuesta=function(){
       return $http.get("http://www.sistema-siaisa.net/php/api/encuesta/getCliente.php")
   };
   this.getClienteEncuestaById=function(param){
       return $http.get("http://www.sistema-siaisa.net/php/api/encuesta/getCliente.php",{
           params:{id_cliente:param}
       });
   };
   this.getCalificacion=function(){
        return $http.get("http://www.sistema-siaisa.net/reporte.php",{
           params:{tipo:"calificacion"}
       });
   };
   this.getMotivo=function(){
        return $http.get("http://www.sistema-siaisa.net/reporte.php",{
           params:{tipo:"motivo"}
       });
   };
   this.getFinanciera=function(){
       return $http.get("http://www.sistema-siaisa.net/reporte.php",{
            params:{tipo:"financiera"}
       });
   };
   this.getBitacoraHistorial=function(id_cliente){
       var data=new FormData();
       data.append("id_cliente",id_cliente);
       return $http({
                    method: 'POST',
                    async : true,
                    headers: { 'Content-Type': undefined },
                    transformRequest: angular.identity,
                    url: ".http://www.sistema-siaisa.net/php/api/encuesta/getBitacora.php",
                    data:data
                   
        });
   };
    this.guardarLlamadaEncuesta=function(data){
         return $http({
                    method: 'POST',
                    url: "http://www.sistema-siaisa.net/php/api/encuesta/guardarInfo.php",
                    async : true,
                    data:JSON.stringify(data),
                    headers: {'Content-type': 'application/json'}
        });
   };
   this.getCliente=function(){
        return $http.get("http://www.sistema-siaisa.net/php/api/getCliente.php");
   };
   
   
   
    this.getMonitoreo=function(){
       return $http.get("http://www.sistema-siaisa.net/php/api/getMonitoreo.php");
   };
    this.getMonitoreoByDate=function(param,paramDos){
       return $http.get("http://www.sistema-siaisa.net/php/api/getMonitoreo.php",{
                 params: {fecha_inicio:param,fecha_fin:paramDos  }
            });
   };
   this.getMonitoreoCita=function(param){
       return $http.get("http://www.sistema-siaisa.net/php/api/getMonitoreo.php",{
           params:{
               isCita:param
           }
       });
   };
   
   this.beforeClose=function(){
         $.ajax({
                type: 'GET',
                async: false,
                url: 'SomeUrl.com?id=123'
         });
   };
   
    
   this.guardarInformacion=function(data){
       return $http({
                    method: 'POST',
                    url: "http://www.sistema-siaisa.net/php/api/guardarInfo.php",
                    async : true,
                    data:JSON.stringify(data),
                    headers: {'Content-type': 'application/json'}
        });
   };
   
   this.getAgente=function(){
       return $http.get("http://www.sistema-siaisa.net/php/api/getAgente.php");
   };
   this.getContactacion=function(){
     return $http.get("http://www.sistema-siaisa.net/php/api/getContactacion.php");
   };
   
});
app.controller("dashboardEmail",function($scope,$http,$interval,cache){
   
   $scope.info={};
   $scope.data=[];
   $scope.atendidoTabla={};
   $scope.selectedSegmento=1;
   $scope.loaded=false;
   $scope.labels=['abiertos','click interesa','click no interesa','baja','rebotados'];
   $scope.actualizar=function(id){

        $http.get("../php/api/info_general.php",{
              params: {id_segmento:id,is_menu:true}
            }).then(function(response) {
                  $scope.info=response.data;
                  $scope.info.nuevos=parseInt($("#nuevos").text().trim());
                  $scope.info.inbox=$scope.info.nuevos+parseInt(response.data.inbox);
                  $scope.info.pendientes=$scope.info.nuevos+parseInt(response.data.pendientes);
        });

        $http.get("../reporte.php",{
             params: {tipo:'grafica'}
        }).then(function(response) {
                  $scope.data[0]=response.data.abiertos;
                  $scope.data[1]=response.data.interesa;
                  $scope.data[2]=response.data.no_interesa;
                  $scope.data[3]=response.data.baja;
                  $scope.data[4]=response.data._rebotados;
                  console.log(response.data);


        });
        
        
        $http.get("../reporte.php",{
             params: {tipo:'atendidoTabla'}
        }).then(function(response) {
               $scope.totalAtendidos=0;
                $scope.atendidoTabla=response.data;
                for(var i=0;i<=response.data.length;i++){
                    if(typeof response.data[i]!=="undefined")
                    $scope.totalAtendidos+=parseInt(response.data[i].total);
                }
                    $scope.loaded=true;
        });
   
   };
   $scope.onChange=function(){
       $scope.actualizar($scope.selectedSegmento);
   
    };
   $scope.actualizar(1);
  $interval(function(){
       $scope.actualizar($scope.selectedSegmento);
   },40000);
   
    
});
app.controller("dashboardPrecalificado",function($scope,$http,notificacion,$interval){
   $scope.series = ['Contactos','Llamadas'];
   $scope.labels = [];
   $scope.data = [[],[]];
   $scope.infoPre={};
   $scope.agentes={};
   $scope.loaded=false;
   $("#filtro").daterangepicker();
   $('#filtro').on('apply.daterangepicker', function(ev, picker) {
      var inicio=picker.startDate.format('YYYY-MM-DD');
      var fin=picker.endDate.format('YYYY-MM-DD');
      $scope.getByDate(inicio,fin);
      
  });
  
   $scope.getByDate=function(paramInicio,paramFin){
         $http.get("../reporte.php",{
             params: {tipo:'productividadDate',inicio:paramInicio,fin:paramFin}
        }).then(function(response) {
                 console.log(response.data);
                 $scope.agentes=response.data;
                 $scope.total_llamadas=0;
                 $scope.total_contactados=0;
                 $scope.total_citas=0;
                for(var i=0;i<$scope.agentes.length;i++){
                     $scope.total_llamadas+=parseInt($scope.agentes[i].llamadas);
                     $scope.total_contactados+=parseInt($scope.agentes[i].contactos);
                     $scope.total_citas+=parseInt($scope.agentes[i].citas);
                     $scope.labels[i]=$scope.agentes[i].nombre_completo.toUpperCase();
                     $scope.data[0][i]=$scope.agentes[i].contactos;
                     $scope.data[1][i]=$scope.agentes[i].llamadas;
                  }
                  $scope.loaded=true;
        });
   }
  
   $scope.actualizarPrecalificado=function(){
        $http.get("../php/api/infoPre.php").then(function(response) {
                  $scope.infoPre=response.data;
                  $scope.complete=true;
        });
        $http.get("../reporte.php",{
             params: {tipo:'productividad'}
        }).then(function(response) {
                 console.log(response.data);
                 $scope.agentes=response.data;
                 $scope.total_llamadas=0;
                 $scope.total_contactados=0;
                 $scope.total_citas=0;
                for(var i=0;i<$scope.agentes.length;i++){
                     $scope.total_llamadas+=parseInt($scope.agentes[i].llamadas);
                     $scope.total_contactados+=parseInt($scope.agentes[i].contactos);
                     $scope.total_citas+=parseInt($scope.agentes[i].citas);
                     $scope.labels[i]=$scope.agentes[i].nombre_completo.toUpperCase();
                     $scope.data[0][i]=$scope.agentes[i].contactos;
                     $scope.data[1][i]=$scope.agentes[i].llamadas;
                  }
                  notificacion.checkIfNotificacion("citasPrecal",$scope.total_citas,"Nueva cita precalificado");
                  $scope.loaded=true;
        });
   };
   $scope.actualizarPrecalificado();
    $interval(function(){
       $scope.actualizarPrecalificado();
   },40000);
});
app.controller("dashboardEncuesta",function($scope,notificacion,apiService,$interval){
     $scope.loaded=false;
    $scope.filtrarText="Filtrar";
    $scope.options = {title: {
                display: true,
                text: 'Calificaciones encuesta'
      }};
     $scope.options_motivo = {title: {
                display: true,
                text: 'Motivos no interes'
      }};
      $scope.options_financiera = {title: {
                display: true,
                text: 'Entidades financieras'
      }};
      $scope.labels = [];
      $scope.series = ['Contactos','Llamadas'];
      $scope.data = [[],[]];
      $scope.info={};
      $scope.labels_cal= ["Uno", "Dos", "Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez"];
      $scope.labels_motivo=["Cita ejecutivo","Sin fecha","Interes alto","Lo pensara","Luego pasa","Mal servicio"
      ,"Mas dinero","Mas tiempo","Mensualidad altal","Sin identificacion","No le interesa","No lo necesita","No tiene para pagar",
      "Pagando otro","Rechazaron","Renovo"];
      $scope.labels_financiera=[];
      $scope.data_financiera=[];
      $scope.data_cal = [];
      $scope.data_motivo=[];
      $("#filtro").daterangepicker();
      $('#filtro').on('apply.daterangepicker', function(ev, picker) {
           var inicio=picker.startDate.format('YYYY-MM-DD');
           var fin=picker.endDate.format('YYYY-MM-DD');

            $scope.filtrarFecha(inicio,fin);

       });
      //FUNCION PARA LIMPIAR LOS ARRAYS
      $scope.clear=function(){
           $scope.list_monitoreo={};
           $scope.data = [[],[]];
           $scope.labels = [];
           $scope.total_llamadas=0;
           $scope.total_contactados=0;
           $scope.total_citas=0;
           $scope.no_contactos=0;
           
        };
      //FUNCION PARA OBTENER EL MONITOREO ACTUAL
      $scope.getMonitoreo=function(){
          apiService.getInformacionGeneral().then(function(response){
                    $scope.info=response.data;
                    console.log("informacion");
                    console.log(response.data);
             });
           apiService.getMonitoreoCita(true).then(function(response){
               
               console.log(response.data);
               $scope.clear();
               $scope.list_monitoreo=response.data;
                for(var i=0;i<$scope.list_monitoreo.length;i++){
                     $scope.total_llamadas+=parseInt($scope.list_monitoreo[i].total_contactados);
                     $scope.total_contactados+=parseInt($scope.list_monitoreo[i].contactados);
                     $scope.total_citas+=parseInt($scope.list_monitoreo[i].citas);
                     $scope.labels[i]=$scope.list_monitoreo[i].nombre.toUpperCase();
                     $scope.data[0][i]=$scope.list_monitoreo[i].contactados;
                     $scope.data[1][i]=$scope.list_monitoreo[i].total_contactados;
                  }
                 notificacion.checkIfNotificacion("citasEncuesta",$scope.total_citas,"Nueva cita encuesta");
                 $scope.loaded=true;
              },function(response){

            });
        };
      //AL INICIO DE LLAMAR AL CONTROLADOR LLAMAMOS A ESTAS DOS FUNCIONES
      $scope.clear();
      $scope.getMonitoreo();
    
      //SE LLAMA A ESTA FUNCION CUANDO QUIERE FILTRAR 
      $scope.onFiltrar=function(){
          if($scope.filtrarText=="Filtrar"){
            $scope.filtrarFecha($scope.inicio,$scope.fin); 
          }
          else{
              $scope.filtrarText="Filtrar";
              $("#inputFin").val("");
              $("#inputInicio").val("");
              $scope.getMonitoreo();
          }
          console.log($scope.filtrarText);
      };
       //FUNCION PARA ACTUALIZAR EL MONITOREO CADA 20 SEGUNDOS
      $interval(function(){
             console.log("actualización");
             $scope.getMonitoreo();   
          
          
        },40000); 
       
      //FILTRAR FECHA 
      $scope.filtrarFecha=function(inicio,fin){
             apiService.getMonitoreoByDate(inicio,fin).then(function(response){
                console.log(response.data);
                $scope.clear();
                $scope.list_monitoreo=response.data;
                for(var i=0;i<$scope.list_monitoreo.length;i++){
                    $scope.total_llamadas+=parseInt($scope.list_monitoreo[i].total_contactados);
                    $scope.total_contactados+=parseInt($scope.list_monitoreo[i].contactados);
                    $scope.total_citas+=parseInt($scope.list_monitoreo[i].citas);
                    $scope.labels[i]=$scope.list_monitoreo[i].nombre.toUpperCase();
                    $scope.data[0][i]=$scope.list_monitoreo[i].contactados;
                    $scope.data[1][i]=$scope.list_monitoreo[i].total_contactados;
                  }
                  $scope.filtrarText="Dejar filtrar";
                 
            },function(response){

            });
       }
        
    
           
        apiService.getMotivo().then(function(response){
            
            console.log(response.data);
            $scope.data_motivo[0]=response.data[0].cita_ejecutivo;
            $scope.data_motivo[1]=response.data[0].int_sin_fecha;
            $scope.data_motivo[2]=response.data[0].interes_alto;
            $scope.data_motivo[3]=response.data[0].lo_pensara;
            $scope.data_motivo[4]=response.data[0].luego_pasa;
            $scope.data_motivo[5]=response.data[0].mal_servicio;
            $scope.data_motivo[6]=response.data[0].mas_dinero;
            $scope.data_motivo[7]=response.data[0].mas_tiempo;
            $scope.data_motivo[8]=response.data[0].mensualidad_alta;
            $scope.data_motivo[9]=response.data[0].no_identificacion;
            $scope.data_motivo[10]=response.data[0].no_interesa;
            $scope.data_motivo[11]=response.data[0].no_necesita;
            $scope.data_motivo[12]=response.data[0].no_tiene_pagar;
            $scope.data_motivo[13]=response.data[0].pagando_otro;
            $scope.data_motivo[14]=response.data[0].rechazo;
            $scope.data_motivo[15]=response.data[0].renovo;
            
            $scope.suma=0;
            for(var i=0;i<=$scope.data_motivo.length;i++){
                if(typeof $scope.data_motivo[i]!="undefined")
                $scope.suma+=parseInt($scope.data_motivo[i]);
            }
            $scope.options_motivo.title.text="Motivo no interes ("+$scope.suma+")";
            
            console.log($scope.options_motivo);
            
        });
        
        apiService.getCalificacion().then(function(response){
              console.log(response.data);
              $scope.data_cal[0]=response.data[0].uno;
              $scope.data_cal[1]=response.data[0].dos;
              $scope.data_cal[2]=response.data[0].tres;
              $scope.data_cal[3]=response.data[0].cuatro;
              $scope.data_cal[4]=response.data[0].cinco;
              $scope.data_cal[5]=response.data[0].seis;
              $scope.data_cal[6]=response.data[0].siete;
              $scope.data_cal[7]=response.data[0].ocho;
              $scope.data_cal[8]=response.data[0].nueve;
              $scope.data_cal[9]=response.data[0].diez;
              
            $scope.suma=0;
            for(var i=0;i<=$scope.data_cal.length;i++){
                if(typeof $scope.data_cal[i]!="undefined")
                $scope.suma+=parseInt($scope.data_cal[i]);
            }
            $scope.options.title.text="Calificaciones encuesta ("+$scope.suma+")";
              
        });
        
        apiService.getFinanciera().then(function(response){
           $scope.suma=0;
           $scope.count=0;
           for(var i=0;i<response.data.length;i++){
              if(typeof response.data[i]!="undefined"){
                if(parseInt(response.data[i].total)>5){
                    $scope.labels_financiera[$scope.count]=response.data[i].entidad_financiera;
                    $scope.data_financiera[$scope.count]=response.data[i].total;
                    $scope.suma+=parseInt($scope.data_financiera[$scope.count]);
                    $scope.count++;
                }
             }
           }
            $scope.options_financiera.title.text="Entidades financieras("+$scope.suma+") votos";
        });
    
 
 

    
  $scope.onUpdate=function(){
     $scope.update();  
   };
  
 

 

 
    
});
app.controller("dashboardCtrl",function($scope, $location,$http,$routeParams,$timeout){
   $scope.currentPage=1;
   $scope.onMenuChange=function(){
       $location.path($scope.currentPage);
   };
   $timeout(function(){
             //ENTRARON DESDE EL IFRAME ENCUESTA
        if(typeof $routeParams.usuario_encuesta!="undefined")
         {
              $scope.usuario_encuesta=$routeParams.usuario_encuesta;
              console.log($scope.usuario_encuesta);
              $http.get("../php/api/initLogin.php",{
                 params:{"usuario_encuesta":$scope.usuario_encuesta}
                }).then(function(response) {
                   $scope.usuario=response.data;
                   console.log(response.data);
                     if($scope.usuario.nivel_acceso==3){
                        $location.path("/sms");
                     }
            }); 
	}
       else{
            $http.get("../php/api/initLogin.php",{
                 params:{"usuario_pre":true}
                }).then(function(response) {
                   $scope.usuario=response.data;
                   console.log("respuesta usuarioo pre");
                   console.log(response.data);
            });
        }
       
   },100);
	
   
   $scope.onSalir=function(){
           window.location.href="../logout.php";
   };
   
    
    
   
   
});
app.controller("layoutCtrl",function($scope,$http,$timeout){
      $scope.seleccion={};
      $scope.seleccion.tipo=1;
      $scope.isLoading=false;
      $scope.layoutCargado=false;
      $scope.info={};
      $scope.guardarBD=function(){        
        $scope.isLoading=true;
        $scope.seleccion.nombre_archivo=$scope.nombre_archivo;
        $http({method: 'POST',
              async : true,
                url: "../php/api/emailing/enviar_layout.php",
                 data:JSON.stringify($scope.seleccion),
                 headers: {'Content-type': 'application/json'}
        }).success(function (data, status, headers, config) {
            $scope.isLoading=false;
            swal(
                'Gracias!',
                data,
                'success'
              );
           
          }).error(function (data, status, headers, config) {
                    swal(
                          'Uppss..',
                          data,
                          'error'
                        );
         });

      };
      $scope.analizar=function(){
          if(typeof $('#csv').prop('files')[0]=="undefined"){
              alert("Elige el archivo que enviaras");
              return;
          }
               $scope.isLoading=true;
                var file_data = $('#csv').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('csv', file_data);      
                form_data.append("tipo",$scope.seleccion.tipo);
                $.ajax({
                            url: '../php/api/emailing/encabezados.php', 
                            dataType: 'text', 
                            cache: false,
                            async: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'post',
                            success: function(response){
                               $scope.data=JSON.parse(response);
                               $scope.nombre_archivo=$scope.data.nombre_archivo;
                               $scope.isLoading=false;
                               $scope.layoutCargado=true;
                            },
                           error:function(response){
                                alert(response.responseText);
                           }
                 });
      };
      $scope.isEmpty=function(){
         return Object.keys($scope.seleccion).length===1;
      };
});
app.controller("smsCtrl",function($scope,$http){
    $scope.loaded=false;
    $scope.layoutInfo={};
    $scope.getLayoutInfo=function(){
          $http.get("../reporte.php",{
              params: {tipo:"layoutInfo"}
            }).then(function(response) {
                  $scope.layoutInfo=response.data;
                  $scope.loaded=true;
        });
    };
    $scope.getLayoutInfo();
});