@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editar Arrendatario</div>
                    <form method="POST" action="{{  url('propiedad/editArrendatario/').'/'.$idPropiedad  }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{-- TODO: Abrir el formulario e indicar el método POST --}}
                        {{ csrf_field() }}
                        {{-- TODO: Protección contra CSRF --}}
                        @foreach ( $arrendatarioData as $arrendatario )
                            <div class="form-group">
                                <label for="title">Fecha de Factura</label>
                                <input type="date" name="fecha_factura" id="codigo" class="form-control" value="{{ $arrendatario['fecha_factura'] }}">
                            </div>
                            <div class="form-group">
                                <label for="title">Valor arriendo</label>
                                <input type="number" name="valor_arriendo" id="codigo" class="form-control" value="{{ $arrendatario['valor_arriendo']     }}">
                            </div>
                        @endforeach
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection		