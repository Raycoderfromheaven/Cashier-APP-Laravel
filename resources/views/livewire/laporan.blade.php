<div>
    <div class="container-fluid px-4">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">
                                <i class="fas fa-file-invoice-dollar me-2"></i>Laporan Transaksi
                            </h5>
                            <a href="{{ url('cetak') }}" target="_blank" class="btn btn-primary btn-sm rounded-pill">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 shadow-sm" style="box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.05);">
                                <thead class="table-light" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);">
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Tanggal</th>
                                        <th>No Inv</th>
                                        <th class="text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($semuaTransaksi as $transaksi)
                                    <tr class="position-relative" style="transition: all 0.2s;">
                                        <td class="ps-4">{{ $loop->iteration }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($transaksi->created_at)) }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $transaksi->kode }}</span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <span class="fw-bold">Rp{{ number_format($transaksi->total, 0, ',', '.') }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>