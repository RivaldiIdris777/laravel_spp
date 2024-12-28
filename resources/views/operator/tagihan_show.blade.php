@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">DATA TAGIHAN SPP SISWA {{ $periode }}</div>
            <div class="card-body">                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <td rowspan="8" width="100">
                                <img src="{{ \Storage::url($siswa->foto ?? 'images/no-image.png') }}" alt="{{ $siswa->nama }}" width="150">
                            </td>
                        </tr>
                        <tr>
                            <td>NISN</td>                            
                            <td>: {{ $siswa->nisn }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>                            
                            <td>: {{ $siswa->nama }}</td>
                        </tr>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">DATA TAGIHAN</div>
                <div class="card-body">                    
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tagihan</th>
                                <th>Jumlah Tagihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihan->tagihanDetails as $item )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_biaya }}</td>
                                    <td>{{ $item->jumlah_biaya }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h5 class="card-header">DATA PEMBAYARAN</h5>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">KARTU SPP</div>
                <div class="card-body">
                   Kartu SPP 
                </div>
            </div>
        </div>
    </div>        
</div>

@endsection
