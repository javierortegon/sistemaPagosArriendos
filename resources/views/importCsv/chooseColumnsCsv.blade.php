@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            {!!	Notification::showAll()	!!}
            <div class="panel panel-default">
				<div class="panel-heading">
                    Seleccionar columnas del archivo CSV
                </div>
				<div class="panel-body">

                    <form class="form-horizontal" method="POST" action="{{ URL::to('importCsvUsers') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type = "hidden" name ="file" value = "{{$file}}"></input>
                        <input type = "hidden" name ="origen" value = "{{$origen}}"></input>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Campo</th>
                                    <th>Columna del CSV</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($columnsTable as $columnTable)
                                    <tr>
                                        <th>{{$columnTable}}</th>
                                        <td>
                                            <select name="{{$columnTable}}" size="1">
                                                @foreach($columns as $i => $column)
                                                    <option value="{{$i}}">{{$column}}</option>
                                                @endforeach
                                            </select> 
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        <br />
                        <br />
                        <button class="btn btn-primary">Importar CSV</button>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-md-2"></div>
    </div>
    
@stop