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
                        Lista de Pagos
                    </div>
					<div class="panel-body table-responsive">
                        <table class="table datatable" id="tablaPagos">
                            <thead>
                                <tr>
                                    <th>Cuota</th>
                                    <th>Fecha límite</th>
                                    <th>Fecha pago</th>
                                    <th>Valor factura</th>
                                    <th>Valor pagado</th>
                                    <th>Confirmar</th>
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