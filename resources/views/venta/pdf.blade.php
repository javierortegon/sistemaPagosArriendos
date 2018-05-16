<img style="width: 100%;margin-top:-48px;" src="{{{ asset('img/head_pdf.png') }}}">
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
                    Área Privada Aprox: <span style="text-decoration: underline;"> {{ $ventaData->area_privada_aprox }} </span> M2.
                </td>
            </tr>
        </table>
    </div>
       
    <h3 style="text-align: center">Datos del Reservante (1):</h3>
    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%">
                    Nombre: <span style="text-decoration: underline;"> {{ $ventaData->name }} </span>
                </td>
                <td style="width: 30%">
                    Documento de Identidad:  <span style="text-decoration: underline;"> {{ $ventaData->documento }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Barrio: <span style="text-decoration: underline;"> {{ $ventaData->barrio }} </span>
                </td>
                <td style="width: 35%">
                    Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->ciudad }} </span>
                </td>
                <td style="width: 35%">
                    Teléfono: <span style="text-decoration: underline;"> {{ $ventaData->telefono }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Celular: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 70%">
                    E-mail: <span style="text-decoration: underline;"> {{ $ventaData->email }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Estado Civil: <span style="text-decoration: underline;"> {{ $ventaData->estado_civil }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Representación: <span style="text-decoration: underline;"> {{ $ventaData->tipo_representacion }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Ocupación: <span style="text-decoration: underline;"> {{ $ventaData->ocupacion }} </span>
                </td>
                <td style="width: 60%">
                    Cargo: <span style="text-decoration: underline;"> {{ $ventaData->cargo }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 70%">
                    Empresa:  <span style="text-decoration: underline;"> {{ $ventaData->empresa }} </span>
                </td>
                <td style="width: 30%">
                    Teléfono:  <span style="text-decoration: underline;"> {{ $ventaData->telefonoEmpresa }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Tiempo de vinculación:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_vinculacion }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Contrato:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_contrato }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 100%">
                    ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;"> {{ $ventaData->encuesta }} </span>
                </td>
            </tr>
        </table>
    </div>
@endforeach    

@foreach($datosSegunCompra as $ventaData)
    <h3 style="text-align: center">Datos del Reservante (2):</h3>
    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 70%">
                    Nombre: <span style="text-decoration: underline;"> {{ $ventaData->name }} </span>
                </td>
                <td style="width: 30%">
                    Documento de Identidad:  <span style="text-decoration: underline;"> {{ $ventaData->documento }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Barrio: <span style="text-decoration: underline;"> {{ $ventaData->barrio }} </span>
                </td>
                <td style="width: 35%">
                    Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->ciudad }} </span>
                </td>
                <td style="width: 35%">
                    Teléfono: <span style="text-decoration: underline;"> {{ $ventaData->telefono }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 30%">
                    Celular: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 70%">
                    E-mail: <span style="text-decoration: underline;"> {{ $ventaData->email }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Estado Civil: <span style="text-decoration: underline;"> {{ $ventaData->estado_civil }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Representación: <span style="text-decoration: underline;"> {{ $ventaData->tipo_representacion }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Ocupación: <span style="text-decoration: underline;"> {{ $ventaData->ocupacion }} </span>
                </td>
                <td style="width: 60%">
                    Cargo: <span style="text-decoration: underline;"> {{ $ventaData->cargo }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 70%">
                    Empresa:  <span style="text-decoration: underline;"> {{ $ventaData->empresa }} </span>
                </td>
                <td style="width: 30%">
                    Teléfono:  <span style="text-decoration: underline;"> {{ $ventaData->telefonoEmpresa }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">
                    Tiempo de vinculación:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_vinculacion }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Contrato:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_contrato }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 100%">
                    ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;"> {{ $ventaData->encuesta }} </span>
                </td>
            </tr>
        </table>
    </div>
@endforeach

<p>
    En constancia de aceptación se firma en Bogotá D.C., el día 
    <span style="text-decoration: underline;">( {{ date('d') }} )</span> 
    de <span style="text-decoration: underline;"> {{ date('m') }} </span> de dos mil dieciocho (2018).
</p>
<h4>El(los) reservante(s), </h4>

@foreach($venta as $ventaData)
    <div style="display: inline-block; width: 50%; vertical-align: top">
        <br>
        
        ----------------------------------------------<br>
        Nombre: {{ $ventaData->name }}<br>
        C.C. {{ $ventaData->documento }}    
    </div>
    
    <div style="display: inline-block; width: 50%; vertical-align: top">
        @foreach($datosSegunCompra as $ventaData)
            <br>
            
            -------------------------------------------<br>
            Nombre: {{ $ventaData->name }}<br>
            C.C. {{ $ventaData->documento }}   
        @endforeach
    </div>
@endforeach

@foreach($venta as $ventaData)
    <h3 style="text-align: center">Forma de Pago: </h3>
    <div style="border: solid 1px; width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%">
                    Precio de Venta: 
                    <span style="text-decoration: underline;"> 
                        @if ($ventaData->tipoPropiNombre == "Torre 1")
                            $149´950.000   
                        @else
                            $166´150.000   
                        @endif   
                    </span>
                </td>
                <td style="width: 50%">
                    Separación:
                    <span style="text-decoration: underline;">
                        @if ($ventaData->tipoPropiNombre == "Torre 1")
                            $6.000.000 
                        @else
                            $8.000.000    
                        @endif 
                    </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%">
                    Cuota Inicial: 
                    <span style="text-decoration: underline;">
                        @if ($ventaData->tipoPropiNombre == "Torre 1")
                            $74´975.000
                        @else
                            $83´075.000     
                        @endif
                    </span>
                </td>
                <td style="width: 50%">
                    Saldo o Valor del Crédito (50%):
                    <span style="text-decoration: underline;">
                        @if ($ventaData->tipoPropiNombre == "Torre 1")
                            $74´975.000   
                        @else
                            $83´075.000  
                        @endif
                    </span>
                </td>
            </tr>
        </table>
    </div>
@endforeach

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
                <td>7</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>8</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>9</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>10</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>11</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>12</td>
                <td>$1´970.714</td>
                <td>__/10/2018</td>
            </tr>
             <tr>
                <td>13</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>14</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>15</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>16</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>17</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>18</td>
                <td>$1´970.714</td>
                <td>__/10/2018</td>
            </tr>
             <tr>
                <td>19</td>
                <td>$ 6.000.000</td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>20</td>
                <td>$1´970.714</td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>21</td>
                <td>$1´970.714</td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>22</td>
                <td>$1´970.714</td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>23</td>
                <td>$1´970.714</td>
                <td>__/09/2018</td>
            </tr>
            
        </table>
        <p>Nota: El Plan de Pagos corresponde a un (1) inmueble. </p>
    </div>
    
    

    <footer style="position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; "  >footer on each page</footer>

