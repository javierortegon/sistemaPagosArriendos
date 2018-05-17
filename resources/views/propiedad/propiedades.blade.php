@extends('layouts.app')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{!!	Notification::showAll()	!!}
				<div class="panel panel-default">
					<div class="panel-heading">
                        Lista de Propiedades
                        
                    </div>
					<div class="panel-body table-responsive">
                        <table class="table datatable" id="tablaPropiedades">
                            <thead>
                                <tr>
                                    <th>Inmueble</th>
                                    <th>Nombre (Subtipo)</th>
                                    <th>Direccion</th>
                                    <th>Proyecto</th>
                                    <th>Tipo (Torre)</th>
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
        processing: true,
        serverSide: true,
        ajax: '{{ route('propiedades/getdatatable') }}',
        columns: [
            {data: 'codigo', name: 'codigo'},
            {data: 'nombre', name: 'nombre'},
            {data: 'direccion', name: 'direccion'},
            {data: 'nombreProyec', name: 'nombreProyec'},
            {data: 'tipoPropiedad', name: 'tipoPropiedad'},
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