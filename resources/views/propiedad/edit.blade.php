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
								<label for="numeroPiso" class="col-md-4 control-label">Numero de Piso</label>
								<div class="col-md-6">
									<input type="number" name="numeroPiso" id="numeroPiso" class="form-control" value="{{ $propiedad['numero_piso'] }}" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="areaArquitec" class="col-md-4 control-label">Área Arquitectónica Aprox (M2)</label>
								<div class="col-md-6">
									<input type="number" name="areaArquitec" id="areaArquitec" class="form-control" value="{{ $propiedad['area_aproximada'] }}" required>
								</div>
							</div>

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="AreaPrivaApro" class="col-md-4 control-label">Área Privada Aprox (M2)</label>
								<div class="col-md-6">
									<input type="number" name="AreaPrivaApro" id="AreaPrivaApro" class="form-control" value="{{ $propiedad['area_privada_aprox'] }}" required>
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

							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="proyecto" class="col-md-4 control-label">Estado</label>
								<div class="col-md-6">
									@if ( $propiedad['estado'] == 1)
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