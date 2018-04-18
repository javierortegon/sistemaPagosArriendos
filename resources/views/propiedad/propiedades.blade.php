@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Lista de Propiedades</div>
					<div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Proyecto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $propiedades as $propiedad )
                                    <tr>
                                        <td>{{$propiedad->codigo}}</td>
                                        <td>{{$propiedad->nombre}}</td>
                                        <td>{{$propiedad->direccion}}</td>
                                        <td>{{$propiedad->nombreProyec}}</td>
                                        <td>
                                            @if ($propiedad->estado == 1)
                                                Activo
                                            @else
                                                Desactivo    
                                            @endif    
                                        </td>
                                        <td><a href="{{ url('propiedad/edit/'. $propiedad['id']) }}">Editar</a></td>
                                        <td><a href="{{ url('propiedad/addArrendatario/'. $propiedad['id']) }}">Asiganar Arrendatario</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection                        