<?php

session_start();
require_once('base/function.php');

if(isset($_SESSION['login'])) {
    $id = $_SESSION['user_id'];
    $user_login = dataQuery("SELECT * FROM user INNER JOIN user_role ON user.role_id = user_role.id_role WHERE id_user = $id");

}
$dataBuku = dataQuery("SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori");
$dataKategori = dataQuery("SELECT * FROM kategori_buku");

if(isset($_GET['cariBtn'])) {

    $query = cariBuku($_GET['cari'], $_GET['kategori']);

    $dataBuku = dataQuery($query);
}
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>List buku</title>
</head>
<body>

    <?php
        require_once('layout/navbar.php');
    ?>

    <section id="bestSeller" class="list_buku">
        <h1>SEMUA BUKU</h1>
        <form class="cari" action="">
            <input type="text" name="cari" placeholder="Cari buku berdasarkan nama, penulis, penerbit">
            <select name="kategori" id="">
                <option value="">Semua Buku</option>
                <?php foreach($dataKategori as $data) : ?>
                    <?php if(isset($_GET['kategori'])) : ?>
                        <option <?= $_GET['kategori'] == $data['id_kategori'] ? "selected" : "" ?> value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                    <?php else : ?>
                        <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="cariBtn" class="btn-submit">Cari</button>
        </form>
        <div class="container">
        <?php foreach($dataBuku as $d) : ?>
            <div class="card">
                <div class="image">
                    <img src="img/books/<?= $d['cover'] ?>" alt="">
                </div>
                <div class="detail">
                <h2 class="judul"><?= $d['nama_buku'] ?></h2>
                    <ul>
                        <li>Kategori : <?= $d['nama_kategori'] ?></li>
                        <li>Penulis : <?= $d['penulis'] ?></li>
                        <li>Penerbit : <?= $d['penerbit'] ?></li>
                        <li>Stok : <?= $d['stock'] ?> Buku</li>
                    </ul>
                </div>
                <div class="button">
                    <a class="buy" href="form_pinjam.php?buku_id=<?= $d['id_buku'] ?>">Pinjam</a>

                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </section>
    
    
    <footer id="footer">
        <div class="kontak">
            <div class="kontak1">
                   <h3>LIBRARY CONTACT</h3>
                   <p><i class="bi bi-telephone-fill"></i> 082213080205</p>
                   <p><i class="bi bi-envelope-fill"></i> perpusrania25@gmail.com</p>
                   <p><i class="bi bi-buildings-fill"></i> Jl. Pelita No 27 Sidomekar-Semboro-Jember, Jawa Timur, Indonesia</p>
            </div>

            <div class="kontak2">
                <h3>SOCIAL MEDIA</h3>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-youtube"></i></a>
                <a href=""><i class="bi bi-whatsapp"></i></a>
                
            </div>
        </div>

        <div class="copyright">
            <h3>&copy; PERPUS RANIA 2025</h3>
        </div>
    </footer>

    <div>
        
    </div>
</body>
</html>