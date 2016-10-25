$(document).ready(function(e){

    //REGISTRAR 
    $("#form-registrar-chat").submit(function(e){
        e.preventDefault();
       
        
            $formData=$(this).serialize();
            $.post('../php/api/agregarChat.php',$formData).done(function(data){
              alert(data);
              $("#form-registrar-chat").trigger("reset");
           })
        
        
    })



});


