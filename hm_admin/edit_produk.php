<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM produk WHERE id='$id'"
    )
);

if(isset($_POST['update'])){
    $nama = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $gambar = $data['gambar'];

    // Cek jika ada gambar baru yang diunggah
    if(!empty($_FILES['gambar']['name'])){
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file(
            $tmp,
            "../upload/" . $gambar
        );
    }

    mysqli_query(
        $conn,
        "UPDATE produk SET
        nama_produk='$nama',
        kategori='$kategori',
        harga='$harga',
        stok='$stok',
        gambar='$gambar',
        deskripsi='$deskripsi'
        WHERE id='$id'"
    );

    header("Location: produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - H&M Admin</title>

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
            border-radius: 4px;
        }
        .brand-text {
            color: #333;
            font-weight: 700;
            margin-left: 10px;
            letter-spacing: 1px;
        }

        /* Form Customizations */
        .form-control:focus {
            border-color: #E50010;
            box-shadow: 0 0 0 0.25rem rgba(229, 0, 16, 0.25);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
        }
        
        /* Buttons */
        .btn-hm {
            background-color: #E50010;
            color: white;
            transition: 0.3s;
            font-weight: bold;
        }
        .btn-hm:hover {
            background-color: #C0000C;
            color: white;
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
            <a href="produk.php" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-bold">
                <i class="bi bi-x-lg me-1"></i> Batal
            </a>
        </div>
    </div>
</nav>

<div class="container mb-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Edit Data Produk</h3>
                <p class="text-muted">Perbarui informasi produk seperti harga, stok, atau gambar.</p>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    
                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-4">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($data['nama_produk']); ?>" required>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($data['kategori']); ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea name="deskripsi" class="form-control" rows="4" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                        </div>

                        <div class="p-3 bg-light rounded-3 border mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center border-end">
                                    <span class="d-block text-muted small fw-bold mb-2">Gambar Saat Ini</span>
                                    <img src="../upload/<?= $data['gambar']; ?>" class="img-thumbnail rounded-3" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/100?text=No+Image'">
                                </div>
                                
                                <div class="col-md-9 ps-md-4 mt-3 mt-md-0">
                                    <label class="form-label">Ganti Gambar <span class="text-muted fw-normal fst-italic">(Opsional)</span></label>
                                    <input type="file" name="gambar" class="form-control" accept="image/*">
                                    <small class="text-muted d-block mt-2">
                                        <i class="bi bi-info-circle me-1"></i> Biarkan kosong jika tidak ingin mengubah gambar produk.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 text-muted">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="produk.php" class="btn btn-light border px-4">Kembali</a>
                            <button type="submit" name="update" class="btn btn-hm px-4">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>