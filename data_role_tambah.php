<?php

require_once("base/function.php");

if(isset($_POST["submit"])) {
    $data = [
      "nama_role" => htmlspecialchars($_POST["namaRole"]),  
    ];

    $cekUnik = tambahCekUnique('user_role', 'nama_role', $data['nama_role']);

    if($cekUnik['status']) {
        if(createData("user_role", $data)) {
            echo "<script> alert('Data Successfully Added') 
                window.location.href = 'data_role.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Failed to Add') </script>";
        }
    } else {
        $pesan = $cekUnik['pesan'];
        echo "<script> alert(`$pesan`) </script>";
    }
    

}

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Add Role Data</h3>
<form action="" method="post">
    <label for="namaRole">Role Name</label>
    <input type="text" name="namaRole" id="namaRole" placeholder="Masukkan Nama Role" required>

    <button type="submit" name="submit" class="btn-submit">Add Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>