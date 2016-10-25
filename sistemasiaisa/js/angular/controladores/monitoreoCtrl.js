
app.controller("monitoreoCtrl",function($scope,apiService,$interval){
     
       $scope.labels = [];
       $scope.series = ['Contactos','Llamadas'];
       $scope.data = [[],[]];
       $scope.filtrarText="Filtrar";
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
                 $scope.angularLoaded=true;
              },function(response){

            });
        };
      //AL INICIO DE LLAMAR AL CONTROLADOR LLAMAMOS A ESTAS DOS FUNCIONES
      $scope.clear();
      $scope.getMonitoreo();
      //FUNCIONES PARA OBTENER LOS VALORES DE LA FECHA CUANDO SELECCIONEN EN LOS 
      //DATEPICKER
      rome(inputFin, {time:false }).on('data',function(value){  
        $scope.fin=$("#inputFin").val();
       });
      rome(inputInicio, {time:false }).on('data',function(value){         
                
         $scope.inicio=$("#inputInicio").val();
      });
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
      }
       //FUNCION PARA ACTUALIZAR EL MONITOREO CADA 20 SEGUNDOS
      $interval(function(){
          if($scope.filtrarText=="Filtrar"){
             console.log("actualización")
             $scope.getMonitoreo();   
          }
          
        },20000); 
       
      //FILTRAR FECHA 
      $scope.filtrarFecha=function(inicio,fin){
             apiService.getMonitoreoByDate(inicio,fin).then(function(response){
                console.log(response.data)
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
        
    
       
      //FUNCION PARA OBTENER LA INFORMACION ACTUAL DEL AGENTE
      apiService.getAgente().then(function(response){    
           console.log("RESPUESTA AGENTE");
           $scope.agente=response.data;
           console.log($scope.agente);
         },function(response)
         { 
             alert(response.data);
             window.location.href="index.php";
       });
       
     $scope.descargar=function(){
         $("#tablaReporte").tableToCSV();
     };
     
     
});

