@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Anular Venta</div>
					<div class="panel-body">
						<div class="col-md-4"><b>Id:</b></div>
						<div class="col-md-6">{{ $venta['id'] }}</div>

						<div class="col-md-4"><b>Propiedad:</b></div>
						<div class="col-md-6">{{ $venta['codigo'] }}</div>

						<div class="col-md-4"><b>Comprador:</b></div>
						<div class="col-md-6">{{ $venta['comprador'] }}</div>

						<div class="col-md-4"><b>Id:</b></div>
						<div class="col-md-6">{{ $venta['direccion'] }}</div>

						<div class="col-md-4"><b>Proyecto:</b></div>
						<div class="col-md-6">{{ $venta['nombreProyec'] }}</div>

						<div class="col-md-4"><b>Tipo:</b></div>
						<div class="col-md-6">{{ $venta['tipoPropiedad'] }}</div>
					</div>

					<div class="panel-body">
						<form class="form-horizontal" action="{{ url('ventas/anular').'/'.$venta['id'] }}" method="POST">
							<input type="hidden" name="_method" value="PUT">
                            {{-- TODO: Abrir el formulario e indicar el método POST --}}
                            {{ csrf_field() }}
                            {{-- TODO: Protección contra CSRF --}}
                            <div class="col-md-4"><b>Razón para anular la venta:</b></div>
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-md-6">
									<textarea name="novedades" id="novedades" class="form-control" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Anular venta
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