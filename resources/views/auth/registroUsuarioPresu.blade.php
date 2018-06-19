@extends('layouts.app')

@section('content')
	<div class="">
		<div class="col-md-10 col-md-offset-1">
			{!!	Notification::showAll()	!!}
			<div class="panel panel-default">
				<div class="panel-heading">Registro Cliente Presupuesto</div>
				<div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('registroClientePresu') }}">
                    {{ csrf_field() }}
                        <div class="col-md-6">

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

                            <div class="form-group{{ $errors->has('tipo_documento') ? ' has-error' : '' }}">
                                <label for="tipo_documento" class="col-md-4 control-label">Tipo de Documento</label>
                                <div class="col-md-6">
                                    <select id="tipo_documento" name="tipo_documento" class="form-control" value="Pasaporte" required>
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
                                    <input id="documento" type="text" class="form-control" name="documento" value="{{ old('documento') }}" required>
                                
                                    @if ($errors->has('documento'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('documento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <label for="telefono" class="col-md-4 control-label">Telefono</label>

                                <div class="col-md-6">
                                    <input id="telefono" type="number" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telefono') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="direccion" class="col-md-4 control-label">Direccion</label>

                                <div class="col-md-6">
                                    <input id="direccion" type="text" class="form-control" name="direccion" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('barrio') ? ' has-error' : '' }}">
                                <label for="barrio" class="col-md-4 control-label">Barrio</label>
                                <div class="col-md-6">
                                    <input id="barrio" type="text" class="form-control" name="barrio" value="" required>
                                    
                                    <span class="help-block">
                                        <strong>{{ $errors->first('barrio') }}</strong>
                                    </span>
                                   
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('ciudad') ? ' has-error' : '' }}">
                                <label for="ciudad" class="col-md-4 control-label">Ciudad</label>
                                <div class="col-md-6">
                                    <input id="ciudad" type="text" class="form-control" name="ciudad" value="Bogotá" required>
                                    
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ciudad') }}</strong>
                                    </span>
                                    
                                </div>
                            </div>
                          

                        </div>
                        <div class="col-md-6"> 

                              <div class="form-group{{ $errors->has('estado_civil') ? ' has-error' : '' }}">
                                <label for="estado_civil" class="col-md-4 control-label">Estado Civil</label>
                                <div class="col-md-6">
                                    <select id="estado_civil" name="estado_civil" class="form-control" required>
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
                                <label for="tipo_representacion" class="col-md-4 control-label">Tipo de Representación </label>
                                <div class="col-md-6">
                                    <select id="tipo_representacion" name="tipo_representacion" class="form-control" required>
                                        <option value="Propia">Propia</option>
                                        <option value="Apoderado">Apoderado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('ocupacion') ? ' has-error' : '' }}">
                                <label for="ocupacion" class="col-md-4 control-label">Ocupación</label>
                                <div class="col-md-6">
                                    <input id="ocupacion" type="text" class="form-control" name="ocupacion" value="" required>
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
                                    <input id="cargo" type="text" class="form-control" name="cargo" value="" required>
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
                                    <input id="empresa" type="text" class="form-control" name="empresa" value="" required>
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
                                    <input id="tipo_vinculacion" type="text" class="form-control" name="tipo_vinculacion" value="" required>
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
                                    <select required id="tipo_contrato" name="tipo_contrato" class="form-control">
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
                                    <select required id="encuesta" name="encuesta" class="form-control">
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

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        Registrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>           
                </div>
            </div>
        </div>
    </div>
@endsection