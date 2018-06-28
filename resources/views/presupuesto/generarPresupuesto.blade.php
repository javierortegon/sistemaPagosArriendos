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
                            <input type="hidden" name= "inputUserId" value ="" id ="inputUserId">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre:</label>
                                <div class="col-md-6">
                                    <input id="clienteExistenteNombre" type="text" style="border:none" class="form-control" name="clienteExistenteNombre" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Documento:</label>
                                <div class="col-md-6">
                                    <input id="clienteExistenteDocumento" type="text" style="border:none" class="form-control" name="clienteExistenteDocumento" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Email:</label>
                                <div class="col-md-6">
                                    <input id="clienteExistenteEmail" type="text" style="border:none" class="form-control" name="clienteExistenteEmail" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            SELECCIONAR TIPO DE PROPIEDAD
                        </div>
                        <div class="form-group">
                            <label for="proyecto" class="col-md-4 control-label">Proyecto:</label>
                            <select  id="proyecto" name="proyecto" class="col-md-6" required>
                                <option value="">Seleccionar</option>
                                @foreach($proyectos as $proyecto)
                                    <option value="{{$proyecto['id']}}">{{$proyecto['nombre']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipoPropiedad" class="col-md-4 control-label">Tipo de propiedad:</label>
                            <select  id="tipoPropiedad" name="tipoPropiedad" class="col-md-6" required>
                                <option value="">Seleccionar</option>
                                @foreach($tiposPropiedad as $tipoPropiedad)
                                    <option value="{{$tipoPropiedad['id']}}">{{$tipoPropiedad['nombre']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Valor total:</label>
                            <div class="col-md-6">
                                <input id="valorTotal" type="text" style="border:none" class="form-control" name="valorTotal" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Cuota inicial:</label>
                            <div class="col-md-6">
                                <input id="valorCuotaInicial" type="text" style="border:none" class="form-control" name="valorCuotaInicial" value="">
                            </div>
                        </div>  
                        <div class = "form-group row">
                            DATOS DE PAGOS PARA CUOTA INICIAL
                        </div>
                        <div class="form-group{{ $errors->has('primerPago') ? ' has-error' : '' }}">
                            <label for="primerPago" class="col-md-4 control-label">Primer pago:</label>                
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
<form class="form-horizontal" action="{{ url('usuarios/selectAjax/FIELD/CHARACTERS') }}" method="GET" id ="formDatosAjax">
    {{ csrf_field() }}
    {{ method_field('GET') }}
</form>
@endsection
@section('scripts')
<script src="{{asset('js/scriptsPersonalizados/formatoMoneda.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#numeroDeCuotas").keydown(function(event){
        if ('0123456789'.indexOf(event.key) == -1 && event.key != "Backspace" && event.key != "Delete" && event.key != "ArrowLeft" && event.key != "ArrowRight"){
            event.preventDefault();            
        }
    });
    var proyectos = <?= json_encode($proyectos) ?>;
    var tiposPropiedad = <?= json_encode($tiposPropiedad) ?>;
    $('#proyecto').on('change', function(event) {
        proyecto = $("#proyecto option:selected").val();
        opcionesTipos = '<option value="">Seleccionar</option>';
        for(i=0;i<tiposPropiedad.length;i++){
            if(parseInt(tiposPropiedad[i].proyecto) == parseInt(proyecto)){
                opcionesTipos = opcionesTipos.concat('<option value="'+tiposPropiedad[i].id+'">'+tiposPropiedad[i].nombre+'</option>');
            }
        }
        $('#tipoPropiedad').html(opcionesTipos);
    });
    var tipoPropiedad;
    var separadorDeMiles = ",";
    var separadorDecimal = ".";
    var signoMoneda = "$ ";
    $('#tipoPropiedad').on('change', function(event) {
        tipoPropiedad = $("#tipoPropiedad option:selected").val();
        indiceTipoPropiedad = tipoPropiedad -1;
        $('#valorTotal').val("$ "+new Intl.NumberFormat('es-MX').format(tiposPropiedad[parseInt(indiceTipoPropiedad)].valor));
        $('#valorCuotaInicial').val("$ "+new Intl.NumberFormat('es-MX').format(tiposPropiedad[parseInt(indiceTipoPropiedad)].cuota_inicial));
    });
    formatoMoneda('#primerPago',separadorDecimal,separadorDeMiles,signoMoneda);
});
</script>
<script src="{{asset('js/scriptsPersonalizados/buscarUsuarioAjax.js')}}"></script>
@endsection