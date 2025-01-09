<?php

require_once("base/function.php");

if(isset($_POST["submit"])) {
    $data = [
      "nama_kategori" => $_POST["namaKategori"],  
    ];

    if(createData("kategori_buku", $data)) {
        echo "<script> alert('Data Berhasil Ditambahkan') 
            window.location.href = 'kategori.php';
        </script>";
        exit;
    } else {
        echo "<script> alert('Data Gagal Ditambahkan') </script>";
    }

}

    require_once("layout/atas.php");
?>
<h3>Data Tambah Kategori</h3>
<form action="" method="post">
    <label for="namaKategori">Nama Kategori</label>
    <input type="text" name="namaKategori" id="namaKategori" placeholder="Masukkan Nama Kategori" required>

    <button name="submit" type="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>