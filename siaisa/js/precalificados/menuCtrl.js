var app=angular.module("menuApp",['chart.js']);
app.service("cache",function(){
   this.complete=false;
   this.selectedSegmento=1;   
});
app.controller("dashboardEmail",function($scope,$http,$interval,cache){
   
   $scope.info={};
   $scope.data=[];
   $scope.atendidoTabla={};
   $scope.selectedSegmento=1;
   $scope.cache=cache;
   $scope.cache.complete=false;
   $scope.labels=['abiertos','click interesa','click no interesa','baja','rebotados'];
   $scope.actualizar=function(id){

        $http.get("php/api/info_general.php",{
              params: {id_segmento:id,is_menu:true}
            }).then(function(response) {
                  $scope.info=response.data;
                  $scope.cache.complete=true;
                  $scope.info.nuevos=parseInt($("#nuevos").text().trim());
                  $scope.info.inbox=$scope.info.nuevos+parseInt(response.data.inbox);
                  $scope.info.pendientes=$scope.info.nuevos+parseInt(response.data.pendientes);
                  $.unblockUI();
        });

        $http.get("reporte.php",{
             params: {tipo:'grafica'}
        }).then(function(response) {
                  $scope.data[0]=response.data.abiertos;
                  $scope.data[1]=response.data.interesa;
                  $scope.data[2]=response.data.no_interesa;
                  $scope.data[3]=response.data.baja;
                  $scope.data[4]=response.data._rebotados;
                  console.log(response.data);


        });
        
        
        $http.get("reporte.php",{
             params: {tipo:'atendidoTabla'}
        }).then(function(response) {
               $scope.totalAtendidos=0;
                $scope.atendidoTabla=response.data;
                for(var i=0;i<=response.data.length;i++){
                    if(typeof response.data[i]!=="undefined")
                    $scope.totalAtendidos+=parseInt(response.data[i].total);
                }
               
        });
        
   };
   $scope.onChange=function(){
       $.blockUI({message:'<h1>Espera un momento...</h1>'});
       $scope.cache.selectedSegemento=$scope.selectedSegmento;
       $scope.actualizar($scope.selectedSegmento);
   
    };
   $scope.actualizar(1);
  $interval(function(){
       $scope.actualizar($scope.selectedSegmento);
   },40000);
   
    
});
app.controller("dashboardPrecalificado",function($scope,$http,cache,$interval){
   $scope.series = ['Contactos','Llamadas'];
   $scope.labels = [];
   $scope.data = [[],[]];
   $scope.infoPre={};
   $scope.agentes={};
   $scope.actualizarPrecalificado=function(){
        $http.get("php/api/infoPre.php").then(function(response) {
                  $scope.infoPre=response.data;
                  $scope.complete=true;
                  $.unblockUI();
        });
        $http.get("reporte.php",{
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
        });
   };
   $scope.actualizarPrecalificado();
    $interval(function(){
       $scope.actualizarPrecalificado();
   },40000);
});
app.controller("menuCtrl",function($scope,$http,cache){
   $scope.cache=cache;
    $scope.onChangeDashboard=function(){
        $scope.getSrc($scope.dashboard);  
    };
    $scope.src="dashboard/email.php";
    $scope.dashboard=0;
    $scope.getSrc=function(option){
         $.blockUI({message:'<h1>Espera un momento...</h1>'});
         switch(parseInt(option)){ 
            case 0:
                 $scope.src="dashboard/email.php";
                break;
            case 1:
                $scope.src="dashboard/precalificado.php";
                break;
                
        }
    };
   
});

