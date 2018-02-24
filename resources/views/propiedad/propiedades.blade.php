@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $propiedades as $propiedad )
                        <tr>
                            <td>{{$propiedad->codigo}}</td>
                            <td>{{$propiedad->nombre}}</td>
                            <td>{{$propiedad->direccion}}</td>
                            <td>{{$propiedad->descripcion}}</td>
                            <td><a href="">Editar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
    
@stop