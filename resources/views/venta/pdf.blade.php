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
       
    <h3>Datos del Reservante (1):</h3>
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
                <td style="width: 100%">
                    Barrio: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span> M2.
                </td>
                <td style="width: 100%">
                    Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span> M2.
                </td>
                <td style="width: 100%">
                    Teléfono: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span> M2.
                </td>
            </tr>
            <tr>
                <td style="width: 100%">
                    Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->area_aproximada }} </span> M2.
                </td>
            </tr>
        </table>
    </div>

@endforeach
