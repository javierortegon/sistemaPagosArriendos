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
					<div class="panel-heading">Lista de Proyectos</div>
					<div class="panel-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
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
        ajax: '{{ route('proyectos/getdatatable') }}',
        columns: [
            {data: 'nombre', name: 'nombre'},
            {data: 'direccion', name: 'direccion'},
            {data: 'editar', name: 'editar', orderable: false, searchable: false},
        ]
    });
});
</script>
@endsection