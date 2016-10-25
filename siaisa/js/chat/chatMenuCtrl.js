app.controller("chatMenuCtrl",function($scope,$timeout,apiService,$interval){
  
    
    $scope.options = {title: {
                display: true,
                text: 'Calificaciones encuesta'
      }};

      $scope.options_financiera = {title: {
                display: true,
                text: 'Entidades financieras'
      }};
      $scope.angularLoaded=false;
      $scope.labels = [];
      $scope.series = ['Contactos','Llamadas'];
      $scope.data = [[],[]];
      $scope.info={};
      $scope.labels_cal= ["Uno", "Dos", "Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez"];
      $scope.labels_motivo=["Cita ejecutivo","Sin fecha","Interes alto","Lo pensara","Luego pasa","Mal servicio"
      ,"Mas dinero","Mas tiempo","Mensualidad altal","Sin identificacion","No le interesa","No lo necesita","No tiene para pagar",
      "Pagando otro","Rechazaron","Renovo"];
      $scope.labels_financiera=[];
      $scope.data_financiera=[];
      $scope.data_cal = [];
      $scope.data_motivo=[];
      
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
          apiService.getInformacionChat().then(function(response){
                    $scope.info=response.data;
                    console.log("informacion");
                    console.log(response.data);
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
          
        },40000); 
       
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
        
    
           
        apiService.getMotivo().then(function(response){
            
            console.log(response.data);
            $scope.data_motivo[0]=response.data[0].cita_ejecutivo;
            $scope.data_motivo[1]=response.data[0].int_sin_fecha;
            $scope.data_motivo[2]=response.data[0].interes_alto;
            $scope.data_motivo[3]=response.data[0].lo_pensara;
            $scope.data_motivo[4]=response.data[0].luego_pasa;
            $scope.data_motivo[5]=response.data[0].mal_servicio;
            $scope.data_motivo[6]=response.data[0].mas_dinero;
            $scope.data_motivo[7]=response.data[0].mas_tiempo;
            $scope.data_motivo[8]=response.data[0].mensualidad_alta;
            $scope.data_motivo[9]=response.data[0].no_identificacion;
            $scope.data_motivo[10]=response.data[0].no_interesa;
            $scope.data_motivo[11]=response.data[0].no_necesita;
            $scope.data_motivo[12]=response.data[0].no_tiene_pagar;
            $scope.data_motivo[13]=response.data[0].pagando_otro;
            $scope.data_motivo[14]=response.data[0].rechazo;
            $scope.data_motivo[15]=response.data[0].renovo;
            
            $scope.suma=0;
            for(var i=0;i<=$scope.data_motivo.length;i++){
                if(typeof $scope.data_motivo[i]!="undefined")
                $scope.suma+=parseInt($scope.data_motivo[i]);
            }
            $scope.options_motivo.title.text="Motivo no interes ("+$scope.suma+")";
            
            console.log($scope.options_motivo);
            
        });
        apiService.getCalificacion().then(function(response){
              console.log(response.data);
              $scope.data_cal[0]=response.data[0].uno;
              $scope.data_cal[1]=response.data[0].dos;
              $scope.data_cal[2]=response.data[0].tres;
              $scope.data_cal[3]=response.data[0].cuatro;
              $scope.data_cal[4]=response.data[0].cinco;
              $scope.data_cal[5]=response.data[0].seis;
              $scope.data_cal[6]=response.data[0].siete;
              $scope.data_cal[7]=response.data[0].ocho;
              $scope.data_cal[8]=response.data[0].nueve;
              $scope.data_cal[9]=response.data[0].diez;
              
            $scope.suma=0;
            for(var i=0;i<=$scope.data_cal.length;i++){
                if(typeof $scope.data_cal[i]!="undefined")
                $scope.suma+=parseInt($scope.data_cal[i]);
            }
            $scope.options.title.text="Calificaciones encuesta ("+$scope.suma+")";
              
        });
        
        apiService.getFinanciera().then(function(response){
           $scope.suma=0;
           $scope.count=0;
           for(var i=0;i<response.data.length;i++){
              if(typeof response.data[i]!="undefined"){
                if(parseInt(response.data[i].total)>5){
                    $scope.labels_financiera[$scope.count]=response.data[i].entidad_financiera;
                    $scope.data_financiera[$scope.count]=response.data[i].total;
                    $scope.suma+=parseInt($scope.data_financiera[$scope.count]);
                    $scope.count++;
                }
             }
           }
            $scope.options_financiera.title.text="Entidades financieras("+$scope.suma+") votos";
        });
    
 
 

    
  $scope.onUpdate=function(){
     $scope.update();  
   };
  
 

 

 
    
});