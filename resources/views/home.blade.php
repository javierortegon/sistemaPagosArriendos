@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bienvenido {{ Auth::user()->name }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    --Ultima Actualizacion 05 Junio 2018--
                    <h4>Nuevas Funcionalidades y Mejoras</h4>    
                    <ul>
                        <li>Verificacion de documentos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
