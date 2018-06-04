@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Datos Venta</div>

					<div class="panel-body">
							<form class="form-horizontal" action="{{ url('ventas/anular').'/'.$venta['id'] }}" method="POST">
                                

                                <div class="col-md-4"><b>Usuario:</b></div>
                                <div class="col-md-6">{{ $venta['comprador'] }}</div>

                                <div class="col-md-4"><b>Tel{efono:</b></div>
                                <div class="col-md-6">{{ $venta['telefono'] }}</div>

                                <div class="col-md-4"><b>Documento:</b></div>
                                <div class="col-md-6">{{ $venta['documento'] }}</div>

                                <div class="col-md-4"><b>Inmueble:</b></div>
                                <div class="col-md-6">{{ $venta['codigo'] }}</div>

                                <div class="col-md-4"><b>Tipo:</b></div>
                                <div class="col-md-6">{{ $venta['tipoPropiedad'] }}</div>

                                <div class="col-md-4"><b>Proyecto:</b></div>
                                <div class="col-md-6">{{ $venta['nombreProyec'] }}</div>

                                <div class="col-md-4"><b>Dirección:</b></div>
                                <div class="col-md-6">{{ $venta['direccion'] }}</div>

                                <div class="col-md-4"><b>Proyecto:</b></div>
                                <div class="col-md-6">{{ $venta['nombreProyec'] }}</div>

                                <div class="col-md-4"><b>Tipo:</b></div>
                                <div class="col-md-6">{{ $venta['tipoPropiedad'] }}</div>


								<input type="hidden" name="_method" value="PUT">
                                {{-- TODO: Abrir el formulario e indicar el método POST --}}
                                {{ csrf_field() }}
                                {{-- TODO: Protección contra CSRF --}}

                                

							</form>				
					</div>
                    @if(count($novedades)>0)
                    <div class="panel-heading">Novedades</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Novedad</th>
                                        <th>Usuario que registra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach( $novedades as $novedad )
                                <tr>
                                    <td>{{ $novedad['fecha'] }}</td>
                                    <td>{{ $novedad['novedad'] }}</td>
                                    <td>{{ $novedad['quienRegistra'] }}</td>
                                </tr>                                        
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                    @if(count($documentos)>0)
                    <div class="panel-heading">Documentos entregados (ya registrados)</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha de registro en base de datos</th>
                                        <th>Fecha de entrega (registrada por usuario)</th>
                                        <th>Documento entregado</th>
                                        <th>Información adicional</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach( $documentos as $documento )
                                <tr>
                                    <td>{{ $documento['created_at'] }}</td>
                                    <td>{{ $documento['fecha_entrega'] }}</td>
                                    <td>{{ $documento['documento'] }}</td>
                                    <td>{{ $documento['informacion_adicional'] }}</td>
                                </tr>                                        
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <div class="panel-heading">Documentos</div>

                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('documentos/registrar').'/'.$venta['id'] }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            {{-- TODO: Abrir el formulario e indicar el método POST --}}
                            {{ csrf_field() }}
                            {{-- TODO: Protección contra CSRF --}}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Fecha de entrega</th>
                                        </tr>
                                    <thead>
                                    <tbody>
                                        <tr>
                                            <td><label><input type="checkbox" class = "documentos" name="encargoFiduciario" value="Encargo Fiduciario" @if($documentosQueTiene[0] == 1) checked disabled @else value="Encargo Fiduciario" @endif> Encargo fiduciario</label></td>
                                            <td><input class ="date" type="date" name="fecha_entrega_encargo" required></td>
                                        </tr>
                                        <tr>    
                                            <td><label><input type="checkbox" class = "documentos" name="cedula" value="Cedula"@if($documentosQueTiene[1] == 1) checked disabled @endif> Cédula</label></td>
                                            <td><input class ="date" type="date" name="fecha_entrega_cedula" required></td>                                    
                                        </tr>
                                        <tr>
                                            <td><label><input type="checkbox" class = "documentos" name="certificacionLaboral" value="Certificacion Laboral" @if($documentosQueTiene[2] == 1) checked disabled @endif> Certificación Laboral</label></td>
                                            <td><input class ="date"  type="date" name="fecha_entrega_certificacionLaboral" required></td>                                    
                                        </tr>
                                        <tr>
                                            <td><label><input type="checkbox" class = "documentos" name="declaracionDeRenta" value="Declaracion de Renta" @if($documentosQueTiene[3] == 1) checked disabled @endif> Declaración de renta</label></td>
                                            <td><input class ="date"  type="date" name="fecha_entrega_declaracionDeRenta" required></td>
                                        </tr>
                                        <tr> 
                                            <td><label><input type="checkbox" class = "documentos" name="subsidio" value="Subsidio" @if($documentosQueTiene[4] == 1) checked disabled @endif> Subsidio</label></td>
                                            <td><input class ="date"  type="date" name="fecha_entrega_subsidio" required></td>
                                        </tr>
                                        <tr>
                                            <td><label id="tarjetaDeFiduciaLabel"><input type="checkbox" class = "documentos" name="tarjetaDeFiducia" id="tarjetaDeFiducia" value="Tarjeta de Fiducia" @if($documentosQueTiene[5] == 1) checked disabled @endif> Tarjeta de Fiducia</label></td>
                                            <td><input class ="date"  type="date" name="fecha_entrega_tarjetaDeFiducia" required></td>
                                        </tr>
                                        <tr>
                                            <td><label> Número Tarjeta Fiducia:</label></td>
                                            <td><div><input type="text" name = "numeroTarjetaFiducia" id="numeroTarjetaFiducia" @if($documentosQueTiene[5] == 1) value = "{{$numeroTarjetaFiducia}}" disabled @else readonly @endif></div></td>
                                        </tr>
                                        <tr>
                                            <td><label> Novedades y comentarios:</label></td>
                                            <td><div><textarea name="novedades" id="novedades" class="form-control" required></textarea></div></td>
                                        </tr>
                                    </tbody>                                        
                                </table>
							</div>
                            
							
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button type="submit" class="btn btn-primary">
										Guardar Información
									</button>
                                    <a href="{{ url('documentos/getEliminar/'.$venta['id'])}}" class="btn btn-primary">Eliminar documentos</a>                                    
								</div>
							</div>
                        </form>				
					</div>

				</div>
			</div>
		</div>			
	</div>	
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('.date').val(new Date().toDateInputValue());
    $('#tarjetaDeFiduciaLabel').click(function(){
        if($('#tarjetaDeFiducia').is(':checked')){
            $('#numeroTarjetaFiducia').attr('readonly', false); 
            $('#numeroTarjetaFiducia').attr('required', 'required');
        } else {
            $('#numeroTarjetaFiducia').removeAttr('required');
            $('#numeroTarjetaFiducia').attr('readonly', true);
            $('#numeroTarjetaFiducia').val('');
        }
    });
});
Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});
</script>
@endsection