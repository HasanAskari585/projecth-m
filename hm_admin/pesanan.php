<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$data = mysqli_query(
    $conn,
    "SELECT * FROM transaksi ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - H&M Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Navbar Styling (Konsisten dengan halaman lain) */
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }
        .brand-logo {
            background-color: #E50010;
            color: white;
            padding: 5px 12px;
            font-weight: 900;
            letter-spacing: 1px;
            border-radius: 4px;
        }
        .brand-text {
            color: #333;
            font-weight: 700;
            margin-left: 10px;
            letter-spacing: 1px;
        }

        /* Tabel & Badge Custom */
        .table-custom th {
            background-color: #f8f9fa;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
        }
        .badge {
            padding: 0.5em 0.75em;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        /* Mengatur ukuran font dropdown agar lebih pas */
        .dropdown-item {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top shadow-sm py-3 mb-4">
    <div class="container">
        <div class="d-flex align-items-center">
            <span class="brand-logo">H&M</span>
            <span class="brand-text">ADMIN PANEL</span>
        </div>
        <div>
            <a href="dashboard.php" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-bold">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</nav>

<div class="container mb-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Kelola Pesanan</h3>
            <p class="text-muted mb-0">Pantau dan perbarui status pengiriman pelanggan.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">ID TRX</th>
                        <th width="25%">Nomor Resi</th>
                        <th width="25%">Total Belanja</th>
                        <th class="text-center" width="20%">Status Saat Ini</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($data) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($data)){ ?>
                            <tr>
                                <td class="text-center text-muted fw-bold">#<?= $row['id']; ?></td>
                                
                                <td>
                                    <span class="fw-bold text-dark">
                                        <i class="bi bi-box-seam me-1 text-muted"></i> 
                                        <?= !empty($row['no_resi']) ? $row['no_resi'] : '<span class="text-danger fst-italic">Resi Belum Dibuat</span>' ?>
                                    </span>
                                </td>
                                
                                <td class="text-danger fw-bold">
                                    Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?>
                                </td>
                                
                                <td class="text-center">
                                    <?php
                                    $status = $row['status'];
                                    if($status == "Pending"){
                                        echo "<span class='badge bg-warning text-dark border border-warning rounded-pill'><i class='bi bi-hourglass-split me-1'></i> Pending</span>";
                                    }
                                    elseif($status == "Diproses"){
                                        echo "<span class='badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill'><i class='bi bi-gear me-1'></i> Diproses</span>";
                                    }
                                    elseif($status == "Dikirim"){
                                        echo "<span class='badge bg-info bg-opacity-10 text-info border border-info rounded-pill'><i class='bi bi-truck me-1'></i> Dikirim</span>";
                                    }
                                    else{
                                        echo "<span class='badge bg-success bg-opacity-10 text-success border border-success rounded-pill'><i class='bi bi-check-circle me-1'></i> Selesai</span>";
                                    }
                                    ?>
                                </td>
                                
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-dark btn-sm dropdown-toggle rounded-3 px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-arrow-repeat"></i> Ubah Status
                                        </button>
                                        <ul class="dropdown-menu shadow border-0 mt-2 rounded-3">
                                            <li><h6 class="dropdown-header">Pilih Status:</h6></li>
                                            
                                            <li>
                                                <a class="dropdown-item fw-bold text-warning" href="update_status.php?id=<?= $row['id']; ?>&status=Pending">
                                                    <i class="bi bi-hourglass-split me-2"></i> Pending
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fw-bold text-primary" href="update_status.php?id=<?= $row['id']; ?>&status=Diproses">
                                                    <i class="bi bi-gear me-2"></i> Diproses
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item fw-bold text-info" href="update_status.php?id=<?= $row['id']; ?>&status=Dikirim">
                                                    <i class="bi bi-truck me-2"></i> Dikirim
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item fw-bold text-success" href="update_status.php?id=<?= $row['id']; ?>&status=Selesai">
                                                    <i class="bi bi-check-circle me-2"></i> Selesai
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-receipt text-muted" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 text-muted">Belum ada pesanan</h5>
                                <p class="text-muted">Pesanan dari pelanggan akan otomatis muncul di sini.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>