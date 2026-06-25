<?php
session_start();
include 'koneksi.php';

$error = false; // Flag untuk mengecek apakah login gagal

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM admin
        WHERE username='$username'
        AND password='$password'"
    );

    if(mysqli_num_rows($query) > 0){
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");
        exit;
    }else{
        $error = true; // Set ke true jika gagal, agar bisa dipanggil di HTML
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H&M Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Styling tambahan agar lebih mirip identitas H&M */
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center; /* Membuat form selalu di tengah vertikal */
        }
        .brand-logo {
            background-color: #E50010; /* Merah H&M */
            color: white;
            display: inline-block;
            padding: 10px 24px;
            font-weight: 900;
            font-size: 2rem;
            letter-spacing: 3px;
        }
        .card-login {
            border-radius: 20px;
            border: none;
        }
        /* Efek fokus pada input agar garisnya berwarna merah, bukan biru bawaan */
        .form-control:focus {
            border-color: #E50010;
            box-shadow: 0 0 0 0.25rem rgba(229, 0, 16, 0.25);
        }
        .btn-hm {
            background-color: #E50010;
            color: white;
            font-weight: bold;
            letter-spacing: 1.5px;
        }
        .btn-hm:hover {
            background-color: #C0000C;
            color: white;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            
            <div class="card card-login shadow-lg">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-4">
                        <span class="brand-logo">H&M</span>
                        <h6 class="text-muted mt-3 fw-bold">ADMIN PORTAL</h6>
                    </div>

                    <?php if($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <small><strong>Login Gagal!</strong> Periksa kembali username dan password Anda.</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username" required>
                            <label for="floatingUsername" class="text-muted">Username</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword" class="text-muted">Password</label>
                        </div>

                        <button type="submit" name="login" class="btn btn-hm w-100 py-3 rounded-3">
                            LOGIN
                        </button>

                    </form>

                </div>
            </div>

            <div class="text-center mt-4">
                <small class="text-muted">&copy; <?php echo date("Y"); ?> H&M Store Management. All rights reserved.</small>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>