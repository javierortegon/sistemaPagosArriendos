@extends('layouts.app')

@section('content')
		
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Registro</div>

                    <div class="panel-body">
                        <h4>Nombre Propiedad: {{ $propiedad['nombre'] }}</h3>
                        <h4>Direccion: {{ $propiedad['direccion'] }}</h3>
                        <h4>Descripcion: {{ $propiedad['descripcion'] }}</h3>
                        <h4>
                            @if (count($arrendatario) == 0)
                                Estado: Casa sin arrendatario
                            @else
                                Estado: Casa arrendada
                            @endif
                        </h4>
                        @if (count($arrendatario) == 0)
                        <form  method="POST" action="{{  url('propiedad/addArrendatario').'/'.$propiedad['id']  }}">
                            <h3>Elegir Arrendatario</h3>
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-6">
                                    <select name="arrendatario" id="arrendatario" class="form-control">
                                        @foreach( $usuarios as $usuario )
                                            <option value="{{$usuario['id']}}">{{$usuario['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
                            </div>
                            {!!	Notification::showAll()	!!} 
                        </form>
                        @else
                            @foreach( $arrendatario as $arrendata )
                                <h4>Nombre Arrendatario: {{ $arrendata['name'] }}</h4>
                                <h4>Fecha Factura: {{ $arrendata['fecha_factura'] }}</h4>
                                <h4>Valor Arriendo: {{ $arrendata['valor_arriendo'] }}</h4>
                                <form action="{{ action('ArrendatariosController@getEdit', $propiedad['id']) }}" method="GET" style="display:inline">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger" style="display:inline">
                                        Editar Arrendatario
                                    </button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection