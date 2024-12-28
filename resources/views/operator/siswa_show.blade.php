@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">                
                <img src="{{ \Storage::url($model->foto ?? 'images/no-image.png') }}">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <td width="15%">ID</td>
                            <td>: {{ $model->id }}</td>
                        </tr>
                        <tr>
                            <td>NAMA</td>
                            <td>: {{ $model->nama }}</td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>: {{ $model->nisn }}</td>
                        </tr>
                        <tr>
                            <td>PROGRAM STUDI</td>
                            <td>: {{ $model->program_studi }}</td>
                        </tr>
                        <tr>
                            <td>ANGKATAN</td>
                            <td>: {{ $model->angkatan }}</td>
                        </tr>
                        <tr>
                            <td>TGL BUAT</td>
                            <td>: {{ $model->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td>TGL UBAH</td>
                            <td>: {{ $model->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td>DIBUAT OLEH</td>
                            <td>: {{ $model->user->name }}</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
