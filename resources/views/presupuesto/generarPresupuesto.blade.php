@extends('layouts.app')

@section('content')
<div class="">
	<div class="col-md-10 col-md-offset-1">
		{!!	Notification::showAll()	!!}
		<div class="panel panel-default">
			<div class="panel-heading">Generar Presupuesto</div>
			<div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('registroPresupuesto') }}">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group row">                    
                            SELECCIONAR CLIENTE
                        </div>
                        <div id = "divBusquedaUsuarioExistente">
                            <input type="hidden" name= "inputUserId" value ="" id ="inputUserId">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Buscar cliente:</label>
                                <div class="col-md-6">
                                    <select class = "col-md-12" name="campo" id="campoParaBuscar">
                                        <option value="name">Buscar por nombre</option>
                                        <option value="email">Buscar por email</option>
                                        <option value="documento">Buscar por documento</option>
                                        <option value="telefono">Buscar por telefono</option>
                                    </select>
                                    <input class = "col-md-12" list="usuariosDataList" type = "search" name="busqueda" id="busqueda" autocomplete="off" autofocus>                                           
                                    <datalist id="usuariosDataList">
                                    </datalist>
                                    <br />
                                    <button type="button" class="col-md-12 btn btn-warning" id="btnSeleccionUsuario">Seleccionar Usuario</button>  
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre:</label>
                                <div class="col-md-6">
                                    <input id="clienteNombre" type="text" style="border:none" class="form-control" name="clienteNombre" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Documento:</label>
                                <div class="col-md-6">
                                    <input id="clienteCorreo" type="text" style="border:none" class="form-control" name="clienteCorreo" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Email:</label>
                                <div class="col-md-6">
                                    <input id="clienteEmail" type="text" style="border:none" class="form-control" name="clienteEmail" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            SELECCIONAR CLASE DE PROPIEDAD
                        </div>
                        <div class="form-group">
                            <label for="estado_civil2" class="col-md-4 control-label">Clase de propiedad:</label>
                            <div class="col-md-6">
                                <select  id="estado_civil2" name="estado_civil2" class="form-control" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Torre1">Torre 1</option>
                                    <option value="Torre2">Torre 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Valor cuota inicial:</label>
                            <div class="col-md-6">
                                <input id="valorCuotaInicial" type="text" style="border:none" class="form-control" name="valorCuotaInicial" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Valor total:</label>
                            <div class="col-md-6">
                                <input id="valorTotal" type="text" style="border:none" class="form-control" name="valorTotal" value="">
                            </div>
                        </div>               
                        <div class = "form-group row">
                            DATOS DE PAGOS
                        </div>
                        <div class="form-group{{ $errors->has('primerPago') ? ' has-error' : '' }}">
                            <label for="primerPago" class="col-md-4 control-label">Valor primer pago:</label>                
                            <div class="col-md-6">
                                <input id="primerPago" type="text" class="form-control" name="primerPago" value="{{ old('primerPago') }}" required>
                                @if ($errors->has('primerPago'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('primerPago') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('numeroDeCuotas') ? ' has-error' : '' }}">
                            <label for="numeroDeCuotas" class="col-md-4 control-label">Número de cuotas:</label>                
                            <div class="col-md-6">
                                <input id="numeroDeCuotas" type="number" class="form-control" name="numeroDeCuotas" value="35" min="0" max = "35" required>
                                @if ($errors->has('numeroDeCuotas'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numeroDeCuotas') }}</strong>
                                    </span>
                                @endif
                            </div>             
                        </div>             
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                Generar presupuesto
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection