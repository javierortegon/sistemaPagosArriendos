//funcion para cargar dinamicamente los tipos
$("#proyecto").change(function(event){
    $.get(`proyectoTipos/${event.target.value}`, function(res, sta){
        $("#tipoPropiedad").empty();
        res.forEach(element => {
			$("#tipoPropiedad").append(`<option value=${element.id}> ${element.nombre} </option>`);
        });
    })
});