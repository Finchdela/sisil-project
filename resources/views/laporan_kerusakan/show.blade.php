@extends('layouts.app')

@section('title', 'Detail Laporan Kerusakan')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-eye me-2"></i>Detail Laporan Kerusakan</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Nama Alat:</strong></p>
                        <p>{{ $laporan->peralatan->nama_alat }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Kategori Alat:</strong></p>
                        <p>{{ $laporan->peralatan->kategori }}</p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Tanggal Lapor:</strong></p>
                        <p>{{ \Carbon\Carbon::parse($laporan->tanggal_lapor)->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong></p>
                        <p>
                            @if($laporan->status == 'dilaporkan')
                                <span class="badge bg-warning">Dilaporkan</span>
                            @elseif($laporan->status == 'diproses')
                                <span class="badge bg-info">Diproses</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </p>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Deskripsi Kerusakan:</strong></p>
                        <div class="p-3 bg-light rounded">
                            {{ $laporan->deskripsi_kerusakan }}
                        </div>
                    </div>
                </div>

                @if($laporan->tindakan)
                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Tindakan yang Dilakukan:</strong></p>
                        <div class="p-3 bg-light rounded">
                            {{ $laporan->tindakan }}
                        </div>
                    </div>
                </div>
                @endif

                @if($laporan->keterangan)
                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Keterangan Tambahan:</strong></p>
                        <div class="p-3 bg-light rounded">
                            {{ $laporan->keterangan }}
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="row">
                    <div class="col-12">
                        <p><strong>Dilaporkan Oleh:</strong></p>
                        <p>{{ $laporan->user->name }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('laporan-kerusakan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 