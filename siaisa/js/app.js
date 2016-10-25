var app=angular.module('app', ["ngAnimate","ui.bootstrap","chart.js"]).config(function() {
        new WOW().init();
 });
 app.filter('singleDecimal', function ($filter) {
    return function (input) {
        if (isNaN(input)) return input;
        return Math.round(input * 10) / 10;
    };
});
app.directive('soloNumeros', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});
app.service("apiService", function($http){
this.getInformacionChat=function(){
return $http.get("../php/api/chat/getInfoChat.php");
}
});
app.service("apiService",function($http){
   this.getInformacionGeneral=function(){
       return $http.get("../php/api/encuesta/getInfoGeneral.php");
   }
 this.getInformacionChat=function(){
return $http.get("../php/api/chat/getInfoChat.php");
}
   this.getClienteEncuesta=function(){
       return $http.get("../php/api/encuesta/getCliente.php")
   };
   this.getClienteEncuestaById=function(param){
       return $http.get("../php/api/encuesta/getCliente.php",{
           params:{id_cliente:param}
       });
   };
   this.getCalificacion=function(){
        return $http.get("../reporte.php",{
           params:{tipo:"calificacion"}
       });
   };
   this.getMotivo=function(){
        return $http.get("../reporte.php",{
           params:{tipo:"motivo"}
       });
   };
   this.getFinanciera=function(){
       return $http.get("../reporte.php",{
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
                    url: "../php/api/encuesta/getBitacora.php",
                    data:data,
                   
        });
   };
    this.guardarLlamadaEncuesta=function(data){
         return $http({
                    method: 'POST',
                    url: "../php/api/encuesta/guardarInfo.php",
                    async : true,
                    data:JSON.stringify(data),
                    headers: {'Content-type': 'application/json'}
        });
   }
   this.getCliente=function(){
        return $http.get("../php/api/getCliente.php");
   };
   
   
   
    this.getMonitoreo=function(){
       return $http.get("../php/api/getMonitoreo.php");
   };
    this.getMonitoreoByDate=function(param,paramDos){
       return $http.get("../php/api/getMonitoreo.php",{
                 params: {fecha_inicio:param,fecha_fin:paramDos  }
            });
   };
   this.getMonitoreoCita=function(param){
       return $http.get("../php/api/getMonitoreo.php",{
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
   }
   
    
   this.guardarInformacion=function(data){
       return $http({
                    method: 'POST',
                    url: "../php/api/guardarInfo.php",
                    async : true,
                    data:JSON.stringify(data),
                    headers: {'Content-type': 'application/json'}
        });
   };
   this.getAgente=function(){
       return $http.get("../php/api/getAgente.php");
   };
   this.getContactacion=function(){
     return $http.get("../php/api/getContactacion.php");
   }
   
});
app.service("encuestaService",function(anchorSmoothScroll){
  
         //COMPORTAMIENTO DE LA PÁGINA
         $scope.onNuevaInfo=function(){
        anchorSmoothScroll.scrollTo("#info_nueva_cli");
       };
       this.onEnterado=function(){
           anchorSmoothScroll.scrollTo("#enterado"); 
         };
       this.onContacto=function(){
              this.contacto=1;
              anchorSmoothScroll.scrollTo("#script_credito");                   
         };
       this.onContactoNo=function(){
               this.contacto=0;
               anchorSmoothScroll.scrollTo("#motivo_no_contacto"); 
         };
       this.onEnteradoNo=function(){
              anchorSmoothScroll.scrollTo("#informacion_credito"); 
         };
       this.onMedioChange=function(){
            $scope.medioEnterado='true';
            $timeout(function(){
               anchorSmoothScroll.scrollTo("#informacion_credito");
           },500);
        }
       this.onInteresariaCredito=function(){
        $timeout(function(){
          switch(parseInt($scope.interesaria_creditoOpcion)){
              case 0:
                   anchorSmoothScroll.scrollTo("#manejo_objeciones");
              break;
              case 1: 
              case 3:
                   anchorSmoothScroll.scrollTo("#cita");
                  break;      
                case 2:
                case 4:
                case 5:
                    anchorSmoothScroll.scrollTo("#encuesta");
                break;             
             }
         },500);
        };
       this.onRecomendar=function(){
           $timeout(function(){ 
                anchorSmoothScroll.scrollTo("#recomendado");
            },500);
        }
       this.onRecomendarNo=function(){
            $timeout(function(){
                anchorSmoothScroll.scrollTo("#cierre");
            },500)
        }
       this.onManejoObjeciones=function(){
            var id_manejo=$scope.manejoObjeciones;
            var element="#manejo_objeciones_"+id_manejo;
            $timeout(function(){
                    anchorSmoothScroll.scrollTo(element);
            },500);
            
        };
       this.onprogramarCita=function(){
            anchorSmoothScroll.scrollTo("#programar_cita");
        }
       
    
});
app.service('anchorSmoothScroll', function(){

            this.scrollTo = function(eID,focusElement) {
                
                 $('html, body').animate({
                    scrollTop: $(eID).offset().top
                  }, 800, function(){
                    
                    if(typeof focusElement!="undefined"){
                       angular.element(document.querySelector(focusElement)).focus(); 
                    }
                  });
                 
            };

 });
 
  app.directive('soloNumeros', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9]/g, '');

                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});