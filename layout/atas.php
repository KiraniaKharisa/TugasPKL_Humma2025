<?php
session_start();
require_once("base/function.php");
if(!isset($_SESSION["login"]))
{
  header("Location: login.php");
  exit();
}

$id = $_SESSION['user_id'];
$user_login = dataQuery("SELECT * FROM user INNER JOIN user_role ON user.role_id = user_role.id_role WHERE id_user = $id");

if(isset($_POST['logout'])) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Dashboard Page</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <h3>PERPUSTAKAAN</h3>
            </div>
            <ul>
                <li><a href="dashboard.php"><i class="bi bi-house-fill"></i> Dashboard</a></li>
<<<<<<< HEAD
                <?php if($user_login[0]["role_id"] == 1): ?>
                    <li><a href="data_user.php"><i class="bi bi-person-fill"></i> Data User</a></li>
                    <li><a href="data_role.php"><i class="bi bi-pc-display-horizontal"></i> Data Role</a></li>
                    <li><a href="data_buku.php"><i class="bi bi-journals"></i> Data Buku</a></li>
                    <li><a href="kategori.php"><i class="bi bi-tag"></i> Data Kategori</a></li>
                    <li><a href="data_pinjam.php"><i class="bi bi-stopwatch"></i> Data Peminjaman</a></li>
                <?php endif; ?>
                    <form action="" method="post">
                    <li class="logout"><button type="submit" onclick="return confirmButton('Anda Yakin ?')" name="logout" class="btn btn-delete" href="#home"><i class="bi bi-box-arrow-left"></i> Log Out</button></li>

                </form>
=======
                <li><a href="data_user.php"><i class="bi bi-person-fill"></i> Data User</a></li>
                <li><a href="data_role.php"><i class="bi bi-pc-display-horizontal"></i> Data Role</a></li>
                <li><a href="data_buku.php"><i class="bi bi-journals"></i> Data Buku</a></li>
                <li><a href="kategori.php"><i class="bi bi-tag"></i> Data Kategori</a></li>
                <li><a href="status.php"><i class="bi bi-arrow-clockwise"></i> Status</a></li>
                <li><a href="riwayat.php"><i class="bi bi-stopwatch"></i> Riwayat</a></li>
                <li class="logout"><a href="#home"><i class="bi bi-box-arrow-left"></i> Log Out</a></li>
>>>>>>> 2991aac5dec7e877eecedac829850d44627d3872
            </ul>
        </div>
        <div class="row">
            <div class="navbar">
                <div class="user">
                    <span><?= $user_login[0]['nama_user'] ?></span>
                    <img src="img/profile/rani.jpg" width="40" alt="">
                </div>
            </div>
            <div class="content">