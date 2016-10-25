app.controller("encuestaCtrl",function($scope,$window,$timeout,anchorSmoothScroll,apiService){
       
     //INICIALIZACIÓN DE VARIABLES
       $scope.angularLoaded=false;
       $scope.isGuardando=false;
       $scope.isActivo=false;
       
       //INFORMACIÓN DE LA ENCUESTA QUE SE ALMACENARÁ EN LOS SIGUIENTES ARRAYS
       $scope.cliente={};
       $scope.opcion={};
       $scope.bitacora={};
       $scope.datalleContacto={};
       $scope.agente={};
       $scope.contactacion={};
       $scope.historial={};
       $scope.interes_credito={};
       $scope.manejo_objecion={};
       $scope.prospecto={};
       $scope.encuesta={};
       $scope.encuesta.finalShow=false;
       $scope.interes_credito.manejo_objecion=0;
       $scope.contactacion={};
       
       //DATEPICKER PLUGIN ROME.JS
       rome(inputCita1, {time: true, min: new Date() }).on('data',function(value){         
               $scope.interes_credito.agendar_cita=value;
               console.log("Selected date cita"+$scope.interes_credito.agendar_cita);
                
        });
       rome(inputCita2,{ time: true, min: new Date()}).on("data",function(value){
             $scope.interes_credito.agendar_cita=value;
             console.log("Selected date cita manejo objecion"+$scope.manejo_objecion.agendar_cita)
         });
       
    //LLAMADAS A LA API
 
    //ENTRARON DESDE EL MODULO DE BUSQUEDA
    //OBTENEMOS EL ID DEL CLIENTE DESDE EL LOCAL STORE
    //LO ELIMINAMOS
    if(localStorage.getItem("id_clienteBusqueda")!=null){
       console.log("not null");
       $scope.id_clienteBusqueda=localStorage.getItem("id_clienteBusqueda");
       console.log($scope.id_clienteBusqueda);
       localStorage.removeItem("id_clienteBusqueda");
       apiService.getClienteEncuestaById($scope.id_clienteBusqueda).then(function(response){
           $scope.cliente=response.data;
           apiService.getBitacoraHistorial($scope.cliente.id_cliente).then(function(response){
                   $scope.angularLoaded=true;
                   $scope.historial=response.data
               },function(response){    
            });
         },function(response){  
            $timeout(function(){
               $scope.angularLoaded=true;
               $scope.mensajeServer=response.data;
               angular.element("#noClientes").trigger("click");
            },500);
       });
    }
    // NO HAY NINUNA KEY EN LOCAL STORAGE 
    else{
       
           apiService.getClienteEncuesta().then(function(response){
           $scope.cliente=response.data;
           apiService.getBitacoraHistorial($scope.cliente.id_cliente).then(function(response){
                   $scope.angularLoaded=true;
                   $scope.historial=response.data
               },function(response){    
            });
         },function(response){  
            $timeout(function(){
               $scope.angularLoaded=true;
               $scope.mensajeServer=response.data;
               angular.element("#noClientes").trigger("click");
            },500);
       });
    }
    
    
    
    /*  
    */
       apiService.getAgente().then(function(response){    
           console.log("RESPUESTA AGENTE");
           $scope.agente=response.data;
         },function(response)
       { 
             alert(response.data);
             window.location.href="index.php";
       });      
      $scope.guardarLlamada=function(){
             $scope.isActivo=false;
             $scope.bitacora.id_cliente=$scope.cliente.id_cliente;
             $scope.bitacora.nombre_cliente=$scope.cliente.nombre;
             $scope.bitacora.no_contrato=$scope.cliente.no_contrato;
             $scope.bitacora.id_agente=$scope.agente.id_agente; 
             $scope.bitacora.nombre_agente=$scope.agente.nombre_completo;
             
             
             $scope.bitacora.type="todo";
             $scope.data=angular.extend($scope.datalleContacto,$scope.bitacora);
             $scope.data_dos=angular.extend($scope.data,$scope.interes_credito);
             $scope.data_tres=angular.extend($scope.manejo_objecion,$scope.data_dos);
             $scope.data_cuatro=angular.extend($scope.prospecto,$scope.data_tres);
             $scope.finalData=angular.extend($scope.encuesta,$scope.data_cuatro);
              
             console.log("Detalle contacto:"+$scope.isEmpty($scope.datalleContacto));
             console.log("Interes crédito:"+$scope.isEmpty($scope.interes_credito));
             console.log("Manejo objecion:"+$scope.isEmpty($scope.manejo_objecion))
             console.log("Prospectos"+$scope.isEmpty($scope.prospecto));
          
    
            apiService.guardarLlamadaEncuesta($scope.finalData).success(function (data, status, headers, config) {
              
    
              apiService.getContactacion().then(function(response){
                      $scope.contactacion=response.data[0];
                      console.log($scope.contactacion);
                      angular.element('#contactacion').trigger('click');
                      $scope.isActivo=true;
                  },function(response){
                   
                 });
                  
                
                 
              }).error(function (data, status, headers, config) {
                        document.write("Ha ocurrido el siguiente error"+data);
            });
           
      
            
          
       };      
      $scope.reloadPage=function(){
           window.location.reload();
       };
      //COMPORTAMIENTO DE LA PÁGINA
      $scope.onEnterado=function(){
           $scope.interes_credito.id_enterado=1;
           anchorSmoothScroll.scrollTo("#enterado"); 
      };
     $scope.onEnteradoNo=function(){
              //RESET FORMULARIO VERIFICAMOS SI YA HABIA INGRESADO EL ID DE ENTERADO ANTERIORMENTE
              $scope.interes_credito.id_enterado=0;
              anchorSmoothScroll.scrollTo("#informacion_credito"); 
      };
      $scope.onContacto=function(){
              $scope.bitacora.contacto=1;
              //VERIFICAMOS SI HAY ALGUN ID DE NO CONTACTO
              if(typeof $scope.datalleContacto.id_motivo_no_contacto!='undefined'){
                $scope.datalleContacto.id_motivo_no_contacto=undefined;
              }
              $scope.opcion.contactoOpcion=true;
              $timeout(function(){
                anchorSmoothScroll.scrollTo("#script_credito");                
              },500);
                 
         }; //objecion 5 y 6 
      $scope.onContactoNo=function(){
               $scope.bitacora.contacto=0;
              // $scope.limpiarTodoFormulario();
               $scope.opcion.contactoOpcion=false;
               $timeout(function(){
                       anchorSmoothScroll.scrollTo("#motivo_no_contacto"); 
               },500);
           
         };
      $scope.onMedioChange=function(){
            $scope.medioEnterado='true';
            $timeout(function(){
               anchorSmoothScroll.scrollTo("#informacion_credito");
           },500);
        } 
      $scope.onInteresariaCredito=function(){
        $timeout(function(){
          switch(parseInt($scope.interes_credito.tipo))
          {
              case 0:
                  $timeout(function(){
                     anchorSmoothScroll.scrollTo("#manejo_objeciones");
                  },500);
              break;
              case 1: 
              case 3:
                 $scope.manejoObjeciones={};
                 anchorSmoothScroll.scrollTo("#cita");
                 break;      
                case 2:
                case 4:
                case 5:
                    $scope.manejoObjeciones={};
                    anchorSmoothScroll.scrollTo("#encuesta");
                break;             
          }
          
         },500);
        };
      $scope.onRecomendar=function(){
           $timeout(function(){ 
                anchorSmoothScroll.scrollTo("#recomendado");
            },500);
        }
      $scope.onRecomendarNo=function(){
            $timeout(function(){
                anchorSmoothScroll.scrollTo("#cierre");
            },500);
        };
      $scope.onManejoObjeciones=function(){
            var id_manejo=$scope.interes_credito.manejo_objecion;
            var element="#manejo_objeciones_"+id_manejo;
            $timeout(function(){
                    anchorSmoothScroll.scrollTo(element);
            },500);
            
        };
      $scope.onprogramarCita=function(){
            anchorSmoothScroll.scrollTo("#programar_cita");
        };
      $scope.onEncuesta=function(){
         $timeout(function(){
              anchorSmoothScroll.scrollTo("#recomendarProducto");
         },500);
         
      };
      $scope.onRecomendarFamiliar=function(){
          $timeout(function(){
              anchorSmoothScroll.scrollTo("#tomadoCredito");
          },500);
      };
      $scope.onTomadoCredito=function(){
          $timeout(function(){
              anchorSmoothScroll.scrollTo("#entidadFinanciera"); 
          },500);
      };
      $scope.onEntidadFinanciera=function(){
          $scope.encuesta.finalShow=true;
          $scope.isActivo=true;
          $timeout(function(){
              anchorSmoothScroll.scrollTo("#finalEncuesta");
          },500);
      };
      $scope.statusChange=function(){
             $timeout(function(){
                    //CASO CONTESTAN TELÉFONO
                    if(parseInt($scope.bitacora.id_status_llamada)===1){
                       $scope.bitacora.contacto=1;
                       anchorSmoothScroll.scrollTo("#presentacion");
                       $scope.isActivo=false;
                       
                      }
                      else{
                           //LIMPIAMOS TODOS LOS DATOS DE LA BITACORA
                           $scope.bitacora.contacto=0;
                           $scope.isActivo=true;
                           
                      }
                      
               },100);
         };
      $scope.tipoChange=function(){
             $scope.bitacora.id_status_llamada=undefined;
      };  
      $scope.onprogramarCitaNo=function(){
        $timeout(function(){
              anchorSmoothScroll.scrollTo("#encuesta");
          },500);  
      };
          
        
      $scope.limpiarTodoFormulario=function(){
        $scope.datalleContacto={};
        $scope.historial={};
        $scope.interes_credito={};
        $scope.manejo_objecion={};
        $scope.prospecto={};
        $scope.encuesta={};
        $scope.opcion={};
      };
      
      
      
      $scope.isEmpty=function(obj){
          return Object.keys(obj).length === 0;
      };
      

      $scope.llamadaInvalida=function(){
          return $scope.isActivo===false;
      };

                  
 });