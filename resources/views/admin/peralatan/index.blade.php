@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Manajemen Peralatan</h4>
                    <a href="{{ route('admin.peralatan.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Peralatan
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Alat</th>
                                    <th>Nama Alat</th>
                                    <th>Ruangan</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peralatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_alat }}</td>
                                    <td>{{ $item->nama_alat }}</td>
                                    <td>{{ $item->ruangan->nama_ruangan }}</td>
                                    <td>{{ $item->merk }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($item->kondisi == 'baik') bg-success
                                            @elseif($item->kondisi == 'rusak_ringan') bg-warning
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $item->kondisi)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($item->status == 'tersedia') bg-success
                                            @elseif($item->status == 'dipinjam') bg-warning
                                            @else bg-danger
                                            @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.peralatan.edit', $item->id) }}" 
                                           class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.peralatan.destroy', $item->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Hapus peralatan?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection