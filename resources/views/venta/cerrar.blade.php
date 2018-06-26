@extends('layouts.app')

@section('content')

    <div class="col-md-8 col-md-offset-2">
        {!!	Notification::showAll()	!!}
        <div class="panel panel-default">
            <div class="panel-heading">Datos Propiedad</div>
            <div class="panel-body">
                <div class="col-md-6">
                        
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Nombre Proyecto:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['nombreProyec'] }}</label>
                        </div>
                    </div>  
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Tipo Inmueble:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['tipo'] }}</label>
                        </div>
                    </div>    
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Codigo:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['codigo'] }}</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">    
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Nombre:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['nombre'] }}</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Direccion:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['direccionPropiedad'] }}</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Valor:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['valor'] }}</label>
                        </div>
                    </div>
                </div>    
            </div>

            <div class="panel-heading">Datos Comprador</div>
            <div class="panel-body">
                <div class="col-md-6">
                        
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Nombre:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['name'] }}</label>
                        </div>
                    </div>  
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Documento:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['documento'] }}</label>
                        </div>
                    </div>    
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Email:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['email'] }}</label>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">    
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Direccion:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['direccion'] }}</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Barrio:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['barrio'] }}</label>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Ciudad:</label>
                        <div class="col-md-6">
                            <label>{{ $venta['ciudad'] }}</label>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>    
@endsection