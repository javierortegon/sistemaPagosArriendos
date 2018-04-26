@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Tipos de Propiedad</div>
					<div class="panel-body">
                        <form class="form-horizontal" action="{{ url('registroTipoPropiedad').'/'.$proyecto['id'] }}" method="POST">
                            {{-- TODO: Abrir el formulario e indicar el método POST --}}
                            {{ csrf_field() }}
                            {{-- TODO: Protección contra CSRF --}}
                            @if (count($tiposPropiedad) == 0)
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="" class="col-md-4 control-label"></label>
                                    <div class="col-md-6">
                                    <h5>No tiene tipos de Propiedades Registradas en el Proyecto: <b>{{ $proyecto['nombre'] }}</b></h5>
                                    </div>
                                </div>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $tiposPropiedad as $tipoPropiedad )
                                    <tr>
                                        <td>{{ $tipoPropiedad['nombre'] }}</td>
                                        <td>{{ $tipoPropiedad['descripcion'] }}</td>
                                        <td><a href="{{ url('tipoPropiedad/edit/'. $tipoPropiedad['id']) }}">Editar</a></td>
                                    </tr>                                        
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="nombre" class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-6">
                                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="descripcion" class="col-md-4 control-label">Descripcion</label>
                                <div class="col-md-6">
                                    <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar Tipo de Propiedad
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