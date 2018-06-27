<img style="width: 100%;margin-top:-48px;" src="{{{ asset('img/head_pdf.png') }}}">

@if (count($datosTipoPropiedad) <= 0)
    <p>NO TIENE DATOS COMPLETOS PARA GENERAR EL PDF</p>
@else

    <div style="text-align: center">
        <p>
            PRESUPUESTO<br>
            PROYECTO “{{ $datosTipoPropiedad->proyectoNombre }}”<br>
            {{ strtoupper($datosTipoPropiedad->tipoPropiNombre) }}<br>
            Carrera 4 No. 18 - 22 Bogotá D.C.<br>
        </p>
    </div>

    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 33%">
                    Tipo: <span style="text-decoration: underline;"> {{ $datosTipoPropiedad->tipoPropiNombre }} </span>
                </td>
                <td style="width: 50%">
                    Área Arquitectónica Aprox: <span style="text-decoration: underline;"> {{ $datosTipoPropiedad->area_aproximada }} </span> M2.
                </td>
                <td style="width: 50%">
                    Área Privada Aprox: <span style="text-decoration: underline;"> {{ $datosTipoPropiedad->area_privada_aprox }} </span> M2.
                </td>
            </tr>
        </table>
    </div>
       
    <h3 style="text-align: center">Datos del solicitante:</h3>
    <div style="border: solid 1px; ">
        <table  style="width: 100%">
            <tr style="width: 100%;">
                <td style="width: 50%;" colspan="2">
                    Nombre: <span style="text-decoration: underline;"> {{ $datosComprador['name'] }} </span>
                </td>
                <td style="width: 50%;">
                    Documento de Identidad:  <span style="text-decoration: underline;"> {{ $datosComprador['documento'] }} </span>
                </td>
            </tr>
            <tr style="width: 100%;">
                <td style="" colspan="3">
                    Dirección de Correspondencia: <span style="text-decoration: underline;"> {{ $datosComprador['direccion_correspondencia'] }} </span>
                </td>   
            </tr>
            <tr style="width: 100%; ">
                <td style="width: 33%" colspan="1">
                    Barrio: <span style="text-decoration: underline;"> {{ $datosComprador['barrio'] }} </span>
                </td>
                <td style="width: 33%" colspan="1">
                    Ciudad: <span style="text-decoration: underline;"> {{ $datosComprador->ciudad }} </span>
                </td>
                <td style="width: 33%" colspan="1">
                    Teléfono: <span style="text-decoration: underline;"> {{ $datosComprador->telefono }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    Celular: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 50%;" colspan="2">
                    E-mail: <span style="text-decoration: underline;"> {{ $datosComprador->email }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;" colspan="2">
                    Estado Civil: <span style="text-decoration: underline;"> {{ $datosComprador->estado_civil }} </span>
                </td>
                <td style="width: 50%;" colspan="1">
                    Tipo de Representación: <span style="text-decoration: underline;"> {{ $datosComprador->tipo_representacion }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    Ocupación: <span style="text-decoration: underline;"> {{ $datosComprador->ocupacion }} </span>
                </td>
                <td style="width: 50%;" colspan="2">
                    Cargo: <span style="text-decoration: underline;"> {{ $datosComprador->cargo }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;" colspan="2">
                    Empresa:  <span style="text-decoration: underline;"> {{ $datosComprador->empresa }} </span>
                </td>
                <td style="width: 50%;">
                    Teléfono:  <span style="text-decoration: underline;"> {{ $datosComprador->telefonoEmpresa }} </span>
                </td>
            </tr>
            <tr>
                <td style="" colspan="2">
                    Tiempo de vinculación:   <span style="text-decoration: underline;"> {{ $datosComprador->tipo_vinculacion }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Contrato:   <span style="text-decoration: underline;"> {{ $datosComprador->tipo_contrato }} </span>
                </td>
            </tr>
            <tr>
                <td style="" colspan="3">
                    ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;"> {{ $datosComprador->encuesta }} </span>
                </td>
            </tr>
        </table>
    </div>

    <h3 style="text-align: center; ">Forma de Pago: </h3>
    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%">
                    Precio de Venta: 
                    <span class="moneda" style="text-decoration: underline;"> 
                        {{$valores['valor_total']}} 
                    </span>
                </td>
                <td style="width: 50%">
                    Primer Pago:
                    <span class="moneda" style="text-decoration: underline;">
                        {{$valores['valor_primer_pago']}}
                    </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    Cuota Inicial:
                    <span class="moneda" style="text-decoration: underline;">
                        {{$valores['cuota_inicial']}}
                    </span>
                </td>
                <td style="width: 50%">
                    Saldo o Valor del Crédito (50%):
                    <span class="moneda" style="text-decoration: underline;">
                        {{$valores['saldo_credito']}}
                    </span>
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
                <td>Primer Pago</td>
                <td>
                    {{$valores['valor_primer_pago']}}
                </td>
                <td>__/__/____</td>
            </tr>
            @for($i=0;$i<$presupuesto->numero_de_cuotas;$i++)
                <tr>
                    <td>{{$i + 1}}</td>
                    <td class="moneda">
                        {{$valores['valorCadaCuota']}}
                    </td>
                    <td>{{ $fechas[$i] }}</td>
                </tr>
            @endfor
        </table>
    </div>
@endif  
<script src="{{asset('js/scriptsPersonalizados/formatoMoneda.js')}}"></script>
<script>
    $(document).ready(function(){
        etiquetas = $(.moneda);
        for(i = 0; i < etiquetas.length;i++){
            etiquetas[i].html(convertirNumeroAMoneda(etiquetas[i].html(), ".", ",", "$ "));
        }
    });
</script>