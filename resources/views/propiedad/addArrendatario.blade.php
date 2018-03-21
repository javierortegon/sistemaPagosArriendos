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
                                    SI tiene
                                @endif
                            </h4>
                        <form  method="POST" action="{{  url('propiedad/edit')  }}">
                            
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
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
                            </div>
        
                            {!!	Notification::showAll()	!!} 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection