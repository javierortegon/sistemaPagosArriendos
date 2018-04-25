@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Lista de Proyectos</div>
					<div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $proyectos as $proyecto )
                                    <tr>
                                        <td>{{$proyecto->nombre}}</td>
                                        <td>{{$proyecto->direccion}}</td>
                                        <td><a href="{{ url('tiposPropiedad/'. $proyecto['id']) }}">Tipos de Inmuebles</a></td>
                                        <td><a href="{{ url('proyecto/edit/'. $proyecto['id']) }}">Editar</a></td>
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