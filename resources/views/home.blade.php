@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>{{ $peminjaman_terbaru->count() }}</h4>
                                        <p>Total Peminjaman</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-clipboard-list fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>{{ $peminjaman_terbaru->where('status', 'disetujui')->count() }}</h4>
                                        <p>Disetujui</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h4>{{ $peminjaman_terbaru->where('status', 'pending')->count() }}</h4>
                                        <p>Menunggu</p>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-clock fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4">Peminjaman Terbaru</h5>
                @if($peminjaman_terbaru->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Ruangan</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjaman_terbaru as $peminjaman)
                                    <tr>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada peminjaman</p>
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