@extends('layouts.app')

@section('title', 'Laporan Kerusakan Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Laporan Kerusakan Saya</h4>
                <a href="{{ route('laporan-kerusakan.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i>Lapor Kerusakan
                </a>
            </div>
            <div class="card-body">
                @if($laporan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Alat</th>
                                    <th>Deskripsi Kerusakan</th>
                                    <th>Tanggal Lapor</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->peralatan->nama_alat }}</td>
                                        <td>{{ Str::limit($item->deskripsi_kerusakan, 50) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_lapor)->format('d M Y') }}</td>
                                        <td>
                                            @if($item->status == 'dilaporkan')
                                                <span class="badge bg-warning">Dilaporkan</span>
                                            @elseif($item->status == 'diproses')
                                                <span class="badge bg-info">Diproses</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('laporan-kerusakan.show', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada laporan kerusakan</p>
                        <a href="{{ route('laporan-kerusakan.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Buat Laporan Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection