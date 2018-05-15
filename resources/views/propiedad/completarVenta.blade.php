@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Registro Venta</div>
					<div class="panel-body">
                        @foreach( $propiedad as $propieda )
                            @if ($propieda['estado'] == 0)

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">
                                        La propiedad esta desactivada por favor activela para generar la venta
                                    </label>
                                </div>

                            @else
                                <form class="form-horizontal"  method="POST" action="{{  url('ventas/editar').'/'.$propieda['id'] }}">
                                    {{ csrf_field() }}
                                    <div id="datosPropiedad">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">DATOS DE LA PROPIEDAD</label>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Codigo</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['codigo'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Nombre:</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['nombre'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Dirección:</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['direccion'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Proyecto:</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['nombreProyec'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Tipo:</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['tipo'] }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <br />

                                    <div id="datosUsuario1">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">DATOS DEL COMPRADOR 1:</label>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class="col-md-4 control-label">Nombre</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                                                <label for="documento" class="col-md-4 control-label">Documento</label>
                                                <div class="col-md-6">
                                                    <input id="documento" type="text" class="form-control" name="documento" required>
                                                </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                            <label for="telefono" class="col-md-4 control-label">Teléfono</label>
                                            <div class="col-md-6">
                                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                                                @if ($errors->has('telefono'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('telefono') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                            <label for="direccion" class="col-md-4 control-label">Dirección</label>
                                            <div class="col-md-6">
                                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
                                                @if ($errors->has('direccion'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('direccion') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('barrio') ? ' has-error' : '' }}">
                                            <label for="barrio" class="col-md-4 control-label">Barrio</label>
                                            <div class="col-md-6">
                                                <input id="barrio" type="text" class="form-control" name="barrio" value="{{ old('barrio') }}" required>
                                                @if ($errors->has('barrio'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('barrio') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
                                            <label for="ciudad" class="col-md-4 control-label">Ciudad</label>
                                            <div class="col-md-6">
                                                <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" required>
                                                @if ($errors->has('ciudad'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ciudad') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('estado_civil') ? ' has-error' : '' }}">
                                            <label for="estado_civil" class="col-md-4 control-label">Estado Civil</label>
                                            <div class="col-md-6">
                                                <input id="estado_civil" type="text" class="form-control" name="estado_civil" value="{{ old('estado_civil') }}" required>
                                                @if ($errors->has('estado_civil'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('estado_civil') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_representacion') ? ' has-error' : '' }}">
                                            <label for="tipo_representacion" class="col-md-4 control-label">Tipo de Representación</label>
                                            <div class="col-md-6">
                                                <input id="tipo_representacion" type="text" class="form-control" name="tipo_representacion" value="{{ old('tipo_representacion') }}" required>
                                                @if ($errors->has('tipo_representacion'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tipo_representacion') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('ocupacion') ? ' has-error' : '' }}">
                                            <label for="ocupacion" class="col-md-4 control-label">Ocupación</label>
                                            <div class="col-md-6">
                                                <input id="ocupacion" type="text" class="form-control" name="ocupacion" value="{{ old('ocupacion') }}" required>
                                                @if ($errors->has('ocupacion'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ocupacion') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('cargo') ? ' has-error' : '' }}">
                                            <label for="cargo" class="col-md-4 control-label">Cargo</label>
                                            <div class="col-md-6">
                                                <input id="cargo" type="text" class="form-control" name="cargo" value="{{ old('cargo') }}" required>
                                                @if ($errors->has('cargo'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cargo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
                                            <label for="empresa" class="col-md-4 control-label">Empresa</label>
                                            <div class="col-md-6">
                                                <input id="empresa" type="text" class="form-control" name="empresa" value="{{ old('empresa') }}" required>
                                                @if ($errors->has('empresa'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('empresa') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_vinculacion') ? ' has-error' : '' }}">
                                            <label for="tipo_vinculacion" class="col-md-4 control-label">Tipo de Vinculacion</label>
                                            <div class="col-md-6">
                                                <input id="tipo_vinculacion" type="text" class="form-control" name="tipo_vinculacion" value="{{ old('tipo_vinculacion') }}" required>
                                                @if ($errors->has('tipo_vinculacion'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tipo_vinculacion') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_contrato') ? ' has-error' : '' }}">
                                            <label for="tipo_contrato" class="col-md-4 control-label">Tipo de Contrato</label>
                                            <div class="col-md-6">
                                                <input id="tipo_contrato" type="text" class="form-control" name="tipo_contrato" value="{{ old('tipo_contrato') }}" required>
                                                @if ($errors->has('tipo_contrato'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tipo_contrato') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('encuesta') ? ' has-error' : '' }}">
                                            <label for="encuesta" class="col-md-4 control-label">¿Cómo se enteró del Proyecto?</label>
                                            <div class="col-md-6">
                                                <input id="encuesta" type="text" class="form-control" name="encuesta" value="{{ old('encuesta') }}" required>
                                                @if ($errors->has('encuesta'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('encuesta') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <br />

                                    <div class="form-group{{ $errors->has('name2') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">DATOS DEL COMPRADOR 2:</label>
                                        <label class="col-md-6 segundoComprador"><input type="checkbox" class = "segundoComprador" id="segundoComprador" name="segundoComprador" value=""> Ingresar segundo comprador</label>
                                    </div>

                                    <div id="datosUsuario2" hidden>
                                        <div class="form-group{{ $errors->has('name2') ? ' has-error' : '' }}">
                                            <label for="name2" class="col-md-4 control-label">Nombre</label>
                                            <div class="col-md-6">
                                                <input id="name2" type="text" class="form-control" name="name2" value="{{ old('name2') }}"  autofocus>
                                                @if ($errors->has('name2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('email2') ? ' has-error' : '' }}">
                                            <label for="email2" class="col-md-4 control-label">E-Mail</label>
                                            <div class="col-md-6">
                                                <input id="email2" type="email2" class="form-control" name="email2" value="{{ old('email2') }}" >
                                                @if ($errors->has('email2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('documento2') ? ' has-error' : '' }}">
                                                <label for="documento2" class="col-md-4 control-label">Documento</label>
                                                <div class="col-md-6">
                                                    <input id="documento2" type="text" class="form-control" name="documento2" >
                                                </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('telefono2') ? ' has-error' : '' }}">
                                            <label for="telefono2" class="col-md-4 control-label">Teléfono</label>
                                            <div class="col-md-6">
                                                <input id="telefono2" type="text" class="form-control" name="telefono2" value="{{ old('telefono2') }}" >
                                                @if ($errors->has('telefono2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('telefono2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('direccion2') ? ' has-error' : '' }}">
                                            <label for="direccion2" class="col-md-4 control-label">Dirección</label>
                                            <div class="col-md-6">
                                                <input id="telefono2" type="text" class="form-control" name="telefono2" value="{{ old('telefono2') }}" >
                                                @if ($errors->has('telefono2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('telefono2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('barrio2') ? ' has-error' : '' }}">
                                            <label for="barrio2" class="col-md-4 control-label">Barrio</label>
                                            <div class="col-md-6">
                                                <input id="barrio2" type="text" class="form-control" name="barrio2" value="{{ old('barrio2') }}" >
                                                @if ($errors->has('barrio2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('barrio2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('ciudad2') ? ' has-error' : '' }}">
                                            <label for="ciudad2" class="col-md-4 control-label">Ciudad</label>
                                            <div class="col-md-6">
                                                <input id="ciudad2" type="text" class="form-control" name="ciudad2" value="{{ old('ciudad2') }}" >
                                                @if ($errors->has('ciudad2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ciudad2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('estado_civil2') ? ' has-error' : '' }}">
                                            <label for="estado_civil2" class="col-md-4 control-label">Estado Civil</label>
                                            <div class="col-md-6">
                                                <input id="estado_civil2" type="text" class="form-control" name="estado_civil2" value="{{ old('estado_civil2') }}" >
                                                @if ($errors->has('estado_civil2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('estado_civil2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_representacion2') ? ' has-error' : '' }}">
                                            <label for="tipo_representacion2" class="col-md-4 control-label">Tipo de Representación</label>
                                            <div class="col-md-6">
                                                <input id="tipo_representacion2" type="text" class="form-control" name="tipo_representacion2" value="{{ old('tipo_representacion2') }}" >
                                                @if ($errors->has('tipo_representacion2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tipo_representacion2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('ocupacion2') ? ' has-error' : '' }}">
                                            <label for="ocupacion2" class="col-md-4 control-label">Ocupación</label>
                                            <div class="col-md-6">
                                                <input id="ocupacion2" type="text" class="form-control" name="ocupacion2" value="{{ old('ocupacion2') }}" >
                                                @if ($errors->has('ocupacion2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('ocupacion2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('cargo2') ? ' has-error' : '' }}">
                                            <label for="cargo2" class="col-md-4 control-label">Cargo</label>
                                            <div class="col-md-6">
                                                <input id="cargo2" type="text" class="form-control" name="cargo2" value="{{ old('cargo2') }}" >
                                                @if ($errors->has('cargo2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('cargo2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('empresa2') ? ' has-error' : '' }}">
                                            <label for="empresa2" class="col-md-4 control-label">Empresa</label>
                                            <div class="col-md-6">
                                                <input id="empresa2" type="text" class="form-control" name="empresa2" value="{{ old('empresa2') }}" >
                                                @if ($errors->has('empresa2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('empresa2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_vinculacion2') ? ' has-error' : '' }}">
                                            <label for="tipo_vinculacion2" class="col-md-4 control-label">Tipo de Vinculacion</label>
                                            <div class="col-md-6">
                                                <input id="tipo_vinculacion2" type="text" class="form-control" name="tipo_vinculacion2" value="{{ old('tipo_vinculacion2') }}" >
                                                @if ($errors->has('tipo_vinculacion2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tipo_vinculacion2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_contrato2') ? ' has-error' : '' }}">
                                            <label for="tipo_contrato2" class="col-md-4 control-label">Tipo de Contrato</label>
                                            <div class="col-md-6">
                                                <input id="tipo_contrato2" type="text" class="form-control" name="tipo_contrato2" value="{{ old('tipo_contrato2') }}" >
                                                @if ($errors->has('tipo_contrato2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tipo_contrato2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('encuesta2') ? ' has-error' : '' }}">
                                            <label for="encuesta2" class="col-md-4 control-label">¿Cómo se enteró del Proyecto?</label>
                                            <div class="col-md-6">
                                                <input id="encuesta2" type="text" class="form-control" name="encuesta2" value="{{ old('encuesta2') }}" >
                                                @if ($errors->has('encuesta2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('encuesta2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    


                                    <br />
                                    <br />
                                    <div id="detallesCompra">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">DETALLES COMPRA</label>
                                        </div>

                                        <div class="form-group{{ $errors->has('cita') ? ' has-error' : '' }}">
                                            <label for="cita" class="col-md-4 control-label">Cita para documentos:</label>
                                            <div class="col-md-6">
                                                <input id="cita" type="datetime-local" class="form-control" name="cita" required>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('valor') ? ' has-error' : '' }}">
                                            <label for="valor" class="col-md-4 control-label">Valor Total</label>
                                            <div class="col-md-6">
                                                <input id="valor" type="text" class="form-control" name="valor" required>
                                            </div>
                                        </div>


                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="metodoPago" class="col-md-4 control-label">Metodo Pago</label>
                                            <div class="col-md-6">
                                                <select id="metodoPago" name="metodoPago" class="form-control">
                                                    <option value="efectivo">Efectivo</option>
                                                    <option value="credito">Credito</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Guardar Cambios
                                            </button>
                                        </div>
                                    </div>
                

                                </form>


                            @endif

                        @endforeach        
                    </div>
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
    <script>
        $(document).ready(function(){
            $(".segundoComprador").click(function(){
                if(document.getElementById("segundoComprador").checked){
                    $("#datosUsuario2").show(400);
                } else {
                    $("#datosUsuario2").hide(400);            
                }
            });
        });
    </script>
@endsection