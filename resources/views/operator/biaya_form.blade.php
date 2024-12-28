@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h3 class="font-weight-bold">{{ $title }}</h3></div>

            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true, ]) !!}                
                <div class="form-group mt-3">
                    <label for="nama">Nama Biaya</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                </div>
                <div class="form-group mt-3">
                    <label for="jumlah">Jumlah / Nominal</label>
                    {!! Form::text('jumlah', null, ['class' => 'form-control rupiah', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                </div>                
                
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
