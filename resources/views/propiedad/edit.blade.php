@extends('layouts.app')

@section('content')
		<div class="col-md-2"></div>	
		<div class="col-md-8">
            <form  method="POST" action="{{  url('propiedad/edit').'/'.$propiedad['id']  }}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}

					<div class="form-group">
    					<label for="title">Codigo</label>
    					<input type="text" name="codigo" id="codigo" class="form-control" value="{{ $propiedad['codigo'] }}">
					</div>

					<div class="form-group">
    					<label for="title">Nombre</label>
    					<input type="text" name="nombre" id="nombre" class="form-control" value="{{ $propiedad['nombre'] }}">
					</div>
    
    				<div class="form-group">
    					<label for="title">Direccion</label>
    					<input type="text" name="direccion" id="direccion" class="form-control" value="{{ $propiedad['direccion'] }}">
					</div>

                    <div class="form-group">
    					<label for="title">Descripcion</label>
    					<textarea type="textarea" name="descripcion" id="descripcion" class="form-control">{{ $propiedad['descripcion'] }}</textarea>
                    </div>
                    
					<div class="form-group">
                        <label for="title">Estado</label><br>
						@if ( $propiedad['estado'] == 1)
							Activo <input type="radio" name="estado" value="1" checked="true"><br>
							Inactivo <input type="radio" value="0" name="estado"><br>  
						@else
							Activo <input type="radio" value="1" name="estado"><br>
							Inactivo <input type="radio" name="estado" value="0" checked="true"><br> 
						@endif 
                    </div>


					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
							Guardar Cambios
						</button>
					</div>

                    {!!	Notification::showAll()	!!}
                     
            </form>

		<div>
		<div class="col-md-2"></div>	
@endsection