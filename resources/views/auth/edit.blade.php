@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Editar Usuario</div>
					<div class="panel-body">
						<form class="form-horizontal" method="POST" action="{{  url('usuario/edit').'/'.$usuario['id']  }}">
							
							<input type="hidden" name="_method" value="PUT">
							{{ csrf_field() }}

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="nombre" class="col-md-4 control-label">Nombre</label>
								<div class="col-md-6">
									<input type="text" name="nombre" id="nombre" class="form-control" value="{{ $usuario['name'] }}" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">Email</label>
								<div class="col-md-6">
									<input type="email" name="email" id="email" value="{{ $usuario['email'] }}" class="form-control" required>
								</div>
							</div>

							<div class="form-group">
								<label for="documento" class="col-md-4 control-label">Documento</label>
	
								<div class="col-md-6">
									<input id="documento" type="text" class="form-control" name="documento" value="{{ $usuario['documento'] }}" required>
								</div>
							</div>
	
							<div class="form-group">
								<label for="telefono" class="col-md-4 control-label">Telefono</label>
	
								<div class="col-md-6">
									<input id="telefono" type="number" class="form-control" name="telefono" value="{{ $usuario['telefono'] }}" required>
								</div>
							</div>
	
							<div class="form-group">
								<label for="direccion" class="col-md-4 control-label">Direccion</label>
	
								<div class="col-md-6">
									<input id="direccion" type="text" class="form-control" name="direccion" value="{{ $usuario['direccion'] }}" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="proyecto" class="col-md-4 control-label">Estado</label>
								<div class="col-md-6">
									@if ( $usuario['estado'] == 1)
										Activo <input type="radio" name="estado" value="1" checked="true"><br>
										Inactivo <input type="radio" value="0" name="estado"><br>  
									@else
										Activo <input type="radio" value="1" name="estado"><br>
										Inactivo <input type="radio" name="estado" value="0" checked="true"><br> 
									@endif 
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
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection	
