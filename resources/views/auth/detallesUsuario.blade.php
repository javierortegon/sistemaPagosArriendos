@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Usuario</div>

					<div class="panel-body">
                        <div class="col-md-4"><b>Id:</b></div>
                        <div class="col-md-6">{{ $usuario['id'] }}</div>
                        <div class="col-md-4"><b>Nombre:</b></div>
                        <div class="col-md-6">{{ $usuario['name'] }}</div>
                        <div class="col-md-4"><b>Email:</b></div>
                        <div class="col-md-6">{{ $usuario['email'] }}</div>
                        <div class="col-md-4"><b>Documento:</b></div>
                        <div class="col-md-6">{{ $usuario['documento'] }}</div>
                        <div class="col-md-4"><b>Teléfono:</b></div>
                        <div class="col-md-6">{{ $usuario['telefono'] }}</div>
                        <div class="col-md-4"><b>Dirección:</b></div>
                        <div class="col-md-6">{{ $usuario['direccion'] }}</div>
                        <div class="col-md-4"><b>Estado:</b></div>
                        <div class="col-md-6">{{ $usuario['estado'] }}</div>
                    
                        <div class="col-md-4"><b>Roles:</b></div>
                        <div class="col-md-6">
                            @if (count($roles) == 0)
                                No tiene roles registrados
                            @else
                                - 
                                @foreach( $roles as $rol )
                                    {{ $rol->rol }} -                      
                                @endforeach
                            @endif
                        </div>
                    </div>
                    

                    <div class="panel-heading">Propiedades:</div>
                    <div class="panel-body">                  
                        @if(count($propiedades)==0)
                            No tiene propiedades registradas
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Proyecto</th>
                                        <th>Direccion</th>
                                        <th>Tipo de propiedad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $propiedades as $propiedad )
                                        <tr>
                                            <td>{{$propiedad->codigo}}</td>
                                            <td>{{$propiedad->proyecto}}</td>
                                            <td>{{$propiedad->direccion}}</td>
                                            <td>{{$propiedad->tipo}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {!! $propiedades->render() !!}
                        @endif
                    </div>
				</div>
			</div>
		</div>			
	</div>	
@endsection