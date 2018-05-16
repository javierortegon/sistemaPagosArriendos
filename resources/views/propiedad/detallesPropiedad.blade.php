@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">Propiedad</div>

					<div class="panel-body">
                        <div class="col-md-4"><b>Id:</b></div>
                        <div class="col-md-6">{{ $propiedad['id'] }}</div>
                        <div class="col-md-4"><b>Codigo:</b></div>
                        <div class="col-md-6">{{ $propiedad['codigo'] }}</div>
                        <div class="col-md-4"><b>Nombre:</b></div>
                        <div class="col-md-6">{{ $propiedad['nombre'] }}</div>
                        <div class="col-md-4"><b>Direccion:</b></div>
                        <div class="col-md-6">{{ $propiedad['direccion'] }}</div>

                        <div class="col-md-4"><b>Numero de Piso:</b></div>
                        <div class="col-md-6">{{ $propiedad['numero_piso'] }}</div>
                        <div class="col-md-4"><b>Área Arquitectónica Aprox (M2):</b></div>
                        <div class="col-md-6">{{ $propiedad['area_aproximada'] }}</div>
                        <div class="col-md-4"><b>Área Privada Aprox (M2):</b></div>
                        <div class="col-md-6">{{ $propiedad['area_privada_aprox'] }}</div>

                        <div class="col-md-4"><b>Proyecto:</b></div>
                        <div class="col-md-6">{{ $propiedad['nombreProyec'] }}</div>
                    </div>
                    
                    <div class="panel-heading">Datos del comprador</div>
                    <div class="panel-body">
                    @if ($propiedad['ventaEstado'] != 1)
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                            <h5>La propiedad aún no ha sido vendida</h5>
                            </div>
                        </div>
                    @else
                        <div class="col-md-4"><b>Nombre:</b></div>
                        <div class="col-md-6">{{ $propiedad['nombreComprador'] }}</div>
                        <div class="col-md-4"><b>Direccion:</b></div>
                        <div class="col-md-6">{{ $propiedad['correoComprador'] }}</div>
                        
                    @endif
                    </div>
				</div>
			</div>
		</div>			
	</div>	
@endsection