@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Registro Venta</div>
					<div class="panel-body">
                            @if ($venta['estado'] == 0)

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">
                                        La propiedad esta desactivada por favor activela para generar la venta
                                    </label>
                                </div>

                            @else
                                <form class="form-horizontal"  method="POST" action="{{  url('ventas/editar').'/'.$venta['id'] }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    {{ csrf_field() }}
                                    <div id="datosPropiedad">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">DATOS DE LA PROPIEDAD</label>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Codigo</label>
                                            <div class="col-md-6">
                                                <label>{{ $venta['codigo'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Nombre:</label>
                                            <div class="col-md-6">
                                                <label>{{ $venta['nombre'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Dirección:</label>
                                            <div class="col-md-6">
                                                <label>{{ $venta['direccionPropiedad'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Proyecto:</label>
                                            <div class="col-md-6">
                                                <label>{{ $venta['nombreProyec'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Tipo:</label>
                                            <div class="col-md-6">
                                                <label>{{ $venta['tipo'] }}</label>
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
                                                <input id="name" type="text" class="form-control" name="name" value="{{ $venta['name'] }}" required autofocus>
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
                                                <input id="email" type="email" class="form-control" name="email" value="{{ $venta['email'] }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('tipo_documento') ? ' has-error' : '' }}">
                                            <label for="tipo_documento" class="col-md-4 control-label">Tipo de Documento</label>
                                            <div class="col-md-6">
                                                <select id="tipo_documento" name="tipo_documento" class="form-control" value="Pasaporte">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Cédula de ciudadania">Cédula de ciudadania</option>
                                                    <option value="Cédula de extrangería">Cédula de extrangería</option>
                                                    <option value="Pasaporte">Pasaporte</option>
                                                    <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                                                <label for="documento" class="col-md-4 control-label">Documento</label>
                                                <div class="col-md-6">
                                                    <input id="documento" type="text" class="form-control" name="documento" value = "{{$venta['documento']}}" required>
                                                </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                            <label for="telefono" class="col-md-4 control-label">Teléfono</label>
                                            <div class="col-md-6">
                                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $venta['telefono'] }}" required>
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
                                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ $venta['direccion']  }}" required>
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
                                                <input id="barrio" type="text" class="form-control" name="barrio" value="{{ $venta['barrio']  }}" required>
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
                                                <input id="ciudad" type="text" class="form-control" name="ciudad" value="Bogotá" required>
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
                                                <select id="estado_civil" name="estado_civil" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Casado con sociedad conyugal vigente">Casado con sociedad conyugal vigente</option>
                                                    <option value="Casado con sociedad conyugal disuelta y liquidada">Casado con sociedad conyugal disuelta y liquidada</option>
                                                    <option value="Soltero con unión marital de hecho por mas de dos años">Soltero con unión marital de hecho por mas de dos años</option>
                                                    <option value="Soltero sin unión marital de hecho">Soltero sin unión marital de hecho</option>
                                                    <option value="Soltero con unión marital de hecho por menos de dos años">Soltero con unión marital de hecho por menos de dos años</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_representacion') ? ' has-error' : '' }}">
                                            <label for="tipo_representacion" class="col-md-4 control-label">Tipo de Representación</label>
                                            <div class="col-md-6">
                                            <select id="tipo_representacion" name="tipo_representacion" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Propia">Propia</option>
                                                    <option value="Apoderado">Apoderado</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('ocupacion') ? ' has-error' : '' }}">
                                            <label for="ocupacion" class="col-md-4 control-label">Ocupación</label>
                                            <div class="col-md-6">
                                                <input id="ocupacion" type="text" class="form-control" name="ocupacion" value="{{ $venta['ocupacion'] }}" required>
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
                                                <input id="cargo" type="text" class="form-control" name="cargo" value="{{ $venta['cargo'] }}" required>
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
                                                <input id="empresa" type="text" class="form-control" name="empresa" value="{{ $venta['empresa'] }}" required>
                                                @if ($errors->has('empresa'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('empresa') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_vinculacion') ? ' has-error' : '' }}">
                                            <label for="tipo_vinculacion" class="col-md-4 control-label">Tiempo de Vinculación</label>
                                            <div class="col-md-6">
                                                <input id="tipo_vinculacion" type="text" class="form-control" name="tipo_vinculacion" value="{{ $venta['tipo_vinculacion'] }}" required>
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
                                                <select id="tipo_contrato" name="tipo_contrato" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Indefinido">Indefinido</option>
                                                    <option value="Término fijo">Término fijo</option>
                                                    <option value="Prestación de servicios">Prestación de servicios electrónico</option>
                                                    <option value="Obra labor">Obra labor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('encuesta') ? ' has-error' : '' }}">
                                            <label for="encuesta" class="col-md-4 control-label">¿Cómo se enteró del Proyecto?</label>
                                            <div class="col-md-6">
                                                <select id="encuesta" name="encuesta" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Whatsapp">Whatsapp</option>
                                                    <option value="Correo electrónico">Correo electrónico</option>
                                                    <option value="Referido">Referido</option>
                                                    <option value="Zona">Zona</option>
                                                    <option value="Volante">Volante</option>
                                                    <option value="Metro cuadrado">Metro cuadrado</option>
                                                    <option value="OLX">OLX</option>
                                                    <option value="Instagram">Instagram</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <br />

                                    <div class="form-group{{ $errors->has('name2') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">DATOS DEL COMPRADOR 2:</label>
                                        @if($clienteExistenteRegistrado==0)                                        
                                            <label class="col-md-6 segundoComprador"><input type="checkbox" class = "segundoComprador" id="segundoComprador" name="segundoComprador" value="segundoComprador"> Ingresar segundo comprador</label>
                                        @else
                                            <label class="col-md-6 segundoComprador"><input type="checkbox" class = "segundoComprador" id="segundoComprador" name="segundoComprador" value="segundoComprador" checked> Ingresar segundo comprador</label>
                                        @endif
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
                                                        <option value="">Seleccionar</option>
                                                        <option value="name">name</option>
                                                        <option value="email">email</option>
                                                        <option value="documento">documento</option>
                                                        <option value="telefono">telefono</option>
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
                                        <div class="form-group{{ $errors->has('tipo_documento2') ? ' has-error' : '' }}">
                                            <label for="tipo_documento2" class="col-md-4 control-label">Tipo de Documento</label>
                                            <div class="col-md-6">
                                                <select id="tipo_documento2" name="tipo_documento2" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Cédula de ciudadania">Cédula de ciudadania</option>
                                                    <option value="Cédula de extrangería">Cédula de extrangería</option>
                                                    <option value="Pasaporte">Pasaporte</option>
                                                    <option value="Tarjeta de identidad">Tarjeta de identidad</option>
                                                </select>
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
                                                <input id="ciudad2" type="text" class="form-control" name="ciudad2" value="Bogotá" >
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
                                                <select id="estado_civil2" name="estado_civil2" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Casado con sociedad conyugal vigente">Casado con sociedad conyugal vigente</option>
                                                    <option value="Casado con sociedad conyugal disuelta y liquidada">Casado con sociedad conyugal disuelta y liquidada</option>
                                                    <option value="Soltero con unión marital de hecho por mas de dos años">Soltero con unión marital de hecho por mas de dos años</option>
                                                    <option value="Soltero sin unión marital de hecho">Soltero sin unión marital de hecho</option>
                                                    <option value="Soltero con unión marital de hecho por menos de dos años">Soltero con unión marital de hecho por menos de dos años</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_representacion2') ? ' has-error' : '' }}">
                                            <label for="tipo_representacion2" class="col-md-4 control-label">Tipo de Representación</label>
                                            <div class="col-md-6">
                                                <select id="tipo_representacion2" name="tipo_representacion2" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Propia">Propia</option>
                                                    <option value="Apoderado">Apoderado</option>
                                                </select>
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
                                            <label for="tipo_vinculacion2" class="col-md-4 control-label">Tiempo de Vinculación</label>
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
                                                <select id="tipo_contrato2" name="tipo_contrato2" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Indefinido">Indefinido</option>
                                                    <option value="Término fijo">Término fijo</option>
                                                    <option value="Prestación de servicios">Prestación de servicios electrónico</option>
                                                    <option value="Obra labor">Obra labor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('encuesta2') ? ' has-error' : '' }}">
                                            <label for="encuesta2" class="col-md-4 control-label">¿Cómo se enteró del Proyecto?</label>
                                            <div class="col-md-6">
                                                <select id="encuesta2" name="encuesta2" class="form-control">
                                                    <option value="">Seleccionar</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="Whatsapp">Whatsapp</option>
                                                    <option value="Correo electrónico">Correo electrónico</option>
                                                    <option value="Referido">Referido</option>
                                                    <option value="Zona">Zona</option>
                                                    <option value="Volante">Volante</option>
                                                    <option value="Metro cuadrado">Metro cuadrado</option>
                                                    <option value="OLX">OLX</option>
                                                    <option value="Instagram">Instagram</option>
                                                </select>
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
                                                <input id="valor" type="text" class="form-control" name="valor" value = "{{$valor}}" required>
                                            </div>
                                        </div>


                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="metodoPago" class="col-md-4 control-label">Metodo Pago</label>
                                            <div class="col-md-6">
                                                <select id="metodoPago" name="metodoPago" class="form-control">
                                                    <option value="efectivo">Crédito</option>
                                                    <option value="credito">Contado</option>
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
    <script src="{{asset('js/scriptsPersonalizados/completarVenta.js')}}"></script>    
@endsection
