@extends('layouts.app')

@section('title', 'Daftar Peminjaman Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Peminjaman Saya</h4>
                <a href="{{ route('peminjaman.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i>Ajukan Baru
                </a>
            </div>
            <div class="card-body">
                @if($peminjaman->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ruangan</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->ruangan->nama_ruang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') }}</td>
                                        <td>
                                            @if($item->status == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($item->status == 'disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif($item->status == 'ditolak')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-secondary">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Peminjaman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Ruangan:</strong> {{ $item->ruangan->nama_ruang }}</p>
                                                    <p><strong>Waktu:</strong> 
                                                        {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') }}
                                                    </p>
                                                    <p><strong>Tujuan:</strong> {{ $item->tujuan_peminjaman }}</p>
                                                    <p><strong>Status:</strong> 
                                                        @if($item->status == 'pending')
                                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                                        @elseif($item->status == 'disetujui')
                                                            <span class="badge bg-success">Disetujui</span>
                                                        @elseif($item->status == 'ditolak')
                                                            <span class="badge bg-danger">Ditolak</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5>Belum ada peminjaman</h5>
                        <p class="text-muted">Anda belum mengajukan peminjaman apapun.</p>
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Ajukan Peminjaman Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection