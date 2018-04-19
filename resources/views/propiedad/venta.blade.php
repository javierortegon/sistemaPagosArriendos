@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Venta Propiedad</div>
					<div class="panel-body">
                        @foreach( $propiedad as $propieda )
                            @if ($propieda['estado'] == 0)

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">
                                        La propiedad esta desactivada por favor activela para generar la venta
                                    </label>
                                </div>

                            @else
                                <form class="form-horizontal"  method="POST" action="{{  url('propiedad/edit') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Datos de la Propiedad</label>
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

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Datos del Comprador</label>
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

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Detalles Compra</label>
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
                

                                </form>


                            @endif

                        @endforeach        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection