<img style="width: 100%;margin-top:-48px;" src="{{{ asset('img/head_pdf.png') }}}">

@if (count($venta) <= 0)
    <p>NO TIENE DATOS COMPLETOS PARA GENERAR EL PDF</p>
@else

@foreach($venta as $ventaData)
    <div style="text-align: center">
        <p>
            ORDEN DE RESERVA<br>
            PROYECTO “{{ $ventaData->proyectoNombre }}”<br>
            {{ strtoupper($ventaData->tipoPropiNombre) }}<br>
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
    <div style="border: solid 1px; ">
        <table  style="width: 100%">
            <tr style="width: 100%;">
                <td style="width: 50%;" colspan="2">
                    Nombre: <span style="text-decoration: underline;"> {{ $ventaData->name }} </span>
                </td>
                <td style="width: 50%;">
                    Documento de Identidad:  <span style="text-decoration: underline;"> {{ $ventaData->documento }} </span>
                </td>
            </tr>
            <tr style="width: 100%;">
                <td style="" colspan="3">
                    Dirección de Correspondencia: <span style="text-decoration: underline;"> {{ $ventaData->direccion_correspondencia }} </span>
                </td>   
            </tr>
            <tr style="width: 100%; ">
                <td style="width: 33%" colspan="1">
                    Barrio: <span style="text-decoration: underline;"> {{ $ventaData->barrio }} </span>
                </td>
                <td style="width: 33%" colspan="1">
                    Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->ciudad }} </span>
                </td>
                <td style="width: 33%" colspan="1">
                    Teléfono: <span style="text-decoration: underline;"> {{ $ventaData->telefono }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    Celular: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 50%;" colspan="2">
                    E-mail: <span style="text-decoration: underline;"> {{ $ventaData->email }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;" colspan="2">
                    Estado Civil: <span style="text-decoration: underline;"> {{ $ventaData->estado_civil }} </span>
                </td>
                <td style="width: 50%;" colspan="1">
                    Tipo de Representación: <span style="text-decoration: underline;"> {{ $ventaData->tipo_representacion }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    Ocupación: <span style="text-decoration: underline;"> {{ $ventaData->ocupacion }} </span>
                </td>
                <td style="width: 50%;" colspan="2">
                    Cargo: <span style="text-decoration: underline;"> {{ $ventaData->cargo }} </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;" colspan="2">
                    Empresa:  <span style="text-decoration: underline;"> {{ $ventaData->empresa }} </span>
                </td>
                <td style="width: 50%;">
                    Teléfono:  <span style="text-decoration: underline;"> {{ $ventaData->telefonoEmpresa }} </span>
                </td>
            </tr>
            <tr>
                <td style="" colspan="2">
                    Tiempo de vinculación:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_vinculacion }} </span>
                </td>
                <td style="width: 60%">
                    Tipo de Contrato:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_contrato }} </span>
                </td>
            </tr>
            <tr>
                <td style="" colspan="3">
                    ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;"> {{ $ventaData->encuesta }} </span>
                </td>
            </tr>
        </table>
    </div>
@endforeach    

