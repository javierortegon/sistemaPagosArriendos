@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Proyecto</div>

					<div class="panel-body">
                        <div class = "row">
                            <div class="col-md-6"><b>Nombre:</b></div>
                            <div class="col-md-6">{{ $proyecto['nombre'] }}</div>
                        </div>
                        <div class = "row">
                            <div class="col-md-6"><b>Direccion:</b></div>
                            <div class="col-md-6">{{ $proyecto['direccion'] }}</div>
                        </div>
                        <div class = "row">
                            <div class="col-md-6"><b>Numero Pisos:</b></div>
                            <div class="col-md-6">{{ $proyecto['numero_de_pisos'] }}</div>
                        </div>
                        <div class = "row">
                            <div class="col-md-6"><b>Numero Apartementos:</b></div>
                            <div class="col-md-6">{{ $proyecto['numero_de_apartamentos'] }}</div>
                        </div>
                        <div class = "row">
                            <div class="col-md-6"><b>Fecha de Finalización:</b></div>
                            <div class="col-md-6">{{ $proyecto['fecha_finalizacion'] }}</div>
                        </div>
                    </div>
                    
                    <div class="panel-heading">Tipos de propiedad</div>

                    @if (count($tiposPropiedad) == 0)
                        <div class="panel-body">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                <h5>No tiene tipos de Propiedades Registradas en el Proyecto: <b>{{ $proyecto['nombre'] }}</b></h5>
                                </div>
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
                            </tr>                                        
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div class="panel-heading">Propiedades</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Proyecto</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $propiedades as $propiedad )
                                <tr>
                                    <td>{{$propiedad->codigo}}</td>
                                    <td>{{$propiedad->nombre}}</td>
                                    <td>{{$propiedad->direccion}}</td>
                                    <td>{{$proyecto->nombre}}</td>
                                    <td>{{$propiedad->tipoPropiedad}}</td>
                                    <td>
                                    @if($propiedad->estadoVenta == 1)
                                        Vendida
                                    @else
                                        Disponible
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $propiedades->render() !!}
				</div>
			</div>
		</div>			
	</div>	
@endsection