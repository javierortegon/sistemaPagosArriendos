@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Editar Propiedad</div>
					<div class="panel-body">
						<form class="form-horizontal"  method="POST" action="{{  url('propiedad/edit').'/'.$propiedad['id']  }}">
							
							<input type="hidden" name="_method" value="PUT">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="codigo" class="col-md-4 control-label">Codigo</label>
								<div class="col-md-6">
									<input type="text" name="codigo" id="codigo" class="form-control" value="{{ $propiedad['codigo'] }}" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="nombre" class="col-md-4 control-label">Nombre</label>
								<div class="col-md-6">
									<input type="text" name="nombre" id="nombre" value="{{ $propiedad['nombre'] }}" class="form-control" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="direccion" class="col-md-4 control-label">Direccion</label>
								<div class="col-md-6">
									<input type="text" name="direccion" id="direccion" class="form-control" value="{{ $propiedad['direccion'] }}" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="descripcion" class="col-md-4 control-label">Descripcion</label>
								<div class="col-md-6">
									<textarea type="textarea" name="descripcion" id="descripcion" class="form-control" required>{{ $propiedad['descripcion'] }}</textarea>
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