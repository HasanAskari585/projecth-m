<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$produk = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM produk")
);

$user = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM users")
);

$pesanan = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM transaksi")
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H&M Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Navbar Styling */
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
            text-decoration: none;
            border-radius: 4px;
        }
        .brand-text {
            color: #333;
            font-weight: 700;
            margin-left: 10px;
            letter-spacing: 1px;
        }

        /* Card Hover Effect */
        .card-hover {
            transition: all 0.3s ease;
            border-radius: 16px;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        }

        /* Icon Circle Layout */
        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        /* Custom Button */
        .btn-hm {
            background-color: #1a1a1a;
            color: white;
            transition: 0.3s;
        }
        .btn-hm:hover {
            background-color: #E50010;
            color: white;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top shadow-sm py-3">
    <div class="container">
        <div class="d-flex align-items-center">
            <span class="brand-logo">H&M</span>
            <span class="brand-text">ADMIN PANEL</span>
        </div>

        <div class="d-flex align-items-center">
            <div class="me-4 text-secondary d-none d-md-block">
                <i class="bi bi-person-circle me-2"></i>
                Halo, <span class="text-dark fw-bold"><?php echo $_SESSION['admin']; ?></span>
            </div>
            <a href="logout.php" class="btn btn-outline-danger btn-sm px-4 rounded-pill fw-bold">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-bold mb-1">Dashboard</h2>
            <p class="text-muted mb-0">Ringkasan data dan manajemen sistem H&M Store.</p>
        </div>
        <div class="text-muted d-none d-md-block">
            <i class="bi bi-calendar3 me-2"></i> <?php echo date('l, d F Y'); ?>
        </div>
    </div>

    <div class="row g-4 mb-5">
        
        <div class="col-md-4">
            <div class="card shadow-sm border-0 card-hover h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-circle bg-danger bg-opacity-10 text-danger me-4">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0"><?php echo $produk; ?></h2>
                        <span class="text-muted">Total Produk</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 card-hover h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary me-4">
                        <i class="bi bi-people"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0"><?php echo $user; ?></h2>
                        <span class="text-muted">Total Pengguna</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 card-hover h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-circle bg-success bg-opacity-10 text-success me-4">
                        <i class="bi bi-bag-check"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-0"><?php echo $pesanan; ?></h2>
                        <span class="text-muted">Total Pesanan</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <h5 class="fw-bold mb-3">Aksi Cepat</h5>
    <div class="row g-4">
        
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-circle bg-dark text-white" style="width: 45px; height: 45px; font-size: 20px;">
                            <i class="bi bi-tags"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold">Manajemen Produk</h5>
                    <p class="text-muted mb-4">Tambah stok baru, edit harga, ubah gambar, atau hapus produk yang sudah tidak tersedia.</p>
                    <a href="produk.php" class="btn btn-hm px-4 py-2 rounded-3 w-100 text-center">
                        Masuk ke Produk <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100 rounded-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-circle bg-dark text-white" style="width: 45px; height: 45px; font-size: 20px;">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold">Manajemen Pesanan</h5>
                    <p class="text-muted mb-4">Pantau transaksi masuk, verifikasi pembayaran, dan perbarui status pengiriman barang pelanggan.</p>
                    <a href="pesanan.php" class="btn btn-hm px-4 py-2 rounded-3 w-100 text-center">
                        Masuk ke Pesanan <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-5 text-center text-muted">
        <hr>
        <small><i class="bi bi-shield-check text-success me-1"></i> Sistem berjalan normal. Server Time: <?php echo date("H:i:s"); ?></small>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>