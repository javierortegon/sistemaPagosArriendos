@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Modificar Tipo de Propiedad</div>

					<div class="panel-body">
						<form class="form-horizontal" action="{{ url('tipoPropiedad/edit/'. $tipoPropiedad['id']) }}" method="POST">
							<input type="hidden" name="_method" value="PUT">
                            {{-- TODO: Abrir el formulario e indicar el método POST --}}
                            {{ csrf_field() }}
                            {{-- TODO: Protección contra CSRF --}}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="nombre" class="col-md-4 control-label">Nombre</label>
								<div class="col-md-6">
									<input type="text" name="nombre" id="nombre" class="form-control" value="{{ $tipoPropiedad['nombre'] }}" required>
								</div>
							</div>
							<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
								<label for="descripcion" class="col-md-4 control-label">Descripcion</label>
								<div class="col-md-6">
									<input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $tipoPropiedad['descripcion'] }}" required>
								</div>
							</div>
							<div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
								<label for="valor" class="col-md-4 control-label">Valor</label>
								<div class="col-md-6">
									<input type="text" name="valor" id="valor" class="form-control" value="{{ $tipoPropiedad['valor'] }}" required>
								</div>
							</div>
							<div class="form-group{{ $errors->has('cuotaInicial') ? ' has-error' : '' }}">
								<label for="cuotaInicial" class="col-md-4 control-label">Cuota Inicial</label>
								<div class="col-md-6">
									<input type="text" name="cuotaInicial" id="cuotaInicial" class="form-control" value="{{ $tipoPropiedad['cuotaInicial'] }}" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Guardar Cambios
									</button>
								</div>
							</div>
						</form>
						<form action="{{ action('TiposPropiedadController@deleteTipo', $tipoPropiedad->id) }}" method="POST"  class="form-horizontal">
							{{ method_field('delete') }}
							{{ csrf_field() }}
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button class='btn btn-danger'>
										Eliminar Tipo de Propiedad
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