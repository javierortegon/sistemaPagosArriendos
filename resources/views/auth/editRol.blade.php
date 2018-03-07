@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            {!!	Notification::showAll()	!!}
            <table class="table">
                <thead>
                    <tr>
                        <th>Rol</th>
                        <th>Activo</th>
                        <th>Desactivo</th>
                    </tr>
                </thead>
                <tbody>
                    <form  method="POST" action="{{  url('usuario/edit').'/'.$usuario  }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
            
                        @foreach( $roles as $rol )
                            <tr>
                                <td>Administrador</td>
                                @if ($rol->rol == 1)
                                <td><input type="radio" value="1" name="estadoRol1" checked="true"></td>
                                <td><input type="radio" name="estadoRol1" value="0"></td>
                                @else
                                <td><input type="radio" value="1" name="estadoRol1"></td>
                                <td><input type="radio" name="estadoRol1" value="0" checked="true"></td>   
                                @endif    
                            </tr>
                            <tr>    
                                <td>Arrendatario</td>
                                @if ($rol->rol == 2)
                                <td><input type="radio" value="1" name="estadoRol2" checked="true"></td>
                                <td><input type="radio" name="estadoRol2" value="0"></td>
                                @else
                                <td><input type="radio" value="1" name="estadoRol2"></td>
                                <td><input type="radio" name="estadoRol2" value="0" checked="true"></td>   
                                @endif
                            </tr>
                            <tr>    
                                <td>Propietario</td>
                                @if ($rol->rol == 3)
                                <td><input type="radio" value="1" name="estadoRol3" checked="true"></td>
                                <td><input type="radio" name="estadoRol3" value="0"></td>
                                @else
                                <td><input type="radio" value="1" name="estadoRol3"></td>
                                <td><input type="radio" name="estadoRol3" value="0" checked="true"></td>   
                                @endif
                            </tr>
                        @endforeach
                    </form>
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>
    
@stop