var jsonUsuarios;
var usuarioSeleccionado;

$(document).ready(function(){

    $('#valor').keydown(function(event){
        if ('0123456789.'.indexOf(event.key) == -1 && event.key != "Backspace" && event.key != "Delete" && event.key != "ArrowLeft" && event.key != "ArrowRight"){
            event.preventDefault();            
        }
        if (event.key == "." && $('#valor').val().indexOf('.') != -1){
            event.preventDefault();            
        }
    });

    //Inicializar campos requeridos

    $("#name").attr('required', 'required');
    $("#email").attr('required', 'required');
    $("#documento").attr('required', 'required');
    $("#telefono").attr('required', 'required');
    $("#direccion").attr('required', 'required');
    $('#clienteExistenteNombre').removeAttr('required');

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
    $('#clienteExistenteTelefono').keydown(function(event){
        event.preventDefault();
    });
    $('#clienteExistenteDireccion').keydown(function(event){
        event.preventDefault();
    });

    //Definiendo campos requeridos dependiendo de si se seleccionó usuario nuevo o existente
    $(".selectUsuarioNoE").click(function(){
        if(document.getElementById("rbUsuarioExistente").checked){
            $("#divRegistroUsuarioNuevo").hide(400);
            $("#divBusquedaUsuarioExistente").show(400);
            
            $("#name").removeAttr('required');
            $("#email").removeAttr('required');
            $("#documento").removeAttr('required');
            $("#telefono").removeAttr('required');
            $("#direccion").removeAttr('required');

            $('#clienteExistenteNombre').attr('required', 'required');
        }
        else{
            $("#divBusquedaUsuarioExistente").hide(400);
            $("#divRegistroUsuarioNuevo").show(400);
            
            $("#name").attr('required', 'required');
            $("#email").attr('required', 'required');
            $("#documento").attr('required', 'required');
            $("#telefono").attr('required', 'required');
            $("#direccion").attr('required', 'required');

            $('#clienteExistenteNombre').removeAttr('required');

            $('#clienteExistenteNombre').val("");
            $('#clienteExistenteEmail').val("");
            $('#clienteExistenteDocumento').val("");
            $('#inputUserId').val("");  
        }
        
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

