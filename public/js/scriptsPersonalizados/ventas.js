var jsonUsuarios;

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
    
    $('#busqueda').keyup(function(e){

        e.preventDefault();

        campo = document.getElementById('campoParaBuscar').value;
        busqueda = document.getElementById('busqueda').value;

        url = $('#formDatosAjax').attr("action").replace('FIELD', campo).replace('CHARACTERS', busqueda);
        data = $('#formDatosAjax').serialize();

        $.post(url, data, function(result){
            var options = '';
            jsonUsuarios = result;
            if(campo == 'name'){
                for(var i = 0; i < result.length; i++)
                    options += '<option value="'+result[i].name+'" id="id'+ result[i].id +'" />';
            }
            else if(campo == 'email'){
                for(var i = 0; i < result.length; i++)
                    options += '<option value="'+result[i].email+'" id="id'+ result[i].id +'" />';
            }
            

            document.getElementById('usuariosDataList').innerHTML = options;
        });
    });
    
    $('#btnSeleccionUsuario').click(function(){
        idUsuario = "NA";

        campo = document.getElementById('campoParaBuscar').value;
        busqueda = document.getElementById('busqueda').value;
        
        if(campo == 'name'){
            for(var i = 0; i < jsonUsuarios.length; i++)
                if(busqueda == jsonUsuarios[i].name){
                    idUsuario = i;
                }
        }
        else if(campo == 'email'){
            for(var i = 0; i < jsonUsuarios.length; i++)
                if(busqueda == jsonUsuarios[i].email){
                    idUsuario = i;
                }
        }
        if(idUsuario != "NA"){
            document.getElementById('clienteExistenteNombre').innerHTML = jsonUsuarios[idUsuario].name;
            document.getElementById('clienteExistenteEmail').innerHTML = jsonUsuarios[idUsuario].email;
            document.getElementById('inputUserId').value = jsonUsuarios[idUsuario].id;
        
        }
        else{
            document.getElementById('clienteExistenteNombre').innerHTML = "";
            document.getElementById('clienteExistenteEmail').innerHTML = "";
            document.getElementById('inputUserId').value = jsonUsuarios[idUsuario].id;         
        }
        
    });
    
});

