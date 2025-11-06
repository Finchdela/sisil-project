<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Manajemen Ruangan</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Kelola data ruangan dan fasilitas yang tersedia.</p>
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-primary">
                    <i class="fas fa-building"></i> Kelola Ruangan
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Manajemen Peralatan</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Kelola data peralatan dan inventaris ruangan.</p>
                <a href="{{ route('admin.peralatan.index') }}" class="btn btn-success">
                    <i class="fas fa-tools"></i> Kelola Peralatan
                </a>
            </div>
        </div>
    </div>
</div>