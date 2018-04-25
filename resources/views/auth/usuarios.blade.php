@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            {!!	Notification::showAll()	!!}

            <div class="panel panel-default">
					<div class="panel-heading">Lista de Propiedades</div>
					<div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Mail</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Rol</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $usuarios as $usuario )
                                    <tr>
                                        <td>{{$usuario->name}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>
                                            @if ($usuario->estado == 1)
                                                Activo
                                            @else
                                                Desactivo    
                                            @endif    
                                        </td>
                                        <td><a href="{{ url('usuario/edit/'. $usuario['id']) }}">Editar</a></td>
                                        <td><a href="{{ url('usuario/editRol/'. $usuario['id']) }}">Modificar Roles</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $usuarios->render() !!}
                    </div>
                </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    
@stop