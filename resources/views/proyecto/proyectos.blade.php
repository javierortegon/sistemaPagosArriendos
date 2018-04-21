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
                                    <th>Numero de Pisos</th>
                                    <th>Numero de Apartementos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $proyectos as $proyecto )
                                    <tr>
                                        <td>{{$proyecto->nombre}}</td>
                                        <td>{{$proyecto->direccion}}</td>
                                        <td>{{$proyecto->numero_de_pisos}}</td>
                                        <td>{{$proyecto->numero_de_apartamentos}}</td>
                                
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