@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Modificar Tipo de Propiedad</div>

					<div class="panel-body">
							<form class="form-horizontal" action="{{ url('proyecto/edit')}}" method="POST">

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

								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="direccion" class="col-md-4 control-label">Descripcion</label>
									<div class="col-md-6">
										<input type="text" name="direccion" id="direccion" class="form-control" value="{{ $tipoPropiedad['descripcion'] }}" required>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary">
											Guardar Cambios
										</button>

                                        <button type="submit" class="btn btn-primary">
											Eliminar
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