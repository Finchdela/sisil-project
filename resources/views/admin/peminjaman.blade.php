@extends('layouts.app')

@section('title', 'Kelola Peminjaman')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-clipboard-list me-2"></i>Kelola Peminjaman</h4>
            </div>
            <div class="card-body">
                @if($peminjaman->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Peminjam</th>
                                    <th>Ruangan</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Tujuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->ruangan->nama_ruang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d M Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d M Y H:i') }}</td>
                                        <td>{{ Str::limit($item->tujuan_peminjaman, 50) }}</td>
                                        <td>
                                            @if($item->status == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($item->status == 'disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status == 'pending')
                                                <form action="{{ route('admin.peminjaman.approve', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                                </form>
                                                <form action="{{ route('admin.peminjaman.reject', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                </form>
                                            @else
                                                <span class="text-muted">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada peminjaman</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection