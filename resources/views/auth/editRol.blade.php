@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="panel panel-default">
     		<div class="panel-heading">
                Editar roles del usuario <b> {{ $usuario->name }} - {{ $usuario->email }} </b>
            </div>

            <div class="panel-body">

                <form  method="POST" action="{{  url('usuario/editRol').'/'.$usuario->id  }}">
                    <input type="hidden" name="_method" value="PUT">
                    {{ csrf_field() }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rol</th>
                                <th>Activo</th>
                                <th>Desactivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Administrador</td>
                                @if ($rol1 == 1)
                                <td><input type="radio" value="1" name="estadoRol1" checked="true"></td>
                                <td><input type="radio" name="estadoRol1" value="0"></td>
                                @else
                                <td><input type="radio" value="1" name="estadoRol1"></td>
                                <td><input type="radio" name="estadoRol1" value="0" checked="true"></td>   
                                @endif  
                            </tr>
                            <tr>
                                <td>Vendedor</td>
                                @if ($rol2 == 1)
                                <td><input type="radio" value="1" name="estadoRol2" checked="true"></td>
                                <td><input type="radio" name="estadoRol2" value="0"></td>
                                @else
                                <td><input type="radio" value="1" name="estadoRol2"></td>
                                <td><input type="radio" name="estadoRol2" value="0" checked="true"></td>   
                                @endif  
                            </tr>
                            <tr>
                                 <td>Propietario</td>
                                 @if ($rol3 == 1)
                                 <td><input type="radio" value="1" name="estadoRol3" checked="true"></td>
                                 <td><input type="radio" name="estadoRol3" value="0"></td>
                                 @else
                                 <td><input type="radio" value="1" name="estadoRol3"></td>
                                 <td><input type="radio" name="estadoRol3" value="0" checked="true"></td>   
                                 @endif  
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Guardar Cambios
                        </button>
                    </div>    
                </form>

            </div> 
        </div>
    </div> 
    <div class="col-md-2"></div>
</div>

@stop