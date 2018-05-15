<img style="width: 100%;margin-top:-50px;" src="{{{ asset('img/head_pdf.png') }}}">
@foreach($venta as $ventaData)
    <div style="text-align: center">
        <p>
            ORDEN DE RESERVA<br>
            PROYECTO “{{ $ventaData->proyectoNombre }}”<br>
            TORRE 1<br>
            Carrera 4 No. 18 - 22 Bogotá D.C.<br>
        </p>
    </div>

    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 33%">
                    Apartamento No.: <span style="text-decoration: underline;"> {{ $ventaData->codigoApto }} </span>
                </td>
                <td style="width: 33%">
                    Tipo: <span style="text-decoration: underline;"> {{ $ventaData->tipoPropiNombre }} </span>
                </td>
                <td style="width: 33%">
                    Piso No.:<span style="text-decoration: underline;"> {{ $ventaData->numero_piso }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    Área Arquitectónica Aprox: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span> M2.
                </td>
                <td style="width: 50%">
                    Área Privada Aprox: <span style="text-decoration: underline;"> {{ $ventaData->area__privada_aprox }} </span> M2.
                </td>
            </tr>
        </table>
    </div>
       
    <h3 style="text-align: center">Datos del Reservante (1):</h3>
    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%">
                    Nombre: <span style="text-decoration: underline;"> {{ $ventaData->codigoApto }} </span>
                </td>
                <td style="width: 30%">
                    Documento de Identidad:  <span style="text-decoration: underline;"> {{ $ventaData->tipoPropiNombre }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Barrio: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 35%">
                    Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 35%">
                    Teléfono: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Celular: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 70%">
                    E-mail: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Estado Civil: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Representación: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Ocupación: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 60%">
                    Cargo: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 70%">
                    Empresa:  <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 30%">
                    Teléfono:  <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Tiempo de vinculación:   <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Contrato:   <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 100%">
                    ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
        </table>
    </div>

    <h3 style="text-align: center">Datos del Reservante (2):</h3>
    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%">
                    Nombre: <span style="text-decoration: underline;"> {{ $ventaData->codigoApto }} </span>
                </td>
                <td style="width: 30%">
                    Documento de Identidad:  <span style="text-decoration: underline;"> {{ $ventaData->tipoPropiNombre }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Barrio: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 35%">
                    Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 35%">
                    Teléfono: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Celular: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 70%">
                    E-mail: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Estado Civil: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Representación: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Ocupación: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 60%">
                    Cargo: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 70%">
                    Empresa:  <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 30%">
                    Teléfono:  <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Tiempo de vinculación:   <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Contrato:   <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 100%">
                    ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span>
                </td>
            </tr>
        </table>
    </div>

    <h3 style="text-align: center">Forma de Pago: </h3>
    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%">
                    Precio de Venta: <span style="text-decoration: underline;"> {{ $ventaData->codigoApto }} </span>
                </td>
                <td style="width: 50%">
                    Separación:  <span style="text-decoration: underline;"> {{ $ventaData->tipoPropiNombre }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    Cuota Inicial: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span> M2.
                </td>
                <td style="width: 50%">
                    Saldo o Valor del Crédito (50%): <span style="text-decoration: underline;"> {{ $ventaData->area__privada_aprox }} </span> M2.
                </td>
            </tr>
        </table>
    </div>

    <h3 style="text-align: center">Plan de Pagos:</h3>
    <div style=" width: 100%; text-align: center">
        <table style="width: 60%; margin: 0 auto;" border="1">
            <tr>
                <th>Cuota No. </th>
                <th>Valor</th>
                <th>Fecha</th>
            </tr>
            <tr>
                <td>1</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>2</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>3</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>4</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>5</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>6</td>
                <td>$1´970.714</td>
                <td>__/10/2018</td>
            </tr>
             <tr>
                <td>1</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>2</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>3</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>4</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>5</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>6</td>
                <td>$1´970.714</td>
                <td>__/10/2018</td>
            </tr>
             <tr>
                <td>1</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>2</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>3</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>4</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>5</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>6</td>
                <td>$1´970.714</td>
                <td>__/10/2018</td>
            </tr>
             <tr>
                <td>1</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>2</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>3</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>4</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>5</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>6</td>
                <td>$1´970.714</td>
                <td>__/10/2018</td>
            </tr>
             <tr>
                <td>1</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>2</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>3</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>4</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>5</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>6</td>
                <td>$1´970.714</td>
                <td>__/10/2018</td>
            </tr>
        </table>
        <p>Nota: El Plan de Pagos corresponde a un (1) inmueble. </p>
    </div>
    
    <h3 style="text-align: center">Observaciones:</h3>
    <div style="border: solid 1px; width: 100%;">
        <b>Contrato de Encargo Fiduciario Matriz Inmobiliario de Preventas:</b> 
        HABITUS CONSTRUCCIONES S.A.S. en calidad de FIDEICOMITENTE DESARROLLADOR 
        Y CONSTRUCTOR, informa a el(los) reservante(s) que mediante documento 
        privado se celebró Contrato de Encargo Fiduciario Matriz Inmobiliario
        de Preventas con FIDUCIARIA COLPATRIA S.A., mediante el cual se recaudarán
        los aportes que realicen los encargantes y futuros compradores de las
        unidades inmobiliarias que harán parte del Proyecto Inmobiliario <b>TORRE VENTTO</b> ,
        que se desarrollará en el inmueble ubicado en la <b>Carrera 4 No. 18 -22</b>  de la
        actual nomenclatura urbana de Bogotá D.C. e identificado con los folios de matrícula
        inmobiliaria matriz números: 50C-3547; 50C-566279; 50C-574103 y 50C-581206 de la
        Oficina de Registro de Instrumentos Públicos de Bogotá – Zona Centro. 
    </div>

    <footer style="position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; "  >footer on each page</footer>
@endforeach
