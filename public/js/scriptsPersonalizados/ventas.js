var usuarioSeleccionado = "";
var usuarioSeleccionadoId = "";

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
            usuarioSeleccionado = result;
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
        //document.getElementById('clienteExistenteNombre').innerHTML = usuarioSeleccionado[0].name;
        //document.getElementById('clienteExistenteEmail').innerHTML = usuarioSeleccionado[0].email;
    });
    
});

