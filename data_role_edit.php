<?php

require_once("base/function.php");

if(!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$dataRole = dataQuery("SELECT * FROM user_role WHERE id_role = $id");

if(isset($_POST["submit"])) {
    $data = [
      "nama_role" => $_POST["namaRole"],  
    ];

    $cekUnik = editCekUnique('user_role', 'nama_role', 'id_role', $id, $data["nama_role"]);

    if($cekUnik['status']) {
        if(editData("user_role", "id_role = $id", $data)) {
            echo "<script> alert('Data Edited Successfully') 
                window.location.href = 'data_role.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Failed to Edit') </script>";
        }
    } else {
        $pesan = $cekUnik['pesan'];
        echo "<script> alert(`$pesan`) </script>";
    }

}

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Edit Role Data</h3>
<form action="" method="post">
    <label for="namaRole">Role Name</label>
    <input type="text" name="namaRole" id="namaRole" placeholder="Masukkan Nama Role" required value="<?= cekValue($dataRole[0]['nama_role']) ?>">

    <button type="submit" name="submit" class="btn-submit">Edit Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>