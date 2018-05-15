@extends('layouts.app')

@section('content')
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>direccion</th>
            <th>Descripción</th>
            <th>nombre</th>
        </tr>                            
    </thead>
    <tbody>
        @foreach($propiedades as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->direccion }}</td>
            <td>{{ $product->descripcion }}</td>
            <td class="text-right">{{ $product->nombre }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection