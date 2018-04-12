@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            {!!	Notification::showAll()	!!}
            <form class="form-horizontal" method="POST" action="{{ URL::to('importCsvUsers') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input type = "hidden" name ="file" value = "{{$file}}"></input>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Columna del CSV</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th>Nombre:</th>
                            <td>
                                <select name="name" size="1">
                                    @foreach($columns as $i => $column)
                                        <option value="{{$i}}">{{$column}}</option>
                                    @endforeach
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>
                                <select name="email" size="1">
                                    @foreach($columns as $i => $column)
                                        <option value="{{$i}}">{{$column}}</option>
                                    @endforeach
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <th>Password:</th>
                            <td>
                                <select name="password" size="1">
                                    @foreach($columns as $i => $column)
                                        <option value="{{$i}}">{{$column}}</option>
                                    @endforeach
                                </select> 
                            </td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td>
                                <select name="state" size="1">
                                    @foreach($columns as $i => $column)
                                        <option value="{{$i}}">{{$column}}</option>
                                    @endforeach
                                </select> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <br />
                <button class="btn btn-primary">Importar CSV</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    
@stop