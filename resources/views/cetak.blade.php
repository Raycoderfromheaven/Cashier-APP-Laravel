<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            body {
                padding: 20px;
                font-size: 12px;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
            }

            .table {
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-header {
            background-color: #1e40af;
            color: white;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .badge {
            font-size: 0.85em;
            padding: 0.35em 0.65em;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container-fluid px-4">
        <div class="row mt-3">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">
                                <i class="fas fa-file-invoice-dollar me-2"></i>Laporan Transaksi
                            </h5>
                            <button onclick="window.print()" class="btn btn-light btn-sm no-print">
                                <i class="fas fa-print me-1"></i> Cetak
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">No</th>
                                        <th>Tanggal</th>
                                        <th>No Inv</th>
                                        <th class="text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($semuaTransaksi as $transaksi): ?>
                                        <tr>
                                            <td class="ps-4"><?= $loop->iteration ?? '' ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($transaksi->created_at)) ?></td>
                                            <td>
                                                <span class="badge bg-primary"><?= $transaksi->kode ?></span>
                                            </td>
                                            <td class="text-end pe-4 fw-bold">
                                                Rp<?= number_format($transaksi->total, 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <?php if (!empty($semuaTransaksi) && count($semuaTransaksi) > 0): ?>
                                    <tfoot>
                                        <tr class="table-active">
                                            <td colspan="3" class="text-end fw-bold ps-4">Total</td>
                                            <td class="text-end pe-4 fw-bold">
                                                Rp<?= number_format(array_sum(array_column($semuaTransaksi->toArray(), 'total')), 0, ',', '.') ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white text-muted no-print">
                        <small>Dicetak pada: <?= date('d/m/Y H:i') ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Close window after print if not already closed
        window.onafterprint = function() {
            setTimeout(function() {
                window.close();
            }, 500);
        };
    </script>
</body>

</html>