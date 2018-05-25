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
                                <div class="col-md-6">.{{ $venta['comprador'] }}</div>

                                <div class="col-md-4"><b>Tel{efono:</b></div>
                                <div class="col-md-6">.{{ $venta['telefono'] }}</div>

                                <div class="col-md-4"><b>Documento:</b></div>
                                <div class="col-md-6">.{{ $venta['documento'] }}</div>

                                <div class="col-md-4"><b>Inmueble:</b></div>
                                <div class="col-md-6">.{{ $venta['codigo'] }}</div>

                                <div class="col-md-4"><b>Tipo:</b></div>
                                <div class="col-md-6">.{{ $venta['tipoPropiedad'] }}</div>

                                <div class="col-md-4"><b>Proyecto:</b></div>
                                <div class="col-md-6">.{{ $venta['nombreProyec'] }}</div>

                                <div class="col-md-4"><b>Dirección:</b></div>
                                <div class="col-md-6">.{{ $venta['direccion'] }}</div>

                                <div class="col-md-4"><b>Proyecto:</b></div>
                                <div class="col-md-6">.{{ $venta['nombreProyec'] }}</div>

                                <div class="col-md-4"><b>Tipo:</b></div>
                                <div class="col-md-6">.{{ $venta['tipoPropiedad'] }}</div>


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
                    <div class="panel-heading">Documentos entregados</div>
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

                    <div class="panel-heading">Documentos entregados</div>

                    <div class="panel-body">
                            <form class="form-horizontal" action="{{ url('documentos/registrar').'/'.$venta['id'] }}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                {{-- TODO: Abrir el formulario e indicar el método POST --}}
                                {{ csrf_field() }}
                                {{-- TODO: Protección contra CSRF --}}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div >
                                            <label class="col-md-4"><input type="checkbox" class = "documentos" name="encargoFiduciario" value="Encargo Fiduciario"> Encargo fiduciario</label>
                                            <label class="col-md-6"><input type="checkbox" class = "documentos" name="cedula" value="Cedula"> Cédula</label>
                                            <label class="col-md-4"><input type="checkbox" class = "documentos" name="certificacionLaboral" value="Certificacion Laboral"> Certificación Laboral</label>
                                            <label class="col-md-6"><input type="checkbox" class = "documentos" name="declaracionDeRenta" value="Declaracion de Renta"> Declaración de renta</label>
                                            <label class="col-md-4"><input type="checkbox" class = "documentos" name="subsidio" value="Subsidio"> Subsidio</label>
                                            <label class="col-md-6" id="tarjetaDeFiduciaLabel"><input type="checkbox" class = "documentos" name="tarjetaDeFiducia" id="tarjetaDeFiducia" value="Tarjeta de Fiducia"> Tarjeta de Fiducia</label>
                                            <label class="col-md-4"> Número Tarjeta Fiducia:</label>
                                            <div class="col-md-6"><input type="text" name = "numeroTarjetaFiducia" id="numeroTarjetaFiducia" readonly></div>
                                    </div>
								</div>
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-md-4">Fecha de entrega:</label>
                                    <div class="col-md-6">
                                        <input type="date" name="fecha_entrega" required>
                                    </div>
                                </div>

								<div class="form-group{{ $errors->has('novedades') ? ' has-error' : '' }}">
                                    <label class="col-md-4">Novedades y comentarios:</label>
						            <div class="form-group{{ $errors->has('novedades') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
						            		<textarea name="novedades" id="novedades" class="form-control" required></textarea>
						            	</div>
						            </div>
                                </div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary">
											Guardar Información
										</button>
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
</script>
@endsection