@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <a href="{{ route( $routePrefix . '.create') }}" class="btn btn-primary btn-sm">Tambah Data</a>
                {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                <div class="input-group mt-2">
                    <input type="text" name="q" class="form-control" placeholder="Cari Data" aria-label="cari data" aria-describedby="button-addon2" value="{{ request('q') }}">
                    <button class="btn btn-outline-primary" type="button" id="button-addon2">
                        <i class="bx bx-search"></i>
                    </button>
                </div>
                {!! Form::close() !!}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Biaya</td>
                                <td>Jumlah</td>
                                <td>Created By</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->formatRupiah('jumlah') }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        {!! Form::open([
                                            'route' => [$routePrefix . '.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin ingin menghapus data ini ?")',
                                        ]) !!}
                                        <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-warning btn-sm ml-2 mr-2"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-info btn-sm ml-2 mr-2"><i class="fa fa-edit"></i> Detail</a>
                                        <button type="submit" class="btn btn-danger btn-sm ml-2 mr-2"><i class="fa fa-trash"></i> Hapus</button>
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
