@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Registro Venta</div>
					<div class="panel-body">
                            
                                <form class="form-horizontal"  method="POST" action="">
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
                                    <br />
                                    
                                    <div class="panel-body">
                                            <label class="col-md-4 control-label">Datos del inmueble</label>
                                            <button type="button" class="btn btn-success col-md-4" id="btnAddPropiedad">Añadir propiedad</button>                                   

					                
                                        <table class="table datatable" id="tablaPropiedades">
                                            <thead>
                                                <tr>
                                                    <th>Busqueda por inmueble</th>
                                                    <th></th>
                                                    <th>Venta seleccionada</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="propiedades">
                                            </tbody>
                                        </table>
                                    </div>


                                    <br />
                                    <br />
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
    <script src="{{asset('js/scriptsPersonalizados/ventaMultiple.js')}}"></script>
@endsection