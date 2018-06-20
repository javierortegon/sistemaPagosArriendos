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
                        <div class="form-group">                    
                            SELECCIONAR USUARIO
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            SELECCIONAR TIPO DE PROPIEDAD
                        </div>
                        <div>
                            <input class="form-check-input selectUsuarioNoE" type="radio" name="usuarioNoE" id="rbUsuarioNuevo" value="nuevo" checked>
                            <label class="form-check-label selectUsuarioNoE" for="rbUsuarioNuevo">
                                Torre 1
                            </label>
                            <br />
                            <input class="form-check-input selectUsuarioNoE" type="radio" name="usuarioNoE" id="rbUsuarioExistente" value="existente">
                            <label class="form-check-label selectUsuarioNoE" for="rbUsuarioExistente">
                                Torre 2
                            </label>
                            <br />
                        </div>                       
                        <div class = "form-group">
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
                </form>
            </div>
        </div>
    </div>
</div>
@endsection