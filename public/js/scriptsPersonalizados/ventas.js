$(document).ready(function(){
    
    $(".selectUsuarioNoE").click(function(){
        if(document.getElementById("rbUsuarioExistente").checked){
            $("#divRegistroUsuarioNuevo").hide(400);
            $("#divBusquedaUsuarioExistente").show(400);
        }
        else{
            $("#divBusquedaUsuarioExistente").hide(400);
            $("#divRegistroUsuarioNuevo").show(400);
        }
    });


});