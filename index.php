<?php
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Perpustakaan Rania</title>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <h3>PERPUSTAKAAN</h3>
        </div>
        <div class="link">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#bestSeller">BestSeller</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="link2">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </nav>
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
            <div class="card">
                <div class="image">
                    <img src="img/books/dearJ.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku Dear J</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/afterDearJ.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku After Dear J</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/withJ.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku With J</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/afterWithJ.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku After With J</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/sunset.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku Sunset And Rosie</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/rindu.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku Rindu</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/pulang.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku Pulang</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/pergi.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku Pergi</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/hujan.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku Hujan</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
            <div class="card">
                <div class="image">
                    <img src="img/books/eliana.jpeg" alt="">
                </div>
                <div class="detail">
                    <h2 class="judul">Buku Eliana</h2>
                </div>
                <a class="buy" href="">Pinjam</a>
            </div>
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