@extends('layouts.app')

@section('content')
		<div class="col-md-2"></div>	
		<div class="col-md-8">
			<li><a href="{{ url('/asignarArrendatario') }}">Registro Usuarios</a></li>
            <form action="{{ url('propiedad/create') }}" method="POST">
				{{-- TODO: Abrir el formulario e indicar el método POST --}}
                    {{ csrf_field() }}
					{{-- TODO: Protección contra CSRF --}}

					<div class="form-group">
    					<label for="title">Codigo</label>
    					<input type="text" name="codigo" id="codigo" class="form-control">
					</div>

					<div class="form-group">
    					<label for="title">Nombre</label>
    					<input type="text" name="nombre" id="nombre" class="form-control">
					</div>
    
    				<div class="form-group">
    					<label for="title">Direccion</label>
    					<input type="text" name="direccion" id="direccion" class="form-control">
					</div>

                    <div class="form-group">
    					<label for="title">Descripcion</label>
    					<textarea type="textarea" name="descripcion" id="descripcion" class="form-control"></textarea>
					</div>

					

					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
							Añadir propiedad
						</button>
					</div>

					{!!	Notification::showAll()	!!}
            </form>
		<div>
		<div class="col-md-2"></div>	
@endsection