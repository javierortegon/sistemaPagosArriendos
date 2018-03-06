@extends('layouts.app')

@section('content')
		<div class="col-md-2"></div>	
		<div class="col-md-8">
            <form  method="POST" action="{{  url('usuario/edit').'/'.$usuario['id']  }}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}

					<div class="form-group">
    					<label for="title">Nombre</label>
    					<input type="text" name="nombre" id="nombre" class="form-control" value="{{ $usuario['name'] }}">
					</div>

					<div class="form-group">
    					<label for="title">Email</label>
    					<input type="text" name="email" id="email" class="form-control" value="{{ $usuario['email'] }}">
					</div>
                    
                    <div class="form-group">
                        <label for="title">Estado</label>
                        <select name="estado" id="estado" class="form-control" >
                            <option value="1">Activo</option>
                            <option value="0">Desactivo</option>
                        </select>
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