@extends('layouts.app')

@section('title', 'Lapor Kerusakan Alat')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Form Laporan Kerusakan Alat</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('laporan-kerusakan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="alat_id" class="form-label fw-bold">Pilih Alat yang Rusak</label>
                        <select class="form-select @error('alat_id') is-invalid @enderror" id="alat_id" name="alat_id" required>
                            <option value="">-- Pilih Alat --</option>
                            @foreach($peralatan as $alat)
                                <option value="{{ $alat->id }}" {{ old('alat_id') == $alat->id ? 'selected' : '' }}>
                                    {{ $alat->nama_alat }} - {{ $alat->kategori }}
                                    (Tersedia: {{ $alat->jumlah_tersedia }})
                                </option>
                            @endforeach
                        </select>
                        @error('alat_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lapor" class="form-label fw-bold">Tanggal Lapor</label>
                        <input type="date" class="form-control @error('tanggal_lapor') is-invalid @enderror" 
                               id="tanggal_lapor" name="tanggal_lapor" value="{{ old('tanggal_lapor', date('Y-m-d')) }}" required>
                        @error('tanggal_lapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_kerusakan" class="form-label fw-bold">Deskripsi Kerusakan</label>
                        <textarea class="form-control @error('deskripsi_kerusakan') is-invalid @enderror" 
                                  id="deskripsi_kerusakan" name="deskripsi_kerusakan" 
                                  rows="5" placeholder="Jelaskan secara detail kerusakan yang terjadi, kapan pertama kali ditemukan, dan gejala yang muncul..." required>{{ old('deskripsi_kerusakan') }}</textarea>
                        @error('deskripsi_kerusakan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Jelaskan dengan detail untuk membantu tim teknisi memahami masalahnya.
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('laporan-kerusakan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection