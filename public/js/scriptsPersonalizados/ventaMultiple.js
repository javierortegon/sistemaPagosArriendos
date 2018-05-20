var jsonUsuarios;
var usuarioSeleccionado;

$(document).ready(function(){

    $('#valor').keydown(function(event){
        event.preventDefault();
    });

    //Inicializar campos requeridos

    $("#name").attr('required', 'required');
    $("#telefono").attr('required', 'required');

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
            $("#telefono").removeAttr('required');

            $('#clienteExistenteNombre').attr('required', 'required');
        }
        else{
            $("#divBusquedaUsuarioExistente").hide(400);
            $("#divRegistroUsuarioNuevo").show(400);
            
            $("#name").attr('required', 'required');
            $("#telefono").attr('required', 'required');

            $('#clienteExistenteNombre').removeAttr('required');

            $('#clienteExistenteNombre').val("");
            $('#clienteExistenteEmail').val("");
            $('#clienteExistenteDocumento').val("");
            $('#clienteExistenteTelefono').val("");
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

    var propActual = 0;
    $('#btnAddPropiedad').click(function(){

        propActual = propActual +1;
        propiedades =  $("#propiedades").html();
        propiedades += '<tr id = "row'+propActual+'">';
        propiedades += '<td>';
        propiedades += '<input type="text">';
        propiedades += '</td>';

        propiedades += '<td>';
        propiedades += '<button id = "select'+propActual+'" type="button" class = "btn btn-warning selectPropiedad" name="'+propActual+'">Seleccionar</button>';
        propiedades += '</td>';



        propiedades += '<td>';
        propiedades += '<input type="text" value = "'+propActual+'">';
        propiedades += '</td>';

        propiedades += '<td>';
        propiedades += '<button id = "delete'+propActual+'" type="button" class = " deletePropiedad btn btn-danger" name="'+propActual+'">Eliminar</button>';
        propiedades += '</td>';
        propiedades += '</tr>';
        $("#propiedades").html(propiedades);
        idBoton = '#delete'+propActual;
        $('.deletePropiedad').click(function(){
            idABorrar = "#row"+$(this).name();
            alert(idABorrar);
            //$(idABorrar).remove();
        });
    });
    
});

