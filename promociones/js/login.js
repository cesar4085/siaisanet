$(document).ready(function(){
    $("#login-form").submit(function(e){
        e.preventDefault();
        if($("#username").val()=="morozco"   && $("#password").val()=="123pass"){
            window.location="menu.php";
        }
        else if ($("#username").val()=="adminfa"   && $("#password").val()=="pass123"){
            window.location="menu.php";
        }
        else{
           alert("Usuario invalido");
        }
    });
});
