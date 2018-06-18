@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registro Usuario Rol</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('registroUsuario') }}">
                        {{ csrf_field() }}

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

                        <div class="form-group">
                            <label for="direccion" class="col-md-4 control-label">Rol Cliente</label>

                            <div class="col-md-6">
                                <input type="checkbox" value="1" name="rolCliente"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="direccion" class="col-md-4 control-label">Rol Vendedor</label>

                            <div class="col-md-6">
                                <input type="checkbox" value="1" name="rolVendedor"></label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="direccion" class="col-md-4 control-label">Rol Administrador</label>

                            <div class="col-md-6">
                                <input type="checkbox" value="1" name="rolAdmin"></label>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
