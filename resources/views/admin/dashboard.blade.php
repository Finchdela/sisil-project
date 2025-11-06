@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <!-- Statistik -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Peminjaman</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_peminjaman'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Peminjaman Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['peminjaman_pending'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Ruangan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_ruangan'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-door-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Alat Rusak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['alat_rusak'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tools fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Peminjaman Terbaru -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Peminjaman Terbaru</h5>
            </div>
            <div class="card-body">
                @if($peminjaman_terbaru->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Ruangan</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman_terbaru as $peminjaman)
                                    <tr>
                                        <td>{{ $peminjaman->user->name }}</td>
                                        <td>{{ $peminjaman->ruangan->nama_ruang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($peminjaman->waktu_mulai)->format('d M Y H:i') }}</td>
                                        <td>
                                            @if($peminjaman->status == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif($peminjaman->status == 'disetujui')
                                                <span class="badge bg-success">Disetujui</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.peminjaman') }}" class="btn btn-sm btn-info">
                                                Kelola
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
                        <p class="text-muted">Belum ada peminjaman</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection