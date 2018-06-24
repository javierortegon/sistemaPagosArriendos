@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Modificar Proyecto</div>

					<div class="panel-body">
							<form class="form-horizontal" action="{{ url('proyecto/edit').'/'.$Proyecto['id'] }}" method="POST">

								<input type="hidden" name="_method" value="PUT">
                                {{-- TODO: Abrir el formulario e indicar el método POST --}}
                                {{ csrf_field() }}
                                {{-- TODO: Protección contra CSRF --}}

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="nombre" class="col-md-4 control-label">Nombre</label>
									<div class="col-md-6">
										<input type="text" name="nombre" id="nombre" class="form-control" value="{{ $Proyecto['nombre'] }}" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="direccion" class="col-md-4 control-label">Direccion</label>
									<div class="col-md-6">
										<input type="text" name="direccion" id="direccion" class="form-control" value="{{ $Proyecto['direccion'] }}" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="numeroPisos" class="col-md-4 control-label">Numero de Pisos</label>
									<div class="col-md-6">
										<input type="number" name="numeroPisos" id="numeroPisos" class="form-control" value="{{ $Proyecto['numero_de_pisos'] }}">
									</div>
								</div>

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="numeroApartamentos" class="col-md-4 control-label">Numero Apartamentos</label>
									<div class="col-md-6">
										<input type="number" name="numeroApartamentos" id="numeroApartamentos" class="form-control" value="{{ $Proyecto['numero_de_apartamentos'] }}" required>
									</div>
								</div>

								<div class="form-group{{ $errors->has('fachaFinalizacion') ? ' has-error' : '' }}">
									<label for="fachaFinalizacion" class="col-md-4 control-label">Fecha de Finalización</label>
									<div class="col-md-6">
										<input type="date" name="fachaFinalizacion" id="fachaFinalizacion" class="form-control" required>
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