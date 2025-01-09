<?php

require_once("base/function.php");

$id = $_GET['id'];
$data = dataQuery("SELECT * FROM user_role WHERE id_role = $id");

if(isset($_POST["submit"])) {
    $data = [
      "nama_role" => $_POST["namaRole"],  
    ];

    if(editData("user_role", "id_role = $id", $data)) {
        echo "<script> alert('Data Berhasil Diedit') 
            window.location.href = 'data_role.php';
        </script>";
        exit;
    } else {
        echo "<script> alert('Data Gagal Diedit') </script>";
    }

}

    require_once("layout/atas.php");
?>
<h3>Edit Data Role</h3>
<form action="" method="post">
    <label for="namaRole">Nama Role</label>
    <input type="text" name="namaRole" id="namaRole" placeholder="Masukkan Nama Role" required value="<?= cekValue($data[0]['nama_role']) ?>">

    <button type="submit" name="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>