var app=angular.module('app',[]);
app.service("apiService",function($http){
    this.getInbox=function(){
    
       return $http.get("../php/api/ImapApi.php",{
           params:{tipo:'inbox'}
       });
   
    };
    
    this.getBodyEmail=function(uidParam,id_inboxParam){
          return $http.get("../php/api/ImapApi.php",{
           params:{tipo:'body',uid:uidParam,id_inbox:id_inboxParam,read:true}
       });
    };
    this.getInfoById=function(id_inboxParam){
         return $http.get("../php/api/ImapApi.php",{
           params:{tipo:'info',id_inbox:id_inboxParam}
       });
    };
    
});
app.controller("respuestaCtrl",function($scope,apiService){
      $scope.mensajeError="";
      $scope.onActualizar=function(){
          apiService.getInbox().then(function(response){
           

            $scope.inboxBandeja={};
            $scope.currentEmail={};
            $scope.respuesta={};
            $scope.inboxCount=0;
            $scope.pendienteCount=0;
            $scope.atendidoCount=0;
            $scope.currentEmailId=0;
            $scope.indexList=0;
            $scope.inboxBandeja=response.data;
            for(var i=0;i<$scope.inboxBandeja.length;i++){
                switch(parseInt($scope.inboxBandeja[i].status)){
                    case 0:
                        $scope.inboxCount++;
                       break;
                   case 1:
                       $scope.pendienteCount++;
                       break;
                   case 2:
                       $scope.atendidoCount++;
                       break;
                }
            }
          });
      };
      $scope.onActualizar();
      $scope.clickEmaiInbox=function(indexList,uid,id_inbox,fromInBox){
         apiService.getBodyEmail(uid,id_inbox).then(function(response){
                   $scope.currentEmailId=id_inbox;
                   $scope.indexList=indexList;
                    setTimeout(function(){
                        $('#previewEmail').contents().find('body').html(response.data);
                    
                        
                    },50);
                    
                     if(fromInBox===true){
                            $scope.inboxBandeja[indexList].status=1;
                            
                            if($scope.inboxCount>0){
                                $scope.inboxCount--;
                                $scope.pendienteCount++;
                            }
                    }
               
           });
      };
      
      $scope.onRespuesta=function(){
               if($scope.currentEmailId===0){
                   alert("Elige el email que deseas responder");
               }else{
                 apiService.getInfoById($scope.currentEmailId).then(function(response){
                        $scope.currentEmail=response.data;
                        $scope.respuesta.id_inbox=$scope.currentEmail[0].id_inbox;
                        $scope.respuesta.to=$scope.currentEmail[0].email;
                        $scope.respuesta.asunto=$scope.currentEmail[0].asunto;
                        $('#modalRespuesta').modal('show');
                 });
             }
         };
         
      $scope.enviarRespuesta=function(){
           if(typeof $scope.respuesta.status==="undefined"){
                $scope.mensajeError="Selecciona un estatus valido";
                }
                else if(typeof $scope.respuesta.mensaje==="undefined"){
                  $scope.mensajeError="Escribe el mensaje";
                }
                else{
                      $.post("../php/api/ImapApi.php", {status:$scope.respuesta.status,asunto:$scope.respuesta.asunto,to:$scope.respuesta.to, mensaje:$scope.respuesta.mensaje,id_inbox:$scope.respuesta.id_inbox })
                            .done(function(data) {
                              $scope.mensajeError="";
                              $scope.onActualizar();
                              $('#modalRespuesta').modal('hide');
                              alert('Enviado correctamente' );
                         });
                }
                
      };
        
});
