<?php

require_once("base/function.php");

if(isset($_POST["submit"])) {
    $data = [
      "nama_role" => $_POST["namaRole"],  
    ];

    if(createData("user_role", $data)) {
        echo "<script> alert('Data Berhasil Ditambahkan') 
            window.location.href = 'data_role.php';
        </script>";
        exit;
    } else {
        echo "<script> alert('Data Gagal Ditambahkan') </script>";
    }

}

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Tambah Data Role</h3>
<form action="" method="post">
    <label for="namaRole">Nama Role</label>
    <input type="text" name="namaRole" id="namaRole" placeholder="Masukkan Nama Role" required>

    <button type="submit" name="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>