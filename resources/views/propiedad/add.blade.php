@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
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
										<input type="text" name="nombre" id="nombre" class="form-control" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="direccion" class="col-md-4 control-label">Direccion</label>
									<div class="col-md-6">
										<input type="text" name="direccion" id="direccion" class="form-control" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="numeroPiso" class="col-md-4 control-label">Numero de Piso</label>
									<div class="col-md-6">
										<input type="number" name="numeroPiso" id="numeroPiso" class="form-control" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="areaArquitec" class="col-md-4 control-label">Área Arquitectónica Aprox (M2)</label>
									<div class="col-md-6">
										<input type="number" name="areaArquitec" id="areaArquitec" class="form-control" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="AreaPrivaApro" class="col-md-4 control-label">Área Privada Aprox (M2)</label>
									<div class="col-md-6">
										<input type="number" name="AreaPrivaApro" id="AreaPrivaApro" class="form-control" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="descripcion" class="col-md-4 control-label">Descripcion</label>
									<div class="col-md-6">
										<textarea type="textarea" name="descripcion" id="descripcion" class="form-control" required></textarea>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="proyecto" class="col-md-4 control-label">Proyecto</label>
									<div class="col-md-6">
										<select name="proyecto" id="proyecto" class="form-control">
											<option value="" disabled selected>Seleccione Proyecto</option>	
										@foreach( $proyectos as $proyecto )
											<option value="{{ $proyecto['id'] }}">{{ $proyecto['nombre'] }}</option>
										@endforeach
										</select>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="tipoPropiedad" class="col-md-4 control-label">Tipo Propiedad</label>
									<div class="col-md-6">
										<select name="tipoPropiedad" id="tipoPropiedad" class="form-control">
											<option value="" disabled selected>Seleccione Proyecto</option>	
										</select>
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

@section('scripts')
    <script src="{{asset('js/scriptsPersonalizados/main.js')}}"></script>
@endsection