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
                    @if(count($documentos)>0)
                    <div class="panel-heading">Documentos existentes en base de datos</div>
                    <div class="panel-body">
                        <form class="form-horizontal" action="{{ url('documentos/eliminar') }}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            {{-- TODO: Abrir el formulario e indicar el método POST --}}
                            {{ csrf_field() }}
                            {{-- TODO: Protección contra CSRF --}}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Fecha de registro en base de datos</th>
                                            <th>Fecha de entrega (registrada por usuario)</th>
                                            <th>Documento entregado</th>
                                            <th>Información adicional</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0 ?>
                                    @while( $i < count($documentos) )
                                    <tr>
                                        <td>{{ $documentos[$i]['created_at'] }}</td>
                                        <td>{{ $documentos[$i]['fecha_entrega'] }}</td>
                                        <td>{{ $documentos[$i]['documento'] }}</td>
                                        <td>{{ $documentos[$i]['informacion_adicional'] }}</td>
                                        <td>
                                            <input type="checkbox" class = "documentos" name="eliminar_{{ $i }}" value="{{ $documentos[$i]['id'] }}">
                                        </td>
                                    </tr>  
                                    <?php $i++ ?>                                       
                                    @endwhile
                                    <input type="hidden" class = "documentos" name="numeroDeDocumentos" value={{$i}}>
                                    <input type="hidden" class = "documentos" name="idVenta" value={{ $venta['id'] }}>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
							    	Eliminar seleccionados
							    </button>
                            </div>
                        </form>
                    </div>
                    @endif

                    
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