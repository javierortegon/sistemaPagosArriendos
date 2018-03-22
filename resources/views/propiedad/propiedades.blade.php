@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
                {!!	Notification::showAll()	!!}
            <table class="table">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $propiedades as $propiedad )
                        <tr>
                            <td>{{$propiedad->codigo}}</td>
                            <td>{{$propiedad->nombre}}</td>
                            <td>{{$propiedad->direccion}}</td>
                            <td>{{$propiedad->descripcion}}</td>
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
        <div class="col-md-2"></div>
    </div>
    
@stop