$(document).ready(function(e){

 
   //COMPORTAMIENTO PANEL DE BUSQUEDA
    $(".result").click(function(e){
        $id=$(this).attr("data-id");
        $("#buscar-input").val($(this).text());
        $("#input-id").val($id);
        document.getElementById("formBuscar").submit();
    });
    
    $("#buscar-input").autocomplete({
        source:function(request,response){
            
           
            $.post("../php/api/getBusqueda.php",
            {
               palabra_buscada:$("#buscar-input").val(),search_param:$("#search_param").val()
            },
            function (data) {
              
                    console.log(data);
                    
                    response($.map($.parseJSON(data),function(item){
                        
                        var label;
                        if($("#search_param").val()=="clientes"){
                          label=item.nombre+" "+ item.paterno +" "+ item.materno;
                        }
                        else if($("#search_param").val()=="fijo"){
                            label=item.telefono_fijo;
                        }
                        else if($("#search_param").val()=="movil"){
                            label=item.telefono_movil;
                        }
                        else{
                            label=item.no_contrato;
                        }
                        
                        return {
                            label: label,
                            value: item.id_cliente
                        }
                    }));
            });
        },
         select: function(event, ui) {
            event.preventDefault();
            $("#buscar-input").val(ui.item.label);
            $("#input-id").val(ui.item.value);
        },
        focus: function(event, ui) {
            event.preventDefault();
            $("#buscar-input").val(ui.item.label);
            $("#input-id").val(ui.item.value);
        },
        minLength: 3
    });
   
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
                    e.preventDefault();
                    var param = $(this).attr("href").replace("#","");
                    var concept = $(this).text();
                    $('.search-panel span#search_concept').text(concept);
                    $('.input-group #search_param').val(param);

                    if (concept == 'Clientes')
                    {
    $('.input-group #x').attr("placeholder","Raul Martinez");
                    }
    else if (concept =='Número de Cuenta') {

            $('.input-group #x').attr("placeholder","ejemplo: 3001-09056459");
    }
            else   {

            $('.input-group #x').attr("placeholder","ejemplo: local(5511-2233), celular(5511-22-3344)");
    }	
            })

    //CLICK EN EL BOTON INICIAR LLAMADA!! 
    $(".initLLamada").click(function(e){
       e.preventDefault();
       $id_cliente=$(this).attr("data-id-cliente");
       localStorage.setItem("id_clienteBusqueda",$id_cliente);
       window.location.href="../encuesta/";
    });
  
    //COMPORTAMIENTO ALTA DE AGENTE
    $("#form-registrar").submit(function(e){
        e.preventDefault();
        if($("#password").val()!=$("#password_confirm").val()){
              $.notiny({ text: "Las contraseñas no son iguales, por favor verifica!", position: 'fluid-bottom' });
        }
        else{
            $formData=$(this).serialize();
            $.post('../php/api/agregarAgente.php',$formData).done(function(data){
              alert(data);
              $("#form-registrar").trigger("reset");
           })
        }
        
    })



});


