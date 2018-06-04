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
                        Lista de Propiedades
                        
                    </div>
					<div class="panel-body table-responsive">
                        <table class="table datatable" id="tablaPropiedades">
                            <thead>
                                <tr>
                                    <th>Nombre (Subtipo)</th>
                                    <th>Proyecto</th>
                                    <th>Tipo (Torre)</th>
                                    <th>Piso</th>
                                    <th>Estado Venta</th>
                                    <th>Estado</th>
                                    <th>Inmueble</th>
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
        ajax: '{{ route('propiedades/getdatatable') }}',
        columns: [
            {data: 'nombre', name: 'nombre'},
            {data: 'nombreProyec', name: 'nombreProyec'},
            {data: 'tipoPropiedad', name: 'tipoPropiedad'},
            {data: 'numeroPiso', name: 'numeroPiso'},
            {data: 'estadoVenta', name: 'estadoVenta'},
            {data: 'estadoString', name: 'estadoString'},
            {data: 'codigo', name: 'codigo'},            
            {data: 'editar', name: 'editar', orderable: false, searchable: false},
        ],
        pageLenght: 5,
    });
    
    
});
</script>
@endsection