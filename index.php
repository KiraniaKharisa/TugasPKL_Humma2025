<?php

session_start();
require_once('base/function.php');

if(isset($_SESSION['login'])) {
    $id = $_SESSION['user_id'];
    $user_login = dataQuery("SELECT * FROM user INNER JOIN user_role ON user.role_id = user_role.id_role WHERE id_user = $id");

}
$data = dataQuery("SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori ORDER BY buku.jumlah_peminjaman DESC LIMIT 10");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Perpustakaan Rania</title>
</head>
<body>

    <?php
        require_once('layout/navbar.php');
    ?>

    <section id="home">
        <div class="container">
            <div class="kotak1">
            <h1>Hello Everyone</h1>
                <p>welcome to the library website.</p>
            </div>
            <div class="kotak2">
                <img src="img/gambar1.png" alt="">
            </div>
        </div>
    </section>

    <section id="about">
        <h1>ABOUT</h1>
        <div class="container">
            <div class="kotak1">
                <h3>Tentang Perpustakaan Kami</h3>
                <p>Perpustakaan website adalah platform digital yang menyediakan akses ke berbagai koleksi informasi, seperti buku elektronik (e-book), jurnal, artikel, video, atau multimedia lainnya. Berfungsi sebagai pusat sumber daya daring, perpustakaan ini memungkinkan pengguna untuk mencari, membaca, dan mengunduh materi yang relevan kapan saja dan di mana saja. Biasanya dilengkapi dengan fitur pencarian, filter, dan kategori untuk mempermudah navigasi. Selain itu, perpustakaan website dapat menawarkan layanan tambahan, seperti peminjaman e-book, diskusi komunitas, atau panduan belajar. Perpustakaan jenis ini banyak digunakan oleh institusi pendidikan, organisasi, atau masyarakat umum untuk mendukung pembelajaran, penelitian, dan pengembangan pengetahuan.</p>
            </div>
            <div class="kotak2">
                <img src="img/gambar2.png" alt="">
            </div>
        </div>
    </section>

    <section id="bestSeller">
        <h1>10 MOST POPULAR BOOKS</h1>
        <div class="container">
        <?php foreach($data as $d) : ?>
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
        
        <div class="selengkapnya">
            <a href="list_buku.php">Lebih Banyak Buku</a>
        </div>
    </section>
    
    <section id="contact">
        <h1>CONTACT ME</h1>
        <div class="contact-content">
            <label for="firstName">FIRST NAME</label>
            <input type="text" placeholder="First Name..." id="firstName">
            <label for="lastName">LAST NAME</label>
            <input type="text" placeholder="Last Name..." id="lastName">
            <label for="email">EMAIL</label>
            <input type="email" placeholder="Email..." id="email">
            <label for="message">MESSAGE</label>
            <textarea placeholder="Message..." id="message"></textarea>
            <button type="submit">Send Me</button>
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