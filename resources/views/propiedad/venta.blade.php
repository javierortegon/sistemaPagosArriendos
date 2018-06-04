@extends('layouts.app')

@section('content')
		<div class="">
			<div class="col-md-10 col-md-offset-1">
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
                                <div class="col-md-4">
                                    <div id="datosPropiedad">
                                        <div class="panel-heading form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-10 control-label panel">DATOS DE LA PROPIEDAD</label>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-6 control-label">Codigo</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['codigo'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-6 control-label">Nombre</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['nombre'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-6 control-label">Direccion</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['direccion'] }}</label>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-6 control-label">Proyecto</label>
                                            <div class="col-md-6">
                                                <label>{{ $propieda['nombreProyec'] }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8"> 
                                    <form class="form-horizontal"  method="POST" action="{{  url('propiedad/vender').'/'.$propieda['id'] }}">
                                        {{ csrf_field() }}
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
                                                
                                                <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                                                    <label for="documento" class="col-md-4 control-label">Documento</label>
                                                    <div class="col-md-6">
                                                        <input id="documento" type="text" class="form-control" name="documento" value="{{ old('documento') }}" required>
                                                        @if ($errors->has('documento'))
                                                            <span class="help-block">
                                                                <strong>El documento ya está en uso</strong>
                                                            </span>
                                                        @endif
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

                                            </div>


                                            <div id = "divBusquedaUsuarioExistente" hidden>
                                                <input type="hidden" name= "inputUserId" value ="" id ="inputUserId">
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label class="col-md-4 control-label">Buscar usuario:</label>
                                                    <div class="col-md-6">
                                                        <select name="campo" id="campoParaBuscar">
                                                            <option value="name">name</option>
                                                            <option value="email">email</option>
                                                            <option value="documento">documento</option>
                                                            <option value="telefono">telefono</option>
                                                        </select> 
                                                        <input list="usuariosDataList" type = "search" name="busqueda" id="busqueda" autocomplete="off" autofocus>                                           
                                                        <datalist id="usuariosDataList">
                                                        </datalist>
                                                        <br />
                                                        <button type="button" class="btn btn-warning" id="btnSeleccionUsuario">Seleccionar Usuario</button>  
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="clienteExistenteNombre" class="col-md-4 control-label">Nombre</label>
                                                    <div class="col-md-6">
                                                        <input id="clienteExistenteNombre" type="text" class="form-control" style="border:none" name="nombreExistente" value="">  
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="clienteExistenteEmail" class="col-md-4 control-label">E-Mail</label>
                                                    <div class="col-md-6">
                                                        <input id="clienteExistenteEmail" type="text" class="form-control" style="border:none" name="emailExistente" value="">
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                                                    <label for="clienteExistenteDocumento" class="col-md-4 control-label">Documento</label>
                                                    <div class="col-md-6">                                                  
                                                        <input id="clienteExistenteDocumento" type="text" class="form-control" style="border:none" name="documentoExistente" value="">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                                    <label for="clienteExistenteTelefono" class="col-md-4 control-label">Teléfono</label>
                                                    <div class="col-md-6">                                                  
                                                        <input id="clienteExistenteTelefono" type="text" class="form-control" style="border:none" name="telefonoExistente" value="">                                                    
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                                    <label for="documento" class="col-md-4 control-label">Dirección</label>
                                                    <div class="col-md-6">                                                  
                                                        <input id="clienteExistenteDireccion" type="text" class="form-control" style="border:none" name="direccionExistente" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">DETALLES COMPRA</label>
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="valor" class="col-md-4 control-label">Valor</label>
                                            <div class="col-md-6">
                                                <input id="valor" type="text" class="form-control" name="valor" value="{{ $valor }}" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="metodoPago" class="col-md-4 control-label">Metodo Pago</label>
                                            <div class="col-md-6">
                                                <select id="metodoPago" name="metodoPago" class="form-control">
                                                    <option value="credito">Credito</option>
                                                    <option value="contado">Contado</option>
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
                                </div>   
                            @endif
                        @endforeach        
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
    <script src="{{asset('js/scriptsPersonalizados/ventas.js')}}"></script>
@endsection