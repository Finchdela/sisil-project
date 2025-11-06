@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Form Peminjaman Ruangan & Alat</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('peminjaman.store') }}" method="POST" id="peminjamanForm">
                    @csrf
                    
                    <!-- Informasi Waktu -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu_mulai" class="form-label fw-bold">Waktu Mulai</label>
                                <input type="datetime-local" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                                       id="waktu_mulai" name="waktu_mulai" 
                                       value="{{ old('waktu_mulai') }}" required>
                                @error('waktu_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu_selesai" class="form-label fw-bold">Waktu Selesai</label>
                                <input type="datetime-local" class="form-control @error('waktu_selesai') is-invalid @enderror" 
                                       id="waktu_selesai" name="waktu_selesai" 
                                       value="{{ old('waktu_selesai') }}" required>
                                @error('waktu_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pilih Ruangan -->
                    <div class="mb-4">
                        <label for="ruang_id" class="form-label fw-bold">Pilih Ruangan</label>
                        <select class="form-select @error('ruang_id') is-invalid @enderror" id="ruang_id" name="ruang_id" required>
                            <option value="">-- Pilih Ruangan --</option>
                            @foreach($ruangan as $ruang)
                                <option value="{{ $ruang->id }}" 
                                    {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}
                                    data-kapasitas="{{ $ruang->kapasitas }}"
                                    data-fasilitas="{{ $ruang->fasilitas }}">
                                    {{ $ruang->nama_ruang }} - Kapasitas: {{ $ruang->kapasitas }} orang
                                </option>
                            @endforeach
                        </select>
                        @error('ruang_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Info Ruangan -->
                        <div id="ruanganInfo" class="mt-2 p-3 bg-light rounded" style="display: none;">
                            <small>
                                <strong>Detail Ruangan:</strong>
                                <span id="infoKapasitas"></span> | 
                                <span id="infoFasilitas"></span>
                            </small>
                        </div>
                    </div>

                    <!-- Tujuan Peminjaman -->
                    <div class="mb-4">
                        <label for="tujuan_peminjaman" class="form-label fw-bold">Tujuan Peminjaman</label>
                        <textarea class="form-control @error('tujuan_peminjaman') is-invalid @enderror" 
                                  id="tujuan_peminjaman" name="tujuan_peminjaman" 
                                  rows="3" placeholder="Jelaskan tujuan peminjaman ruangan dan alat..." required>{{ old('tujuan_peminjaman') }}</textarea>
                        @error('tujuan_peminjaman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih Peralatan -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Peralatan yang Dipinjam</label>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Pilih peralatan yang diperlukan (opsional)
                        </div>
                        
                        @if($peralatan->count() > 0)
                            <!-- Filter Kategori -->
                            <!-- Di bagian filter kategori, update menjadi: -->
                            <div class="mb-3">
                                <label class="form-label">Filter berdasarkan kategori:</label>
                                <select id="filterKategori" class="form-select form-select-sm w-auto d-inline-block">
                                    <option value="">Semua Kategori</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Alat Ukur">Alat Ukur</option>
                                    <option value="Praktikum">Praktikum</option>
                                    <option value="Jaringan">Jaringan</option>
                                    <option value="Multimedia">Multimedia</option>
                                    <option value="Robotika">Robotika</option>
                                </select>
                            </div>
                            
                            <div class="row" id="peralatanList">
                                @foreach($peralatan as $alat)
                                    <div class="col-md-4 mb-3 alat-item" data-kategori="{{ $alat->kategori }}">
                                        <div class="card h-100 border">
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <input class="form-check-input alat-checkbox" 
                                                           type="checkbox" 
                                                           name="alat_id[]" 
                                                           value="{{ $alat->id }}"
                                                           id="alat_{{ $alat->id }}"
                                                           data-stok="{{ $alat->jumlah_tersedia }}"
                                                           data-kategori="{{ $alat->kategori }}">
                                                    <label class="form-check-label fw-bold" for="alat_{{ $alat->id }}">
                                                        {{ $alat->nama_alat }}
                                                    </label>
                                                </div>
                                                <div class="mt-2">
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-tag me-1"></i>{{ $alat->kategori }}
                                                    </small>
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-boxes me-1"></i>Tersedia: 
                                                        <span class="{{ $alat->jumlah_tersedia == 0 ? 'text-danger' : 'text-success' }}">
                                                            {{ $alat->jumlah_tersedia }}
                                                        </span>
                                                    </small>
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-check-circle me-1"></i>Kondisi: 
                                                        <span class="badge bg-{{ $alat->kondisi == 'baik' ? 'success' : 'danger' }} badge-sm">
                                                            {{ ucfirst($alat->kondisi) }}
                                                        </span>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>Tidak ada peralatan yang tersedia untuk dipinjam.
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum datetime to current time
    const now = new Date();
    const timezoneOffset = now.getTimezoneOffset() * 60000;
    const localISOTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);
    
    document.getElementById('waktu_mulai').min = localISOTime;
    document.getElementById('waktu_selesai').min = localISOTime;

    // Real-time validation for end time
    document.getElementById('waktu_mulai').addEventListener('change', function() {
        const startTime = this.value;
        document.getElementById('waktu_selesai').min = startTime;
    });

    // Alert if trying to select unavailable equipment
    const checkboxes = document.querySelectorAll('.alat-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked && parseInt(this.dataset.stok) <= 0) {
                alert('Peralatan ini sedang tidak tersedia!');
                this.checked = false;
            }
        });
    });

    // Show ruangan info when selected
    document.getElementById('ruang_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const infoDiv = document.getElementById('ruanganInfo');
        
        if (selectedOption.value) {
            document.getElementById('infoKapasitas').textContent = 'Kapasitas: ' + selectedOption.dataset.kapasitas + ' orang';
            document.getElementById('infoFasilitas').textContent = 'Fasilitas: ' + selectedOption.dataset.fasilitas;
            infoDiv.style.display = 'block';
        } else {
            infoDiv.style.display = 'none';
        }
    });

    // Filter peralatan by kategori
    document.getElementById('filterKategori').addEventListener('change', function() {
        const selectedKategori = this.value;
        const alatItems = document.querySelectorAll('.alat-item');
        
        alatItems.forEach(item => {
            if (selectedKategori === '' || item.dataset.kategori === selectedKategori) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>
@endpush