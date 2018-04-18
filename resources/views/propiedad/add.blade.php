@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Registro Propiedad</div>

					<div class="panel-body">
							<form class="form-horizontal" action="{{ url('propiedad/create') }}" method="POST">

								{{-- TODO: Abrir el formulario e indicar el método POST --}}
								{{ csrf_field() }}
								{{-- TODO: Protección contra CSRF --}}

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="codigo" class="col-md-4 control-label">Codigo</label>
									<div class="col-md-6">
										<input type="text" name="codigo" id="codigo" class="form-control" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="nombre" class="col-md-4 control-label">Nombre</label>
									<div class="col-md-6">
										<input type="text" name="nombre" id="nombre" class="form-control">
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="direccion" class="col-md-4 control-label">Direccion</label>
									<div class="col-md-6">
										<input type="text" name="direccion" id="direccion" class="form-control">
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="descripcion" class="col-md-4 control-label">Descripcion</label>
									<div class="col-md-6">
										<textarea type="textarea" name="descripcion" id="descripcion" class="form-control"></textarea>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="proyecto" class="col-md-4 control-label">Proyecto</label>
									<div class="col-md-6">
										<select name="proyecto" id="proyecto" class="form-control">
										@foreach( $proyectos as $proyecto )
											<option value="{{ $proyecto['id'] }}">{{ $proyecto['nombre'] }}</option>
										@endforeach
										</select>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary">
											Añadir propiedad
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