var app=angular.module("app",[]);
app.service('anchorSmoothScroll', function() {

    this.scrollTo = function(eID, focusElement) {

        $('html, body').animate({
            scrollTop: $(eID).offset().top
        }, 800, function() {

            if (typeof focusElement != "undefined") {
                angular.element(document.querySelector(focusElement)).focus();
            }
        });

    };

});
app.service("apiService", function($http) {
    this.getInformacionGeneral = function() {
        return $http.get("../php/api/encuesta/getInfoGeneral.php");
    };
    this.getClienteEncuesta = function() {
        return $http.get("../php/api/test-prospecto.php", {
            params: {
                tipo: 'getProspecto'
            }
        });
    };
    this.getClienteEncuestaByFolio = function(param) {
        return $http.get("../php/api/test-prospecto.php", {
            params: {
                folio: param
            }
        });
    };
    this.getCalificacion = function() {
        return $http.get("../reporte.php", {
            params: {
                tipo: "calificacion"
            }
        });
    };
    this.getMotivo = function() {
        return $http.get("../reporte.php", {
            params: {
                tipo: "motivo"
            }
        });
    };
    this.getFinanciera = function() {
        return $http.get("../reporte.php", {
            params: {
                tipo: "financiera"
            }
        });
    };
    this.getBitacoraHistorial = function(id_cliente) {
        var data = new FormData();
        data.append("id_cliente", id_cliente);
        return $http({
            method: 'POST',
            async: true,
            headers: {
                'Content-Type': undefined
            },
            transformRequest: angular.identity,
            url: "../php/api/encuesta/getBitacora.php",
            data: data,

        });
    };
    this.guardarLlamadaEncuesta = function(data) {
        return $http({
            method: 'POST',
            url: "../php/api/guardarInfo.php",
            async: true,
            data: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json'
            }
        });
    };
    this.getCliente = function() {
        return $http.get("../php/api/getCliente.php");
    };



    this.getMonitoreo = function() {
        return $http.get("../php/api/getMonitoreo.php");
    };
    this.getMonitoreoByDate = function(param, paramDos) {
        return $http.get("../php/api/getMonitoreo.php", {
            params: {
                fecha_inicio: param,
                fecha_fin: paramDos
            }
        });
    };
    this.getMonitoreoCita = function(param) {
        return $http.get("../php/api/getMonitoreo.php", {
            params: {
                isCita: param
            }
        });
    };

    this.beforeClose = function() {
        $.ajax({
            type: 'GET',
            async: false,
            url: 'SomeUrl.com?id=123'
        });
    };


    this.guardarInformacion = function(data) {
        return $http({
            method: 'POST',
            url: "../php/api/guardarInfo.php",
            async: true,
            data: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json'
            }
        });
    };
    this.getAgente = function() {
        return $http.get("../php/api/getAgente.php");
    };
    this.getContactacion = function() {
        return $http.get("../php/api/getContactacion.php");
    };

});
app.controller("encuestaCtrl", function($scope, $window, $timeout, anchorSmoothScroll, apiService, $http) {
    //INICIALIZACIÓN DE VARIABLES
    $scope.angularLoaded = false;
    $scope.isDesActivado = false;
    //INFORMACIÓN DE LA ENCUESTA QUE SE ALMACENARÁ EN LOS SIGUIENTES ARRAYS
    $scope.cliente = {};
    $scope.opcion = {};
    $scope.bitacora = {};
    $scope.datalleContacto = {};
    $scope.agente = {};
    $scope.contactacion = {};
    $scope.historial = {};
    $scope.interes_credito = {};
    $scope.manejo_objecion = {};
    $scope.prospecto = {};
    $scope.encuesta = {};
    $scope.encuesta.finalShow = false;
    $scope.interes_credito.manejo_objecion = 0;
    $scope.contactacion = {};

    //DATEPICKER PLUGIN ROME.JS
    rome(inputCita1, {
        time: true,
        min: new Date()
    }).on('data', function(value) {
        $scope.interes_credito.agendar_cita = value;
    });

    rome(inputContacto, {
        time: true,
        min: new Date()
    }).on('data', function(value) {
        $scope.interes_credito.fecha_contacto = value;
    });

     $scope.getQueryParam=function(param) 
     {
               var result =  window.location.search.match(
                        new RegExp("(\\?|&)" + param + "(\\[\\])?=([^&]*)")
               );

               return result ? result[3] : false;
     };

    //LLAMADAS A LA API

    //ENTRARON DESDE EL MODULO DE BUSQUEDA
    if ($scope.getQueryParam("folio")) {
      apiService.getClienteEncuestaByFolio($scope.getQueryParam("folio")).then(function(response){
           $scope.cliente = response.data;;
            //SUCURSALES
            $http.get("../php/api/getSucursal.php").then(function(response) {
                $scope.surcursales = response.data;
                console.log("respuesta surcursal");
                console.log(response.data);
            });
            $scope.angularLoaded = true;
      });
    }
    // NO HAY NINUNA KEY
    else {

        apiService.getClienteEncuesta().then(function(response) {
            $scope.cliente = response.data.cliente;
            $scope.historial=response.data.historial;
            console.log($scope.historial);
            //SUCURSALES
            $http.get("../php/api/getSucursal.php").then(function(response) {
                $scope.surcursales = response.data;
                console.log("respuesta surcursal");
                console.log(response.data);
            });
            $scope.angularLoaded = true;

        }, function(response) {
            $timeout(function() {

                $scope.mensajeServer = response.data;
                angular.element("#noClientes").trigger("click");
            }, 500);
        });
    }



    /*  
     */
    apiService.getAgente().then(function(response) {
        console.log("RESPUESTA AGENTE");
        $scope.agente = response.data;
        console.log(response.data);
    }, function(response) {
        alert(response.data);
        window.location="../";
    });
    $scope.guardarLlamada = function() {


        $scope.isDesActivado = true;
       
        if ($scope.cliente.sucursal == null) {
            $scope.isDesActivado=false;
            alert("Elige la sucursal del precandidato");
            return;
        } else if (typeof $scope.bitacora.contacto == "undefined") {
            $scope.isDesActivado=false;
            alert("¿Has contactado al precandidato?");
            return;
        }
        else if($scope.bitacora.contacto==0 && typeof $scope.interes_credito.agendar_cita!="undefined"){
            $scope.isDesActivado=false;
            alert("Agendaste cita, pero indiscaste que no contactaste al precandidato");
            return;
        }

  


        $scope.bitacora.id_cliente = $scope.cliente.id_cliente;
        $scope.bitacora.nombre_cliente = $scope.cliente.nombre;
        $scope.bitacora.no_contrato = $scope.cliente.no_contrato;
        $scope.bitacora.id_agente = $scope.agente.id_usuario;
        $scope.bitacora.nombre_agente = $scope.agente.nombre_completo;
        $scope.datalleContacto.sucursal = $scope.cliente.sucursal;
        $scope.datalleContacto.cp = $scope.cliente.cp;

        $scope.bitacora.type = "todo";
        $scope.data = angular.extend($scope.datalleContacto, $scope.bitacora);
        $scope.data_dos = angular.extend($scope.data, $scope.interes_credito);
        $scope.data_tres = angular.extend($scope.manejo_objecion, $scope.data_dos);
        $scope.data_cuatro = angular.extend($scope.prospecto, $scope.data_tres);
        $scope.finalData = angular.extend($scope.encuesta, $scope.data_cuatro);

        console.log("Detalle contacto:" + $scope.isEmpty($scope.datalleContacto));
        console.log("Interes crédito:" + $scope.isEmpty($scope.interes_credito));
        console.log("Manejo objecion:" + $scope.isEmpty($scope.manejo_objecion));



        apiService.guardarLlamadaEncuesta($scope.finalData).success(function(data, status, headers, config) {
            $scope.isDesActivado=false;
            $scope.contactacion = data;
            console.log(data);
            angular.element('#contactacion').trigger('click');

        }).error(function(data, status, headers, config) {
            document.write("Ha ocurrido el siguiente error" + data);
        });




    };

    $scope.reloadPage = function() {
        window.location.reload();
    };
    //COMPORTAMIENTO DE LA PÁGINA
    $scope.onEnterado = function() {
        $scope.interes_credito.id_enterado = 1;
        anchorSmoothScroll.scrollTo("#enterado");
    };
    $scope.onEnteradoNo = function() {
        //RESET FORMULARIO VERIFICAMOS SI YA HABIA INGRESADO EL ID DE ENTERADO ANTERIORMENTE
        $scope.interes_credito.id_enterado = 0;
        anchorSmoothScroll.scrollTo("#informacion_credito");
    };
    $scope.onContacto = function() {
        $scope.bitacora.contacto = 1;
        //VERIFICAMOS SI HAY ALGUN ID DE NO CONTACTO
        if (typeof $scope.datalleContacto.id_motivo_no_contacto != 'undefined') {
            $scope.datalleContacto.id_motivo_no_contacto = undefined;
        }
        $scope.opcion.contactoOpcion = true;
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#script_credito");
        }, 500);

    }; //objecion 5 y 6 
    $scope.onContactoNo = function() {
        $scope.bitacora.contacto = 0;
        // $scope.limpiarTodoFormulario();
        $scope.opcion.contactoOpcion = false;
        $timeout(function() {
            if(typeof $scope.interes_credito.agendar_cita!="undefined"){
                             delete $scope.interes_credito.agendar_cita;
            };
            anchorSmoothScroll.scrollTo("#motivo_no_contacto");
        }, 500);

    };
    $scope.onMedioChange = function() {
        $scope.medioEnterado = 'true';
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#informacion_credito");
        }, 500);
    }
    $scope.onInteresariaCredito = function() {
        $timeout(function() {
            switch (parseInt($scope.interes_credito.tipo)) {
                case 0:
                    $timeout(function() {
                        anchorSmoothScroll.scrollTo("#manejo_objeciones");
                        if(typeof $scope.interes_credito.agendar_cita!="undefined"){
                             delete $scope.interes_credito.agendar_cita;
                        }
                    }, 500);
                    break;
                case 1:
                case 3:
                    $scope.manejoObjeciones = {};
                    anchorSmoothScroll.scrollTo("#cita");
                    break;
                case 2:
                case 4:
                case 5:
                    $scope.manejoObjeciones = {};
                    anchorSmoothScroll.scrollTo("#encuesta");
                    break;
            }

        }, 500);
    };
    $scope.onRecomendar = function() {
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#recomendado");
        }, 500);
    }
    $scope.onRecomendarNo = function() {
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#cierre");
        }, 500);
    };
    $scope.onManejoObjeciones = function() {
        var id_manejo = $scope.interes_credito.manejo_objecion;
        var element = "#manejo_objeciones_" + id_manejo;
        $timeout(function() {
            anchorSmoothScroll.scrollTo(element);
        }, 500);

    };
    $scope.onprogramarCita = function() {
        anchorSmoothScroll.scrollTo("#programar_cita");
    };
    $scope.onEncuesta = function() {
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#recomendarProducto");
        }, 500);

    };
    $scope.onRecomendarFamiliar = function() {
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#tomadoCredito");
        }, 500);
    };
    $scope.onTomadoCredito = function() {
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#entidadFinanciera");
        }, 500);
    };
    $scope.onEntidadFinanciera = function() {
        $scope.encuesta.finalShow = true;
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#finalEncuesta");
        }, 500);
    };
    $scope.statusChange = function() {
        $timeout(function() {
            //CASO CONTESTAN TELÉFONO
            if (parseInt($scope.bitacora.id_status_llamada) === 1) {
                $scope.bitacora.contacto = 1;
                anchorSmoothScroll.scrollTo("#presentacion");  

            } else {
                //LIMPIAMOS TODOS LOS DATOS DE LA BITACORA
                $scope.bitacora.contacto = 0;

            }

        }, 100);
    };
    $scope.tipoChange = function() {
        $scope.bitacora.id_status_llamada = undefined;
    };
    $scope.onprogramarCitaNo = function() {
        $timeout(function() {
            anchorSmoothScroll.scrollTo("#encuesta");
        }, 500);
    };


    $scope.limpiarTodoFormulario = function() {
        $scope.datalleContacto = {};
        $scope.historial = {};
        $scope.interes_credito = {};
        $scope.manejo_objecion = {};
        $scope.prospecto = {};
        $scope.encuesta = {};
        $scope.opcion = {};
    };



    $scope.isEmpty = function(obj) {
        return Object.keys(obj).length === 0;
    };


    $scope.llamadaInvalida = function() {
        return $scope.isActivo === false;
    };


});