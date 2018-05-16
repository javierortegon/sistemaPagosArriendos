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
                                    <input type="hidden" name="_method" value="PUT">
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
                                                <input id="name" type="text" class="form-control" name="name" value="{{ $propieda['name'] }}" required autofocus>
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
                                                <input id="email" type="email" class="form-control" name="email" value="{{ $propieda['email'] }}" required>
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
                                                    <input id="documento" type="text" class="form-control" name="documento" value = "{{$propieda['documento']}}" required>
                                                </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                            <label for="telefono" class="col-md-4 control-label">Teléfono</label>
                                            <div class="col-md-6">
                                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $propieda['telefono'] }}" required>
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
                                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ $propieda['direccion']  }}" required>
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
                                                <input id="barrio" type="text" class="form-control" name="barrio" value="{{ $propieda['barrio']  }}" required>
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
                                                <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ $propieda['ciudad'] }}" required>
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
                                                <input id="estado_civil" type="text" class="form-control" name="estado_civil" value="{{ $propieda['estado_civil'] }}" required>
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
                                                <input id="tipo_representacion" type="text" class="form-control" name="tipo_representacion" value="{{ $propieda['tipo_representacion'] }}" required>
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
                                                <input id="ocupacion" type="text" class="form-control" name="ocupacion" value="{{ $propieda['ocupacion'] }}" required>
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
                                                <input id="cargo" type="text" class="form-control" name="cargo" value="{{ $propieda['cargo'] }}" required>
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
                                                <input id="empresa" type="text" class="form-control" name="empresa" value="{{ $propieda['empresa'] }}" required>
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
                                                <input id="tipo_vinculacion" type="text" class="form-control" name="tipo_vinculacion" value="{{ $propieda['tipo_vinculacion'] }}" required>
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
                                                <input id="tipo_contrato" type="text" class="form-control" name="tipo_contrato" value="{{ $propieda['tipo_contrato'] }}" required>
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
                                                <input id="encuesta" type="text" class="form-control" name="encuesta" value="{{ $propieda['encuesta'] }}" required>
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
                                        <label class="col-md-6 segundoComprador"><input type="checkbox" class = "segundoComprador" id="segundoComprador" name="segundoComprador" value="segundoComprador"> Ingresar segundo comprador</label>
                                    </div>

                                    <div id="datosUsuario2" hidden>
                                        <div class="col-md-4">
                                        </div>
                                        @if($clienteExistenteRegistrado==0)
                                            <div class="col-md-6">
                                                <input class="form-check-input selectUsuarioNoE" type="radio" name="usuarioNoE" id="rbUsuarioNuevo" value="nuevo" checked>
                                                <label class="form-check-label selectUsuarioNoE" for="rbUsuarioNuevo">
                                                    Usuario nuevo
                                                </label>
                                                <br />
                                                <input class="form-check-input selectUsuarioNoE" type="radio" name="usuarioNoE" id="rbUsuarioExistente" value="existente">
                                                <label class="form-check-label selectUsuarioNoE" for="rbUsuarioExistente">
                                                    Usuario existente
                                                </label>
                                            </div>
                                        @else
                                            <div class="col-md-6">
                                                <input class="form-check-input selectUsuarioNoE" type="radio" name="usuarioNoE" id="rbUsuarioNuevo" value="nuevo" >
                                                <label class="form-check-label selectUsuarioNoE" for="rbUsuarioNuevo">
                                                    Usuario nuevo
                                                </label>
                                                <br />
                                                <input class="form-check-input selectUsuarioNoE" type="radio" name="usuarioNoE" id="rbUsuarioExistente" value="existente" checked>
                                                <label class="form-check-label selectUsuarioNoE" for="rbUsuarioExistente">
                                                    Usuario existente
                                                </label>
                                            </div>
                                        @endif

                                        <br />
                                        <br />
                                        <br />
                                        <div id = "divBusquedaUsuarioExistente" hidden>
                                            <input type="hidden" name= "inputUserId" value ="" id ="inputUserId">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Buscar usuario:</label>
                                                <div class="col-md-6">
                                                    <select name="campo" id="campoParaBuscar">
                                                        <option value="name">name</option>
                                                        <option value="email">email</option>
                                                    </select> 
                                                    <input list="usuariosDataList" type = "search" name="busqueda" id="busqueda" autocomplete="off" autofocus>                                           
                                                    <datalist id="usuariosDataList">
                                                    </datalist>
                                                    <br />
                                                    <br />
                                                    <button type="button" class="btn btn-warning" id="btnSeleccionUsuario">Seleccionar Usuario</button>  
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">                                            
                                                <label class="col-md-4 control-label">Id usuario seleccionado:</label>
                                                <div class="col-md-6">
                                                    <input id="id_usuario2" type="text" style="border:none" class="form-control" name="id_usuario2" value="{{ $comprador2['id_usuario'] }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name2') ? ' has-error' : '' }}">
                                            <label for="name2" class="col-md-4 control-label">Nombre</label>
                                            <div class="col-md-6">
                                                <input id="name2" type="text" class="form-control" name="name2" value="{{ $comprador2['name'] }}"  autofocus>
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
                                                <input id="email2" type="email2" class="form-control" name="email2" value="{{ $comprador2['email'] }}" >
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
                                                    <input id="documento2" type="text" class="form-control" name="documento2" value="{{ $comprador2['documento'] }}">
                                                </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('telefono2') ? ' has-error' : '' }}">
                                            <label for="telefono2" class="col-md-4 control-label">Teléfono</label>
                                            <div class="col-md-6">
                                                <input id="telefono2" type="text" class="form-control" name="telefono2" value="{{$comprador2['telefono'] }}" >
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
                                                <input id="direccion2" type="text" class="form-control" name="direccion2" value="{{ $comprador2['direccion'] }}" >
                                                @if ($errors->has('direccion2'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('direccion2') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('barrio2') ? ' has-error' : '' }}">
                                            <label for="barrio2" class="col-md-4 control-label">Barrio</label>
                                            <div class="col-md-6">
                                                <input id="barrio2" type="text" class="form-control" name="barrio2" value="{{ $comprador2['barrio'] }}" >
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
                                                <input id="ciudad2" type="text" class="form-control" name="ciudad2" value="{{ $comprador2['ciudad'] }}" >
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
                                                <input id="estado_civil2" type="text" class="form-control" name="estado_civil2" value="{{ $comprador2['estado_civil'] }}" >
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
                                                <input id="tipo_representacion2" type="text" class="form-control" name="tipo_representacion2" value="{{ $comprador2['tipo_representacion'] }}" >
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
                                                <input id="ocupacion2" type="text" class="form-control" name="ocupacion2" value="{{ $comprador2['ocupacion'] }}" >
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
                                                <input id="cargo2" type="text" class="form-control" name="cargo2" value="{{ $comprador2['cargo'] }}" >
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
                                                <input id="empresa2" type="text" class="form-control" name="empresa2" value="{{ $comprador2['empresa'] }}" >
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
                                                <input id="tipo_vinculacion2" type="text" class="form-control" name="tipo_vinculacion2" value="{{ $comprador2['tipo_vinculacion'] }}" >
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
                                                <input id="tipo_contrato2" type="text" class="form-control" name="tipo_contrato2" value="{{ $comprador2['tipo_contrato'] }}" >
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
                                                <input id="encuesta2" type="text" class="form-control" name="encuesta2" value="{{ $comprador2['encuesta'] }}" >
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
                                            <label for="valor" class="col-md-4 control-label">Valor</label>
                                            <div class="col-md-6">
                                                <input id="valor" type="text" class="form-control" name="valor" value = "{{$propieda['valor']}}" required>
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
    <script src="{{asset('js/scriptsPersonalizados/completarVenta.js')}}"></script>    
@endsection
