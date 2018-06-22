function convertirNumeroAMoneda(numero, separadorDecimal, separadorDeMiles, signoMoneda){
    numeroString = numero.toString();
    posicionDecimal=numeroString.indexOf(separadorDecimal);
    posicionFinal = numeroString.length;
    if (posicionDecimal != -1){
        posicionFinal = posicionDecimal;        
    }
    posicionActual = posicionFinal - 3;
    parteIzquierda = "";
    parteDerecha = "";
    while(posicionActual > 0){
        parteIzquierda = numeroString.substring(0,posicionActual);
        parteDerecha = numeroString.substring(posicionActual, numeroString.length);
        numeroString = parteIzquierda.concat(separadorDeMiles);
        numeroString = numeroString.concat(parteDerecha);
        posicionActual = posicionActual - 3;
    }
    numeroString = signoMoneda.concat(numeroString);
    return numeroString;
}
function formatoMoneda(idCampo, separadorDecimal, separadorDeMiles, signoMoneda){
    $(idCampo).keydown(function(event){
        if ('0123456789.'.indexOf(event.key) == -1 && event.key != "Backspace" && event.key != "Delete" && event.key != "ArrowLeft" && event.key != "ArrowRight"){
            event.preventDefault();            
        }else if (event.key == "." && $(idCampo).val().indexOf('.') != -1){
            event.preventDefault();            
        }
    });
    $(idCampo).keyup(function(event){
        valor = $(idCampo).val();
        valor = valor.replace(" ","");
        valor = valor.replace("$","");
        indicesComa = valor.indexOf(separadorDeMiles);
        while(indicesComa != -1){
            valor = valor.replace(separadorDeMiles,"");
            indicesComa = valor.indexOf(separadorDeMiles);            
        }
        if(valor.length > 0){
            $(idCampo).val(convertirNumeroAMoneda(valor,separadorDecimal,separadorDeMiles,signoMoneda));
        }
    });
}