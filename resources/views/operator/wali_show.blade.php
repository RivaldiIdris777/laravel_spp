@extends('layouts.app_sneat')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">                
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <td width="15%">ID</td>
                            <td>: {{ $model->id }}</td>
                        </tr>
                        <tr>
                            <td>NAMA</td>
                            <td>: {{ $model->name }}</td>
                        </tr>                        
                        <tr>
                            <td>Email</td>
                            <td>: {{ $model->email }}</td>
                        </tr>
                        <tr>
                            <td>Nomor HP</td>
                            <td>: {{ $model->nohp }}</td>
                        </tr>
                            <td>TGL UBAH</td>
                            <td>: {{ $model->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>                        
                    </thead>
                </table>
                <h4 class="my-3">TAMBAH DATA ANAK</h4>
                {!! Form::open(['route' => 'walisiswa.store', 'method' => 'POST']) !!}
                {!! Form::hidden('wali_id', $model->id, []) !!}
                <div class="form-group">
                    <label for="siswa_id" class="">Pilih Data Siswa</label>
                    {!! Form::select('siswa_id', $siswa, null, ['class' => 'form-control select2']) !!}
                    <span class="text-danger">{{ $errors->first('siswa_id') }}</span>
                </div>
                {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary my-2']) !!}
                {!! Form::close() !!}
                <h4 class="my-5">DATA ANAK</h4>
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nisn</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($model->siswa as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>
                                    {!! Form::open([
                                        'route' => ['walisiswa.update', $item->id],
                                        'method' => 'PUT',
                                        'onSubmit' => 'return confirm("Yakin ingin menghapus data ini ?")',

                                    ]) !!}
                                    <button type="submit" class="btn btn-danger btn-sm ml-2 mr-2"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
