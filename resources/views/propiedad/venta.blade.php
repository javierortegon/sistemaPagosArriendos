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
                                <form class="form-horizontal"  method="POST" action="{{  url('propiedad/vender').'/'.$propieda['id'] }}">
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
                                            <label class="col-md-4 control-label">Nombre</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['nombre'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Direccion</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['direccion'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Proyecto</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['nombreProyec'] }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <br />
                                    <br />

                                    <div id="datosUsuario">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">DATOS DEL COMPRADOR</label>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="col-md-4">

                                            </div>
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
                                        </div>


                                        <div id = "divRegistroUsuarioNuevo">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label class="col-md-5 control-label">Registro de Usuario Nuevo:</label>
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

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="documento" class="col-md-4 control-label">Documento</label>

                                                    <div class="col-md-6">
                                                        <input id="documento" type="number" class="form-control" name="documento" required>
                                                    </div>
                                            </div>
                                        </div>

                                        <div id = "divBusquedaUsuarioExistente" hidden>
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Buscar usuario:</label>
                                                <div class="col-md-6">
                                                    <input type = "search" name="busqueda" id="busqueda">
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                                <div class="col-md-6">
                                                    <label id = "clienteExistenteNombre"></label>
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email" class="col-md-4 control-label">E-Mail</label>

                                                <div class="col-md-6">
                                                    <label id = "clienteExistenteEmail"></label>

                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="documento" class="col-md-4 control-label">Documento</label>

                                                    <div class="col-md-6">
                                                        <label id = "nombreClienteExistente"></label>                                                    
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <br />
                                    <br />
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">DETALLES COMPRA</label>
                                    </div>

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="valor" class="col-md-4 control-label">Valor Total</label>
                                        <div class="col-md-6">
                                            <input id="valor" type="number" class="form-control" name="valor" required>
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


                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Guardar Venta
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
@endsection

@section('scripts')
    <script src="{{asset('js/scriptsPersonalizados/ventas.js')}}"></script>
@endsection