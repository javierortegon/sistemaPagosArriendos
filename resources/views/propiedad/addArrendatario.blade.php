@extends('layouts.app')

@section('content')
		<div class="col-md-2"></div>	
		<div class="col-md-8">
            <form action="{{ url('propietario/create') }}" method="POST">
				{{-- TODO: Abrir el formulario e indicar el método POST --}}
                    {{ csrf_field() }}
					{{-- TODO: Protección contra CSRF --}}

					<div class="col-md-6">
                        <select name="propiedad" id="propiedad" class="form-control">
                            @foreach( $propiedades as $propiedad )
                                <option value="{{$propiedad['id']}}">{{$propiedad['nombre']}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-6">
                        <select name="propietario" id="propietario" class="form-control">
                            @foreach( $users as $user )
                                <option value="{{$user['id']}}">{{$user['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="estado" value="0">
					

					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
							Añadir arrendatario
						</button>
					</div>

					{!!	Notification::showAll()	!!}
            </form>
		<div>
		<div class="col-md-2"></div>	
@endsection