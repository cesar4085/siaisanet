var app = angular.module('app', ['ui.bootstrap']);
app.service("apiService", function($http) {
    this.getColonias = function() {
        var data = new FormData();
        data.append("tipo", "getColonias");
        var promise = $http({
            method: 'POST',
            async:true,
            url: "../php/api/codigos.php",
            data: data,
            headers: {
                'Content-Type': undefined
            }
        }).success(function(data, status, headers, config) {
            return data;
        }).error(function(data, status, headers, config) {
            return data;
        });
        return promise;
    };
    this.getDelegaciones = function() {
        var data = new FormData();
        data.append("tipo", "getDelegaciones");
        var promise = $http({
            method: 'POST',
            url: "../php/api/codigos.php",
            data: data,
            headers: {
                'Content-Type': undefined
            }
        }).success(function(data, status, headers, config) {
            return data;
        });
        return promise;
    };
    this.getCodigos = function() {
        var data = new FormData();
        data.append("tipo", "getCodigos");
        var promise = $http({
            method: 'POST',
            url: "../php/api/codigos.php",
            data: data,
            headers: {
                'Content-Type': undefined
            }

        }).success(function(data, status, headers, config) {
            return data;
        }).error(function(data) {

        });
        return promise;
    };
    this.getData = function(cp) {
        var data = new FormData();
        data.append("tipo", "getData");
        data.append("cp", cp);
        var promise = $http({
            method: 'POST',
            url: "../php/api/codigos.php",
            data: data,
            headers: {
                'Content-Type': undefined
            }
        }).success(function(data, status, headers, config) {
            console.log("Data" + data);
            return data;
        }).error(function(data, status, headers, cofig) {
            return data;
        });
        return promise;
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
app.controller("prospectoCtrl", function($scope,$http, apiService) {
   $scope.prospecto={};
    $scope.angularLoaded=false;
   $scope.cliente={};
   $scope.codigos=new Array();
   $scope.colonias=[];
   $scope.delegaciones={};
   $scope.modelOptions = {
        debounce: {
          blur: 250
        },
        getterSetter: true
      };
    //DATEPICKER PLUGIN ROME.JS
       rome(cita, {time: true, min: new Date() }).on('data',function(value){         
             $scope.prospecto.cita=value;
                
        });
   $scope.ngModelOptionsSelected = function(value) {
  
      if (arguments.length){
            $scope.prospecto.cp=value;
            $scope.cp_invalido=false;
            apiService.getData($scope.prospecto.cp).then(function(response){
                     
                            if(response.data.length>0)
                            {
                                console.log(response.data);
                                $scope.colonias.length=0;
                                $scope.cp_invalido=false;
                                for(var i=0;i<response.data.length;i++){
                                    $scope.colonias[i]=response.data[i].colonia;
                                }
                                $scope.prospecto.colonia=response.data[0].colonia;
                                $scope.prospecto.delegacion=response.data[0].delegacion;
                                $scope.prospecto.sucursal=response.data[0].sucursal;
                            }
 
                          });
       } 
       else {
        return $scope.prospecto.cp;
      }
    };
   $http.get("../php/api/test-prospecto.php",{
           params:{tipo:'getProspecto'}
   }).then(function(response){
      $scope.cliente=response.data;
      $scope.angularLoaded=true;
   });
   apiService.getCodigos().then(function(response){
           for(var i=0;i<response.data.length;i++){
                             $scope.codigos.push(response.data[i].cp);
          }
    }); 
   apiService.getDelegaciones().then(function(response){
         $scope.delegaciones=response.data;
   });
   $scope.cp_invalido=false;
   $scope.exitsCp=function(cp){
    if(cp.length>=4){
        if($scope.codigos.indexOf(cp)===-1){ 
             $scope.cp_invalido=true;
        }
        else{
            $scope.cp_invalido=false;
        }
    }
    else{
        $scope.cp_invalido=false;
    }
   };
   
 

});