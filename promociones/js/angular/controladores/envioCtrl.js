var app=angular.module('app',[]);

app.controller("envioCtrl",function($scope,$http,$interval){
     $scope.opcionEnvio=1;
      $scope.info={};
      $scope.form={};
      $scope.formCandidato={};
      $scope.formCandidato.email='';
      $scope.segmentos={};
      $http.get("../php/api/segmentosD.php").then(function(response){
          $scope.segmentos=response.data;
          console.log(response.data);    
      });
      $scope.onChange=function(){
          $scope.actualizarInfo($scope.form.segmento.id_segmento);
      };
     $scope.actualizarInfo=function(segmento){
          $http.get("../php/api/info_general.php",{
              params: {id_segmento:segmento}
        }).then(function(response) {
             $scope.data=response.data;
             $scope.info.enviado=$scope.data.enviado;
             $scope.info.no_enviado=$scope.data.no_enviado;
         });
     };
     $scope.actualizarInfo(1);
    
     $scope.enviarFormSegmento=function(){
    
                    $.post( "../php/api/enviarEmail.php",{id_segmento:$scope.form.segmento.id_segmento,numero:$scope.form.numero}, function( data ) {
                      alert(data);
                    });
                    
                    $interval(function(){
                        $scope.actualizarInfo($scope.form.segmento.id_segmento);
                    },700);
      };
     
     $scope.enviarFormUsuario=function(){
            
                    
                    $.post( "../php/api/enviarEmail.php",{id_candidato:$scope.formCandidato.id,email:$scope.formCandidato.email}, function( data ) {
                      alert(data);
                    });
         
      };

       var source = new EventSource("../php/api/envioEvent.php");
                    source.onmessage = function(event) {   
                    $("#enviados").html(event.data);
                    
        };
});