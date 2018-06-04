@extends('layouts.app')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
	<div class="">
		<div class="">
			<div class="col-md-10 col-md-offset-1">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">
                        Lista de Ventas
                        
                    </div>
					<div class="panel-body table-responsive">
                        <table class="table datatable" id="tablaPropiedades">
                            <thead>
                                <tr>
                                    <th>Usuario comprador</th>
                                    <th>Teléfono comprador</th>
                                    <th>Inmueble</th>
                                    <th>Direccion</th>
                                    <th>Proyecto</th>
                                    <th>Tipo de propiedad</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="form-horizontal" action="{{ url('propiedad/ACTION/ID') }}" method="GET" id ="formPropiedades">
        {{ csrf_field() }}
        {{ method_field('GET') }}
    </form>
@endsection         

@section('scripts')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    
    $('.datatable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route('ventas/getdatatable') }}',
        columns: [
            {data: 'comprador', name: 'comprador'},
            {data: 'telefono', name: 'telefono'},
            {data: 'codigo', name: 'codigo'},
            {data: 'direccion', name: 'direccion'},
            {data: 'nombreProyec', name: 'nombreProyec'},
            {data: 'tipoPropiedad', name: 'tipoPropiedad'},
            {data: 'editar', name: 'editar', orderable: false, searchable: false},
        ],
        pageLenght: 5,
    });
    
    
});
</script>
@endsection