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
                        Lista de Ventas
                        
                    </div>
					<div class="panel-body table-responsive">
                        <table class="table datatable" id="tablaAgenda">
                            <thead>
                                <tr>
                                    <th>Cita</th>
                                    <th>Fecha</th>
                                    <th>Inmueble</th>
                                    <th>Usuario</th>
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
        ajax: '{{ route('agenda/getdatatable') }}',
        columns: [
            {data: 'event_name', name: 'event_name'},
            {data: 'start_date', name: 'start_date'},
            {data: 'inmueble', name: 'inmueble'},
            {data: 'cliente', name: 'cliente'},
        ],
        pageLenght: 5,
    });
    
    
});
</script>
@endsection