@if (count($datosSegunCompra) > 0)
    @foreach($datosSegunCompra as $ventaData)
        <h3 style="text-align: center">Datos del Reservante (2):</h3>
        <div style="border: solid 1px; width: 100%; margin-bottom: 140px; vertical-align: top;">
            <table  style="width: 100%">
                <tr style="width: 100%;">
                    <td style="width: 50%;" colspan="2">
                        Nombre: <span style="text-decoration: underline;"> {{ $ventaData->name }} </span>
                    </td>
                    <td style="width: 50%;">
                        Documento de Identidad:  <span style="text-decoration: underline;"> {{ $ventaData->documento }} </span>
                    </td>
                </tr>
                <tr style="width: 100%;">
                    <td style="" colspan="3">
                        Dirección de Correspondencia: <span style="text-decoration: underline;"> {{ $ventaData->direccion_correspondencia }} </span>
                    </td>   
                </tr>
                <tr style="width: 100%; ">
                    <td style="width: 33%" colspan="1">
                        Barrio: <span style="text-decoration: underline;"> {{ $ventaData->barrio }} </span>
                    </td>
                    <td style="width: 33%" colspan="1">
                        Ciudad: <span style="text-decoration: underline;"> {{ $ventaData->ciudad }} </span>
                    </td>
                    <td style="width: 33%" colspan="1">
                        Teléfono: <span style="text-decoration: underline;"> {{ $ventaData->telefono }} </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        Celular: <span style="text-decoration: underline;">  </span>
                    </td>
                    <td style="width: 50%;" colspan="2">
                        E-mail: <span style="text-decoration: underline;"> {{ $ventaData->email }} </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;" colspan="2">
                        Estado Civil: <span style="text-decoration: underline;"> {{ $ventaData->estado_civil }} </span>
                    </td>
                    <td style="width: 50%;" colspan="1">
                        Tipo de Representación: <span style="text-decoration: underline;"> {{ $ventaData->tipo_representacion }} </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;">
                        Ocupación: <span style="text-decoration: underline;"> {{ $ventaData->ocupacion }} </span>
                    </td>
                    <td style="width: 50%;" colspan="2">
                        Cargo: <span style="text-decoration: underline;"> {{ $ventaData->cargo }} </span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 50%;" colspan="2">
                        Empresa:  <span style="text-decoration: underline;"> {{ $ventaData->empresa }} </span>
                    </td>
                    <td style="width: 50%;">
                        Teléfono:  <span style="text-decoration: underline;"> {{ $ventaData->telefonoEmpresa }} </span>
                    </td>
                </tr>
                <tr>
                    <td style="" colspan="2">
                        Tiempo de vinculación:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_vinculacion }} </span>
                    </td>
                    <td style="width: 60%">
                        Tipo de Contrato:   <span style="text-decoration: underline;"> {{ $ventaData->tipo_contrato }} </span>
                    </td>
                </tr>
                <tr>
                    <td style="" colspan="3">
                        ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;"> {{ $ventaData->encuesta }} </span>
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
@else
    <h3 style="text-align: center">Datos del Reservante (2):</h3>
    <div style="border: solid 1px; width: 100%; margin-bottom: 150px;">
        <table  style="width: 100%">
            <tr style="width: 100%;">
                <td style="width: 50%;" colspan="2">
                    Nombre: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 50%;">
                    Documento de Identidad:  <span style="text-decoration: underline;">  </span>
                </td>
            </tr>
            <tr style="width: 100%;">
                <td style="" colspan="3">
                    Dirección de Correspondencia: <span style="text-decoration: underline;"> </span>
                </td>   
            </tr>
            <tr style="width: 100%; ">
                <td style="width: 33%" colspan="1">
                    Barrio: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 33%" colspan="1">
                    Ciudad: <span style="text-decoration: underline;"> </span>
                </td>
                <td style="width: 33%" colspan="1">
                    Teléfono: <span style="text-decoration: underline;">  </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    Celular: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 50%;" colspan="2">
                    E-mail: <span style="text-decoration: underline;">  </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;" colspan="2">
                    Estado Civil: <span style="text-decoration: underline;"> </span>
                </td>
                <td style="width: 50%;" colspan="1">
                    Tipo de Representación: <span style="text-decoration: underline;">  </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    Ocupación: <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 50%;" colspan="2">
                    Cargo: <span style="text-decoration: underline;">  </span>
                </td>
            </tr>
            <tr>
                <td style="width: 50%;" colspan="2">
                    Empresa:  <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 50%;">
                    Teléfono:  <span style="text-decoration: underline;">  </span>
                </td>
            </tr>
            <tr>
                <td style="" colspan="2">
                    Tiempo de vinculación:   <span style="text-decoration: underline;">  </span>
                </td>
                <td style="width: 60%">
                    Tipo de Contrato:   <span style="text-decoration: underline;"> </span>
                </td>
            </tr>
            <tr>
                <td style="" colspan="3">
                    ¿Cómo se enteró del proyecto?:    <span style="text-decoration: underline;">  </span>
                </td>
            </tr>
        </table>
    </div>    
@endif    


@foreach($venta as $ventaData)
    <h3 style="text-align: center; ">Forma de Pago: </h3>
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
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $ 6.000.000  
                    @else
                        $ 8.000.000  
                    @endif
                </td>
                <td>__/05/2018</td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714  
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/06/2018</td>
            </tr>
            <tr>
                <td>3</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714   
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/07/2018</td>
            </tr>
            <tr>
                <td>4</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714   
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/08/2018</td>
            </tr>
            <tr>
                <td>5</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714   
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/09/2018</td>
            </tr>
            <tr>
                <td>6</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714  
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/10/2018</td>
            </tr>
             <tr>
                <td>7</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714   
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/11/2018</td>
            </tr>
            <tr>
                <td>8</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714   
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/12/2018</td>
            </tr>
            <tr>
                <td>9</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/01/2019</td>
            </tr>
            <tr>
                <td>10</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/02/2019</td>
            </tr>
            <tr>
                <td>11</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/03/2019</td>
            </tr>
            <tr>
                <td>12</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/04/2019</td>
            </tr>
             <tr>
                <td>13</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/05/2019</td>
            </tr>
            <tr>
                <td>14</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/06/2019</td>
            </tr>
            <tr>
                <td>15</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/07/2019</td>
            </tr>
            <tr>
                <td>16</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/08/2019</td>
            </tr>
            <tr>
                <td>17</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714   
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/09/2019</td>
            </tr>
            <tr>
                <td>18</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/10/2019</td>
            </tr>
             <tr>
                <td>19</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/11/2019</td>
            </tr>
            <tr>
                <td>20</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/12/2019</td>
            </tr>
            <tr>
                <td>21</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/01/2020</td>
            </tr>
            <tr>
                <td>22</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/02/2020</td>
            </tr>
            <tr>
                <td>23</td>
                <td>
                    @if ($ventaData->tipoPropiNombre == "Torre 1")
                        $1´970.714    
                    @else
                        $2´145.000  
                    @endif
                </td>
                <td>__/03/2020</td>
            </tr>
        </table>
    </div>
    @endif  