var jsonUsuarios;
var usuarioSeleccionado;

$(document).ready(function(){
    //Definiendo la alerta para pedir busqueda de usuario
    $('#clienteExistenteNombre').get(0).oninvalid = function(e) {
        if (!e.target.validity.valid) {
            e.target.setCustomValidity('Por favor busque y seleccione un usuario existente');
        }
    };
    //Evitar que se pueda escribir en los detalles de cliente existente
    $('#clienteExistenteNombre').keydown(function(event){
        event.preventDefault();
    });
    $('#clienteExistenteEmail').keydown(function(event){
        event.preventDefault();
    });
    $('#clienteExistenteDocumento').keydown(function(event){
        event.preventDefault();
    });
    $('#valorCuotaInicial').keydown(function(event){
        event.preventDefault();
    });
    $('#valorTotal').keydown(function(event){
        event.preventDefault();
    });
    //Ajax para busqueda de usuarios existentes
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
            else if(campo == 'telefono'){
                for(var i = 0; i < result.length; i++)
                    options += '<option value="'+result[i].telefono+'" id="id'+ result[i].id +'" />';
            }
            else if(campo == 'documento'){
                for(var i = 0; i < result.length; i++)
                    options += '<option value="'+result[i].documento+'" id="id'+ result[i].id +'" />';
            }
            $('#usuariosDataList').html(options);
        });
    });
    //Seleccionando usuario existente
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
        else if(campo == 'telefono'){
            for(var i = 0; i < jsonUsuarios.length; i++)
                if(busqueda == jsonUsuarios[i].telefono){
                    idUsuario = i;
                }
        }
        else if(campo == 'documento'){
            for(var i = 0; i < jsonUsuarios.length; i++)
                if(busqueda == jsonUsuarios[i].documento){
                    idUsuario = i;
                }
        }
        if(idUsuario != "NA"){
            $('#clienteExistenteNombre').val(jsonUsuarios[idUsuario].name);
            $('#clienteExistenteEmail').val(jsonUsuarios[idUsuario].email);
            $('#clienteExistenteDocumento').val(jsonUsuarios[idUsuario].documento);
            $('#clienteExistenteTelefono').val(jsonUsuarios[idUsuario].telefono);
            $('#clienteExistenteDireccion').val(jsonUsuarios[idUsuario].direccion);
            $('#inputUserId').val(jsonUsuarios[idUsuario].id);
        
        }
        else{
            $('#clienteExistenteNombre').val("");
            $('#clienteExistenteEmail').val("");
            $('#clienteExistenteDocumento').val("");
            $('#clienteExistenteTelefono').val("");
            $('#clienteExistenteDireccion').val("");
            $('#inputUserId').val("");   
        }
    });
});