var app=angular.module('app',[]);

app.controller("layoutCtrl",function($scope,$http,$timeout){
      $scope.seleccion={};
      $scope.isLoading=false;
      $scope.layoutCargado=false;
      
      $scope.enviarMail=function(){
          $http({method: 'POST',
              async : true,
                url: "../php/api/enviar_email.php",
                 data:JSON.stringify($scope.seleccion),
                 headers: {'Content-type': 'application/json'}
        }).success(function (data, status, headers, config) {
            $scope.isLoading=false;
            document.write(data); 
          }).error(function (data, status, headers, config) {
                     document.write(data);
         });
      };
      
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
           document.write(data);
           
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
                                console.log(response);
                                $("#progress").fadeOut();
                           }
                 });
      };
      $scope.isEmpty=function(){
         return Object.keys($scope.seleccion).length===0;
      };
});


