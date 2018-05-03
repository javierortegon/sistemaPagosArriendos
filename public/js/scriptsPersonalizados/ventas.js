var jsonUsuarios;
var usuarioSeleccionado;

$(document).ready(function(){
    
    $('#clienteExistenteNombre').get(0).oninvalid = function(e) {
        if (!e.target.validity.valid) {
            e.target.setCustomValidity('Por favor busque y seleccione un usuario existente');
        }
    };

/*
    $("#clienteExistenteNombre").on("invalid", function(event) {
        $('#clienteExistenteNombre').get(0).setCustomValidity('');
    });
*/
    $('#clienteExistenteNombre').keydown(function(event){
        event.preventDefault();
    });

    $(".selectUsuarioNoE").click(function(){
        

        if(document.getElementById("rbUsuarioExistente").checked){
            $("#divRegistroUsuarioNuevo").hide(400);
            $("#divBusquedaUsuarioExistente").show(400);
            
            $("#name").removeAttr('required');
            $("#email").removeAttr('required');
            $("#documento").removeAttr('required');
        }
        else{
            $("#divBusquedaUsuarioExistente").hide(400);
            $("#divRegistroUsuarioNuevo").show(400);
            
            $("#name").attr('required', 'required');
            $("#email").attr('required', 'required');
            $("#documento").attr('required', 'required');

            $('#clienteExistenteNombre').val("");
            $('#clienteExistenteEmail').val("");
            $('#clienteExistenteDocumento').val("");
            $('#inputUserId').val("");  
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
            

            $('#usuariosDataList').html(options);
        });
    });
    
    $('#btnSeleccionUsuario').click(function(){
        idUsuario = "NA";
        $('#clienteExistenteNombre').get(0).setCustomValidity('');

        campo = $('#campoParaBuscar').val();
        busqueda = $('#busqueda').val();
        
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
            $('#clienteExistenteNombre').val(jsonUsuarios[idUsuario].name);
            $('#clienteExistenteEmail').val(jsonUsuarios[idUsuario].email);
            $('#clienteExistenteDocumento').val(jsonUsuarios[idUsuario].documento);
            $('#inputUserId').val(jsonUsuarios[idUsuario].id);
        
        }
        else{
            $('#clienteExistenteNombre').val("");
            $('#clienteExistenteEmail').val("");
            $('#clienteExistenteDocumento').val("");
            $('#inputUserId').val("");   
        }
        
    });
    
});

