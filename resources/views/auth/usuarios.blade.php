@extends('layouts.app')

@section('styles')
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            {!!	Notification::showAll()	!!}

            <div class="panel panel-default">
					<div class="panel-heading">Lista de Usuarios</div>
					<div class="panel-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Mail</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                </div>
        </div>
        <div class="col-md-2"></div>
    </div>
    
@stop

@section('scripts')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('usuarios/getdatatable') }}',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'estadoString', name: 'estadoString'},
            {data: 'editar', name: 'editar', orderable: false, searchable: false},
        ]
    });
});
</script>
@endsection