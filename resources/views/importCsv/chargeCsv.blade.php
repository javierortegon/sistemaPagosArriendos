@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Importar {{$origen}} desde archivo CSV</div>

                <div class="panel-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ URL::to('chooseColumnsCsv') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type = "hidden" name ="origen" value = {{$origen}}></input>
                        <input type="file" name="import_file" />
                        <br />
                        <button class="btn btn-primary">Importar CSV</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection