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
                        Cartera
                        
                    </div>
					<div class="panel-body table-responsive">
                        <table class="table datatable" id="tablaPropiedades">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Inmueble</th>
                                    <th>Cuotas pagadas</th>
                                    <th>Total pagado</th>
                                    <th>Total deuda</th>
                                    <th>Último Pago</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        ajax: '{{ route('carteras/getdatatable') }}',
        columns: [
            {data: 'cliente', name: 'cliente'},
            {data: 'inmueble', name: 'inmueble'},
            {data: 'cuotas_pagadas', name: 'cuotas_pagadas'},
            {data: 'total_pagado', name: 'total_pagado'},
            {data: 'total_deuda', name: 'total_deuda'},
            {data: 'fecha_pago', name: 'fecha_pago'},
            {data: 'estadoString', name: 'estadoString'},
            {data: 'acciones', name: 'acciones', orderable: false, searchable: false},
        ],
        pageLenght: 5,
    });
    
    
});
</script>
@endsection