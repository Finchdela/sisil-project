@extends('layouts.app')

@section('title', 'Kelola Laporan Kerusakan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-tools me-2"></i>Kelola Laporan Kerusakan</h4>
            </div>
            <div class="card-body">
                <!-- Statistics -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Laporan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
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
                                            Dilaporkan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['dilaporkan'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Diproses</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['diproses'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cogs fa-2x text-gray-300"></i>
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
                                            Selesai</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['selesai'] }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($laporan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Alat</th>
                                    <th>Pelapor</th>
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
                                        <td>{{ $item->user->name }}</td>
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
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Laporan Kerusakan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p><strong>Nama Alat:</strong> {{ $item->peralatan->nama_alat }}</p>
                                                            <p><strong>Kategori:</strong> {{ $item->peralatan->kategori }}</p>
                                                            <p><strong>Pelapor:</strong> {{ $item->user->name }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p><strong>Tanggal Lapor:</strong> {{ \Carbon\Carbon::parse($item->tanggal_lapor)->format('d M Y') }}</p>
                                                            <p><strong>Status:</strong> 
                                                                @if($item->status == 'dilaporkan')
                                                                    <span class="badge bg-warning">Dilaporkan</span>
                                                                @elseif($item->status == 'diproses')
                                                                    <span class="badge bg-info">Diproses</span>
                                                                @else
                                                                    <span class="badge bg-success">Selesai</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <p><strong>Deskripsi Kerusakan:</strong></p>
                                                            <div class="p-3 bg-light rounded">
                                                                {{ $item->deskripsi_kerusakan }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($item->tindakan)
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <p><strong>Tindakan:</strong></p>
                                                            <div class="p-3 bg-light rounded">
                                                                {{ $item->tindakan }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($item->keterangan)
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <p><strong>Keterangan:</strong></p>
                                                            <div class="p-3 bg-light rounded">
                                                                {{ $item->keterangan }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Update Status -->
                                    <div class="modal fade" id="updateModal{{ $item->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Status Laporan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.laporan-kerusakan.update-status', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="status{{ $item->id }}" class="form-label">Status</label>
                                                            <select class="form-select" id="status{{ $item->id }}" name="status" required>
                                                                <option value="dilaporkan" {{ $item->status == 'dilaporkan' ? 'selected' : '' }}>Dilaporkan</option>
                                                                <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tindakan{{ $item->id }}" class="form-label">Tindakan yang Dilakukan</label>
                                                            <textarea class="form-control" id="tindakan{{ $item->id }}" name="tindakan" rows="3" placeholder="Jelaskan tindakan yang dilakukan...">{{ $item->tindakan }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="keterangan{{ $item->id }}" class="form-label">Keterangan Tambahan</label>
                                                            <textarea class="form-control" id="keterangan{{ $item->id }}" name="keterangan" rows="2" placeholder="Keterangan tambahan...">{{ $item->keterangan }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update Status</button>
                                                    </div>
                                                </form>
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
                        <p class="text-muted">Belum ada laporan kerusakan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection