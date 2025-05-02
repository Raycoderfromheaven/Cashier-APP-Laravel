<div>
    <div class="container-fluid px-4">
        <!-- Transaction Control Buttons -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex gap-2">
                    @if(!$transaksiAktif)
                    <button class="btn btn-primary rounded-pill" wire:click="transaksiBaru">
                        <i class="fas fa-receipt me-2"></i>Transaksi Baru
                    </button>
                    @else
                    <button class="btn btn-outline-danger rounded-pill" wire:click="batalTransaksi">
                        <i class="fas fa-times-circle me-2"></i>Batalkan Transaksi
                    </button>
                    @endif
                    <button class="btn btn-outline-info rounded-pill" wire:loading>
                        <i class="fas fa-spinner fa-spin me-2"></i>Loading...
                    </button>
                </div>
            </div>
        </div>

        @if($transaksiAktif)
        <div class="row mt-3">
            <!-- Product List Section -->
            <div class="col-lg-8 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">
                                <i class="fas fa-list-ol me-2"></i>No Invoice: {{ $transaksiAktif->kode }}
                            </h5>
                            <input type="text" class="form-control form-control-sm w-auto rounded-pill"
                                placeholder="No Invoice" wire:model.live='kode'>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end pe-4">Subtotal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semuaProduk as $produk)
                                    <tr>
                                        <td class="ps-4">{{ $loop->iteration }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $produk->produk->kode }}</span>
                                        </td>
                                        <td>{{ $produk->produk->nama }}</td>
                                        <td class="text-end">Rp{{ number_format($produk->produk->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">{{ $produk->jumlah }}</span>
                                        </td>
                                        <td class="text-end pe-4 fw-bold">
                                            Rp{{ number_format($produk->produk->harga * $produk->jumlah, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-danger rounded-pill"
                                                wire:click="hapusProduk({{ $produk->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="col-lg-4">
                <!-- Total Amount Card -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-money-bill-wave me-2"></i>Total Biaya</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Total:</span>
                            <span class="fs-5 fw-bold text-primary">
                                Rp{{ number_format($totalSemuaBelanja, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Payment Input Card -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-cash-register me-2"></i>Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <span class="input-group-text rounded-start-pill">Rp</span>
                            <input type="number" class="form-control rounded-end-pill"
                                placeholder="Jumlah Bayar" wire:model.live='bayar'>
                        </div>
                    </div>
                </div>

                <!-- Change Card -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="m-0"><i class="fas fa-exchange-alt me-2"></i>Kembalian</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Kembalian:</span>
                            <span class="fs-5 fw-bold {{ $kembalian >= 0 ? 'text-success' : 'text-danger' }}">
                                Rp{{ number_format(abs($kembalian), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                @if($bayar)
                @if ($kembalian < 0)
                    <div class="alert alert-danger rounded-pill" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Uang kurang Rp{{ number_format(abs($kembalian), 0, ',', '.') }}
            </div>
            @elseif ($kembalian >= 0)
            <button class="btn btn-success rounded-pill w-100 py-2" wire:click="transaksiSelesai">
                <i class="fas fa-check-circle me-2"></i>Bayar Sekarang
            </button>
            @endif
            @endif
        </div>
    </div>
    @endif
</div>
</div>