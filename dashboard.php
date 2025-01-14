<?php
    require_once("base/function.php");
    require_once("layout/atas.php");
    $idUserLogin = $_SESSION['user_id'];
    $data = dataQuery("SELECT * FROM data_pinjam INNER JOIN buku ON data_pinjam.buku_id = buku.id_buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori WHERE data_pinjam.user_id = $idUserLogin");
    $tanggalSekarang = date("Y-m-d");

    if(isset($_POST['kembalikan'])) {
        $id = $_POST['id'];
        if(deleteQueryPinjaman("data_pinjam", "id_pinjam", $id)) {
            echo "<script> alert('Terimakasih telah meminjam buku kami') 
                window.location.href = 'dashboard.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Dihapus') </script>";
        }
    }

?>
<h3>Selamat Datang <?= $user_login[0]['nama_user'] ?>, <?= $user_login[0]['nama_role'] ?></h3>

<div id="myBook">
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
                <li>Jumlah : <?= $d['jumlah'] ?> Buku</li>
            </ul>
            <?php if($d['tanggal_kembali'] < $tanggalSekarang) : ?>
                <h3 class="kembali">Kembalikan Buku Ini</h3>
            <?php endif; ?>
        </div>
        <form action="" method="post" class="button">
            <input type="hidden" name="id" value="<?= $d["id_pinjam"] ?>">
            <button type="submit" name="kembalikan" class="kembalikan">Kembalikan</button>
        </form>
    </div>
    <?php endforeach; ?>
</div>
</div>


<?php
    require_once("layout/bawah.php");
?>