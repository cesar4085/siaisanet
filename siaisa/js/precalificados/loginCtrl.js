var app=angular.module('appBm', ['ngMaterial']);
app.controller("loginCtrl",function($scope,$http,$mdToast){
   $scope.usuario={};
   $("html").fadeIn(500);
   $scope.iniciarSesion=function(){
       
       if(typeof $scope.usuario.nombre==="undefined"){
            $scope.mostrarToast('Ingresa tu nombre de  usuario');
       }
       else if(typeof  $scope.usuario.password==="undefined"){
           $scope.mostrarToast('Ingresa tu password');
       }
       else{
           
           if($scope.usuario.nombre==="" || $scope.usuario.password===""){
               $scope.mostrarToast("Ingresa tu nombre de usuario y password");
               return;
           }
           
            $http({method: 'POST',
               async : true,
               url: "php/api/initLogin.php",
               data:JSON.stringify($scope.usuario),
               headers: {'Content-type': 'application/json'}
              }).success(function (data, status, headers, config) {
                  $("html").fadeOut(500,function(){
                      window.location.href="menu.php"; 
                      
                  });
              }).error(function (data, status, headers, config) {
                       $scope.mostrarToast(data);
             });
       }
     
   };    
   $scope.mostrarToast=function(mensaje){
        $mdToast.show($mdToast.simple().textContent(mensaje));
   };
    
});