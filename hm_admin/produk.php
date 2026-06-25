<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$data = mysqli_query(
    $conn,
    "SELECT * FROM produk ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - H&M Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        
        /* Navbar Styling (Sama dengan Dashboard) */
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

        /* Custom Button & Table styling */
        .btn-hm {
            background-color: #1a1a1a;
            color: white;
            transition: 0.3s;
        }
        .btn-hm:hover {
            background-color: #E50010;
            color: white;
        }
        .table-custom th {
            background-color: #f8f9fa;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
        }
        .img-product {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e9ecef;
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
            <h3 class="fw-bold mb-0">Daftar Produk</h3>
            <p class="text-muted mb-0">Kelola stok, harga, dan katalog produk Anda.</p>
        </div>
        <a href="tambah_produk.php" class="btn btn-hm px-4 py-2 rounded-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">ID</th>
                        <th width="10%">Gambar</th>
                        <th width="25%">Nama Produk</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Harga</th>
                        <th class="text-center" width="10%">Stok</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($data) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($data)){ ?>
                            <tr>
                                <td class="text-center text-muted fw-bold">#<?= $row['id']; ?></td>
                                
                                <td>
                                    <img src="../upload/<?= $row['gambar']; ?>" 
                                         alt="<?= $row['nama_produk']; ?>" 
                                         class="img-product"
                                         onerror="this.src='https://via.placeholder.com/60?text=No+Image'">
                                </td>
                                
                                <td class="fw-bold"><?= $row['nama_produk']; ?></td>
                                
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= $row['kategori']; ?>
                                    </span>
                                </td>
                                
                                <td class="text-danger fw-bold">
                                    Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                                </td>
                                
                                <td class="text-center">
                                    <?php if($row['stok'] <= 5): ?>
                                        <span class="badge bg-danger">Sisa <?= $row['stok']; ?></span>
                                    <?php else: ?>
                                        <span class="text-success fw-bold"><?= $row['stok']; ?></span>
                                    <?php endif; ?>
                                </td>
                                
                                <td class="text-center">
                                    <a href="edit_produk.php?id=<?= $row['id']; ?>" class="btn btn-outline-dark btn-sm rounded-3 me-1 px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="hapus_produk.php?id=<?= $row['id']; ?>" class="btn btn-outline-danger btn-sm rounded-3 px-3" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini? Data yang dihapus tidak bisa dikembalikan.')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 text-muted">Belum ada produk</h5>
                                <p class="text-muted">Klik tombol "Tambah Produk" untuk mulai memasukkan data.</p>
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