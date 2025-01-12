<?php

require_once("base/function.php");

<<<<<<< HEAD
if(!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

=======
>>>>>>> 2991aac5dec7e877eecedac829850d44627d3872
$id = $_GET['id'];
$dataKategori = dataQuery("SELECT * FROM kategori_buku WHERE id_kategori = $id");

if(isset($_POST["submit"])) {
    $data = [
      "nama_kategori" => $_POST["namaKategori"],  
    ];

    if(editData("kategori_buku", "id_kategori = $id", $data)) {
        echo "<script> alert('Data Berhasil Diedit') 
            window.location.href = 'kategori.php';
        </script>";
        exit;
    } else {
        echo "<script> alert('Data Gagal Diedit') </script>";
    }

}

    require_once("layout/atas.php");
<<<<<<< HEAD
    cekRole($user_login[0]['role_id'], '1');
=======
>>>>>>> 2991aac5dec7e877eecedac829850d44627d3872
?>
<h3>Edit Data Kategori</h3>
<form action="" method="post">
    <label for="namaKategori">Nama Kategori</label>
    <input type="text" name="namaKategori" id="namaKategori" placeholder="Masukkan Nama Kategori" required value="<?= cekValue($dataKategori[0]['nama_kategori']) ?>">

    <button name="submit" type="submit" class="btn-submit">Edit Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>