@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route( $routePrefix . '.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-3 col-sm-12">
                                {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' =>
                                'form-control']) !!}
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" type="submit">Tampil</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NISN</td>
                                <td>Nama</td>
                                <td>Tanggal Tagihan</td>
                                <td>Total Tagihan</td>
                                <td>Status</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>                            
                            @forelse ($models as $item )
                            <tr>                                
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa->nisn }}</td>
                                <td>{{ $item->siswa->nama }}</td>
                                <td>{{ Carbon\Carbon::parse($item->tanggal_tagihan)->format('d-M-Y') }}</td>
                                <td>{{ $item->tagihanDetails->sum('jumlah_biaya') }}</td>
                                <td>{{ $item->status }}</td>                                
                                <td>
                                    {!! Form::open([
                                    'route' => [$routePrefix . '.destroy', $item->id],
                                    'method' => 'DELETE',
                                    'onsubmit' => 'return confirm("Yakin ingin menghapus data ini ?")',
                                    ]) !!}                                    
                                    <a href="{{ route($routePrefix . '.show', [
                                    $item->siswa_id, 
                                    'siswa_id' => $item->siswa_id, 
                                    'bulan' => Carbon\Carbon::parse($item->tanggal_tagihan)->format('m'), 
                                    'tahun' => Carbon\Carbon::parse($item->tanggal_tagihan)->format('Y'),
                                    ]) }}"
                                        class="btn btn-info btn-sm ml-2 mr-2"><i class="fa fa-edit"></i> Detail
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm ml-2 mr-2"><i
                                            class="fa fa-trash"></i> Hapus</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="">Data tidak ada</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $models->links(); !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
