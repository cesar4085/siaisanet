 app.controller("controlador",function($scope,$window,$timeout,anchorSmoothScroll,apiService){
       
     //INICIALIZACIÓN DE VARIABLES
       $scope.isPopupOpen=false;
       $scope.angularLoaded=false;
       $scope.promesas=[];//Array de promesas
       $scope.cliente={};
       $scope.bitacora={};
       $scope.agente={};
       $scope.historial={};
       $scope.contactacion={};
       $scope.fecha_importe=new Date();
       $scope.celularValidado=false;
       $scope.fijoValidado=false;
       //LLAMADAS A LA API
       apiService.getCliente().then(function(response){
             
               $scope.cliente=response.data;           
               apiService.getBitacoraHistorial($scope.cliente.id_cliente).then(function(response){
                  
                   $scope.angularLoaded=true;
                   $scope.historial=response.data
               },function(response){
                   
               });
         },function(response){  
            $timeout(function(){
               $scope.angularLoaded=true;
               $.notiny({ text: response.data, position: 'fluid-bottom' });
            },500)
       });
       apiService.getAgente().then(function(response){    
           console.log("RESPUESTA AGENTE");
           $scope.agente=response.data;
         },function(response)
       { 
             alert(response.data);
             window.location.href="index.php";
       });      
       //COMPORTAMIENTO DE LA PÁGINA
       $scope.onPropuesta=function(){
           
           anchorSmoothScroll.scrollTo("#informacion_credito","#importe"); 
         };
       $scope.onContacto=function(){
              $scope.bitacora.contacto=1;
              anchorSmoothScroll.scrollTo("#script_credito");                   
         };
       $scope.onContactoNo=function(){
               $scope.bitacora.contacto=0;
               anchorSmoothScroll.scrollTo("#motivo_no_contacto"); 
         };
       $scope.onPropuestaNo=function(){
              anchorSmoothScroll.scrollTo("#negativa"); 
         };
       $scope.statusChange=function(){
             $timeout(function(){
                    if(parseInt($scope.bitacora.id_status_llamada)===1){
                        $scope.celularValidado=true;
                        $scope.fijoValidado=true;
                        $scope.bitacora.inicio= moment(new Date()).format("YYYY-MM-DD HH:mm:ss");
                         $scope.bitacora.contacto=0;
                        anchorSmoothScroll.scrollTo("#presentacion");
                      }
                      else{
                            $scope.bitacora.contacto=0;
                      }
               },100);
         };
       $scope.tipoChange=function(){
             $scope.bitacora.id_status_llamada=undefined;
         };
       $scope.agregarPromesa=function(){
             console.log("FECHA");
             $scope.promesa={};//Objeto promesa
             $scope.promesa.importe=$scope.cliente.importe_negociado;   
             $scope.promesa.fecha=angular.element(document.querySelector('#fecha_label')).text();
             $scope.promesas.push($scope.promesa);
             $scope.cliente.importe_negociado="";
         };  
       $scope.eliminarPropuesta=function(index){
             $scope.promesas.splice(index,1);
         }      
       //VALIDA QUE EL AGENTE MARQUE A TELEFONO O CELULAR
       /*
       $scope.validarLlamada=function(){
             //Celular
             if(parseInt($scope.bitacora.id_tipo_llamada)===1 && parseInt($scope.bitacora.id_status_llamada)!==1){
               if($scope.fijoValidado===false){
                    $.notiny({ text: "Intenta con el telefono fijo", position: 'fluid-bottom' });
                }
               $scope.bitacora.contacto=0;
               $scope.celularValidado=true;
                
             }
             //Telefono fijo
             else if(parseInt($scope.bitacora.id_tipo_llamada)===2 && parseInt($scope.bitacora.id_status_llamada)!==1) {
                 if($scope.celularValidado===false){
                      $.notiny({ text: "Intenta con el telefono celular", position: 'fluid-bottom' });
                } 
              $scope.bitacora.contacto=0;
              $scope.fijoValidado=true;
                
             }
             
         };
       //ACTIVA EL BOTÓN GUARDAR SI ES QUE LOS TELEFONOS HAN SIDO VALIDADOS
       $scope.telefonosValidados=function(){
            return $scope.celularValidado && $scope.fijoValidado;
       }; */
       $scope.guardarLlamada=function(){
            $scope.bitacora.fin= moment(new Date()).format("YYYY-MM-DD HH:mm:ss");
            $scope.bitacora.id_cliente=$scope.cliente.id_cliente;
            $scope.bitacora.id_agente=$scope.agente.id_agente;
            $scope.finalData=angular.extend($scope.cliente,$scope.bitacora);
            $scope.finalData.promesas=$scope.promesas;
            console.log("JSON");
            console.log($scope.finalData);
             apiService.guardarInformacion($scope.finalData).success(function (data, status, headers, config) {
                document.write(data);
              /*  apiService.getContactacion().then(function(response){
                $scope.contactacion=response.data[0];
                $scope.contactacion.total=parseInt($scope.contactacion.Contactados)+parseInt($scope.contactacion.No_contactados);
                angular.element('#contactacion').trigger('click');  
               },function(response){
                   
               });
                 */  
            }).error(function (data, status, headers, config) {
                    document.write(data);
           });
       };      
       $scope.reloadPage=function(){
           window.location.reload();
       }
       



                  
 });