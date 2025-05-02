<div>
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row my-3">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                    <button wire:click="pilihMenu('lihat')"
                        class="btn {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                        <i class="fas fa-boxes me-1"></i> Semua Produk
                    </button>
                    <button wire:click="pilihMenu('tambah')"
                        class="btn {{ $pilihanMenu=='tambah' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                        <i class="fas fa-plus-circle me-1"></i> Tambah Produk
                    </button>
                    <button wire:click="pilihMenu('excel')"
                        class="btn {{ $pilihanMenu=='excel' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                        <i class="fas fa-file-import me-1"></i> Impor Produk
                    </button>
                    <button wire:loading class="btn btn-info rounded-pill">
                        <i class="fas fa-spinner fa-spin me-1"></i> Loading...
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="row">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                <!-- Product List Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-boxes me-2"></i>Semua Produk</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 shadow-sm" style="box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.05);">
                                <thead class="table-light" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);">
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th class="text-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                    <tr class="position-relative" style="transition: all 0.2s;">
                                        <td class="ps-4">{{ $loop->iteration }}</td>
                                        <td><span class="badge bg-secondary">{{ $produk->kode }}</span></td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $produk->stok > 0 ? 'success' : 'danger' }}">
                                                {{ $produk->stok }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <div class="d-flex justify-content-end gap-2">
                                                <button wire:click="pilihEdit({{ $produk->id }})"
                                                    class="btn btn-sm {{ $pilihanMenu=='edit' ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </button>
                                                <button wire:click="pilihHapus({{ $produk->id }})"
                                                    class="btn btn-sm {{ $pilihanMenu=='hapus' ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill">
                                                    <i class="fas fa-trash me-1"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @elseif($pilihanMenu == 'tambah')
                <!-- Add Product Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-plus-circle me-2"></i>Tambah Produk</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="simpan" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control rounded-pill" wire:model="nama" required>
                                @error('nama')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kode/Barcode</label>
                                <input type="text" class="form-control rounded-pill" wire:model="kode" required>
                                @error('kode')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-pill">Rp</span>
                                    <input type="number" class="form-control rounded-end-pill" wire:model="harga" required>
                                </div>
                                @error('harga')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control rounded-pill" wire:model="stok" required>
                                @error('stok')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @elseif($pilihanMenu == 'edit')
                <!-- Edit Product Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-edit me-2"></i>Edit Produk</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="simpanEdit" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" class="form-control rounded-pill" wire:model="nama" required>
                                @error('nama')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kode/Barcode</label>
                                <input type="text" class="form-control rounded-pill" wire:model="kode" required>
                                @error('kode')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text rounded-start-pill">Rp</span>
                                    <input type="number" class="form-control rounded-end-pill" wire:model="harga" required>
                                </div>
                                @error('harga')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control rounded-pill" wire:model="stok" required>
                                @error('stok')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" wire:click="batal" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fas fa-times me-1"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @elseif($pilihanMenu == 'hapus')
                <!-- Delete Confirmation Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-danger text-white py-3">
                        <h5 class="m-0"><i class="fas fa-exclamation-triangle me-2"></i>Hapus Produk</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning mb-4">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            Anda yakin ingin menghapus produk ini secara permanen?
                        </div>

                        <div class="mb-4">
                            <p><strong>Nama:</strong> {{ $produkTerpilih->nama }}</p>
                            <p><strong>Kode:</strong> {{ $produkTerpilih->kode }}</p>
                            <p><strong>Harga:</strong> Rp {{ number_format($produkTerpilih->harga, 0, ',', '.') }}</p>
                            <p>
                                <strong>Stok:</strong>
                                <span class="badge bg-{{ $produkTerpilih->stok > 0 ? 'success' : 'danger' }}">
                                    {{ $produkTerpilih->stok }}
                                </span>
                            </p>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-outline-secondary rounded-pill px-4" wire:click='batal'>
                                <i class="fas fa-times me-1"></i> Batal
                            </button>
                            <button class="btn btn-danger rounded-pill px-4" wire:click='hapus'>
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>

                @elseif($pilihanMenu == 'excel')
                <!-- Excel Import Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="m-0"><i class="fas fa-file-import me-2"></i>Impor Produk</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit="imporExcel" class="needs-validation" novalidate>
                            <div class="mb-4">
                                <label class="form-label">File Excel</label>
                                <input type="file" class="form-control rounded-pill" wire:model="fileExcel" required>
                                @error('fileExcel')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                <small class="text-muted">Format file harus .xlsx atau .csv</small>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" wire:click="batal" class="btn btn-outline-secondary rounded-pill px-4">
                                    <i class="fas fa-times me-1"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-upload me-1"></i> Kirim
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>