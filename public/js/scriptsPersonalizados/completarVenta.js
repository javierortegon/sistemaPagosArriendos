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

    $('#id_usuario2').keydown(function(event){
        event.preventDefault();        
    });

    if(document.getElementById("rbUsuarioExistente").checked){
        $("#divBusquedaUsuarioExistente").show(400);
        $("#id_usuario2").attr('required', 'required');
        $('#documento').attr('readonly', true);

    }
    else{
        $("#divBusquedaUsuarioExistente").hide(400);
        $('#id_usuario2').removeAttr('required');     
        $('#documento').attr('readonly', true);                                
       
    }
    
    //Inicializar campos requeridos
    if(document.getElementById("segundoComprador").checked){
            $('#name2').attr('required', 'required');
            $('#email2').attr('required', 'required');
            $('#documento').attr('required', 'required');                       
            $('#telefono2').attr('required', 'required');
            $('#direccion2').attr('required', 'required');
            $('#barrio2').attr('required', 'required');
            $('#ciudad2').attr('required', 'required');
            $('#estado_civil2').attr('required', 'required');
            $('#tipo_representacion2').attr('required', 'required');
            $('#ocupacion2').attr('required', 'required');
            $('#cargo2').attr('required', 'required');
            $('#empresa2').attr('required', 'required');
            $('#tipo_vinculacion2').attr('required', 'required');
            $('#tipo_contrato2').attr('required', 'required');
            $('#encuesta2').attr('required', 'required');
            $("#datosUsuario2").show(400);
    } else {
            $('#name2').removeAttr('required');
            $('#email2').removeAttr('required');
            $('#documento').removeAttr('required');                        
            $('#telefono2').removeAttr('required');
            $('#direccion2').removeAttr('required');
            $('#barrio2').removeAttr('required');
            $('#ciudad2').removeAttr('required');
            $('#estado_civil2').removeAttr('required');
            $('#tipo_representacion2').removeAttr('required');
            $('#ocupacion2').removeAttr('required');
            $('#cargo2').removeAttr('required');
            $('#empresa2').removeAttr('required');
            $('#tipo_vinculacion2').removeAttr('required');
            $('#tipo_contrato2').removeAttr('required');
            $('#encuesta2').removeAttr('required');
            $("#datosUsuario2").hide(400);
    }
    if(document.getElementById("rbUsuarioExistente").checked){
        $("#divBusquedaUsuarioExistente").show(400);
        $("#id_usuario2").attr('required', 'required');
        $('#documento').attr('readonly', true);                               
        
    }
    else{
        $("#divBusquedaUsuarioExistente").hide(400);
        $('#id_usuario2').removeAttr('required'); 
        $('#documento').attr('readonly', false);                              
                   
    }
    $('.segundoComprador').click(function(){
        if(document.getElementById("segundoComprador").checked){
            $('#name2').attr('required', 'required');
            $('#email2').attr('required', 'required');
            $('#documento').attr('required', 'required');                       
            $('#telefono2').attr('required', 'required');
            $('#direccion2').attr('required', 'required');
            $('#barrio2').attr('required', 'required');
            $('#ciudad2').attr('required', 'required');
            $('#estado_civil2').attr('required', 'required');
            $('#tipo_representacion2').attr('required', 'required');
            $('#ocupacion2').attr('required', 'required');
            $('#cargo2').attr('required', 'required');
            $('#empresa2').attr('required', 'required');
            $('#tipo_vinculacion2').attr('required', 'required');
            $('#tipo_contrato2').attr('required', 'required');
            $('#encuesta2').attr('required', 'required');
            $("#datosUsuario2").show(400);
        } else {
            $('#name2').removeAttr('required');
            $('#email2').removeAttr('required');
            $('#documento').removeAttr('required');                        
            $('#telefono2').removeAttr('required');
            $('#direccion2').removeAttr('required');
            $('#barrio2').removeAttr('required');
            $('#ciudad2').removeAttr('required');
            $('#estado_civil2').removeAttr('required');
            $('#tipo_representacion2').removeAttr('required');
            $('#ocupacion2').removeAttr('required');
            $('#cargo2').removeAttr('required');
            $('#empresa2').removeAttr('required');
            $('#tipo_vinculacion2').removeAttr('required');
            $('#tipo_contrato2').removeAttr('required');
            $('#encuesta2').removeAttr('required');
            $("#datosUsuario2").hide(400);
        }
        if(document.getElementById("rbUsuarioExistente").checked){
            $("#divBusquedaUsuarioExistente").show(400);
            $("#id_usuario2").attr('required', 'required');
            $('#documento').attr('readonly', true);                                
        }
        else{
            $("#divBusquedaUsuarioExistente").hide(400);
            $('#id_usuario2').removeAttr('required'); 
            $('#documento').attr('readonly', false);                    
                       
        }
    });

    //Definiendo campos requeridos dependiendo de si se seleccionó usuario nuevo o existente
    $(".selectUsuarioNoE").click(function(){
        if(document.getElementById("rbUsuarioExistente").checked){
            $("#divBusquedaUsuarioExistente").show(400);
            $("#id_usuario2").attr('required', 'required');
            $('#documento').attr('readonly', true);                    
            
            
        }
        else{
            $("#divBusquedaUsuarioExistente").hide(400);
            $('#id_usuario2').removeAttr('required');    
            $('#documento').attr('readonly', false);                    
                                
        }
        $('#id_usuario2').val("");   
        $('#name2').val("");
        $('#email2').val("");
        $('#documento').val("");
        $('#telefono2').val("");
        $('#direccion2').val("");
        $('#barrio2').val("");
        $('#ciudad2').val("");
        $('#estado_civil2').val("");
        $('#tipo_representacion2').val("");
        $('#ocupacion2').val("");
        $('#cargo2').val("");
        $('#empresa2').val("");
        $('#tipo_vinculacion2').val("");
        $('#tipo_contrato2').val("");
        $('#encuesta2').val("");
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
            $('#id_usuario2').val(jsonUsuarios[idUsuario].id);
            $('#name2').val(jsonUsuarios[idUsuario].name);
            $('#email2').val(jsonUsuarios[idUsuario].email);
            $('#documento').val(jsonUsuarios[idUsuario].documento);
            $('#documento').attr('readonly', true);            
            $('#telefono2').val(jsonUsuarios[idUsuario].telefono);
            $('#direccion2').val(jsonUsuarios[idUsuario].direccion);
            $('#barrio2').val(jsonUsuarios[idUsuario].barrio);
            $('#ciudad2').val(jsonUsuarios[idUsuario].ciudad);
            $('#estado_civil2').val(jsonUsuarios[idUsuario].estado_civil);
            $('#tipo_representacion2').val(jsonUsuarios[idUsuario].tipo_representacion);
            $('#ocupacion2').val(jsonUsuarios[idUsuario].ocupacion);
            $('#cargo2').val(jsonUsuarios[idUsuario].cargo);
            $('#empresa2').val(jsonUsuarios[idUsuario].empresa);
            $('#tipo_vinculacion2').val(jsonUsuarios[idUsuario].tipo_vinculacion);
            $('#tipo_contrato2').val(jsonUsuarios[idUsuario].tipo_contrato);
            $('#encuesta2').val(jsonUsuarios[idUsuario].encuesta);
        }
        else{
            $('#id_usuario2').val("");   
            $('#name2').val("");
            $('#email2').val("");
            $('#documento').val("");
            $('#documento').attr('readonly', false);                        
            $('#telefono2').val("");
            $('#direccion2').val("");
            $('#barrio2').val("");
            $('#ciudad2').val("");
            $('#estado_civil2').val("");
            $('#tipo_representacion2').val("");
            $('#ocupacion2').val("");
            $('#cargo2').val("");
            $('#empresa2').val("");
            $('#tipo_vinculacion2').val("");
            $('#tipo_contrato2').val("");
            $('#encuesta2').val("");
        }
        
    });
    
});