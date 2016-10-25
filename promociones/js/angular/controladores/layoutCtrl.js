var app=angular.module('app',[]);

app.controller("layoutCtrl",function($scope,$http,$timeout){
      $scope.seleccion={};
      $scope.isLoading=false;
      $scope.layoutCargado=false;
           $scope.actualizarInfo=function(){
          $http.get("../php/api/info_general.php",{
      }).then(function(response) {
             $scope.data=response.data;
             $scope.info.ingresar_segmento=$scope.data.ingresar_segmento;
         });
     };
   $scope.actualizarInfo(1);
      $scope.guardarBD=function(){        
        $scope.isLoading=true;
        $scope.seleccion.nombre_archivo=$scope.nombre_archivo;
        $http({method: 'POST',
              async : true,
                url: "../php/api/encuesta/enviar_layout.php",
                 data:JSON.stringify($scope.seleccion),
                 headers: {'Content-type': 'application/json'}
        }).success(function (data, status, headers, config) {
            $scope.isLoading=false;
            alert(data);
            window.history.back();    
          }).error(function (data, status, headers, config) {
                     document.write(data);
         });

      };
      $scope.analizar=function(){
               $scope.isLoading=true;
                var file_data = $('#csv').prop('files')[0];   
                var form_data = new FormData();                  
                form_data.append('csv', file_data);                           
                $.ajax({
                            url: '../php/api/encuesta/encabezados.php', 
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
                                console.log(response);
                                $("#progress").fadeOut();
                           }
                 });
      };
      $scope.isEmpty=function(){
         return Object.keys($scope.seleccion).length===0;
      };
});


