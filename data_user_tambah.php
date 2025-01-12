<?php

require_once("base/function.php");

$dataRole = dataQuery("SELECT * FROM user_role ORDER BY id_role DESC");

if(isset($_POST["submit"])) {
<<<<<<< HEAD
    $password =  password_hash($_POST["password"], PASSWORD_DEFAULT);
=======
>>>>>>> 2991aac5dec7e877eecedac829850d44627d3872
    $data = [
      "nama_user" => $_POST["name"],  
      "username" => $_POST["username"],  
      "email" => $_POST["email"],  
<<<<<<< HEAD
      "password" => $password,  
=======
      "password" => $_POST["password"],  
>>>>>>> 2991aac5dec7e877eecedac829850d44627d3872
      "jenis_kelamin" => $_POST["gender"],  
      "role_id" => $_POST["role"],  
    ];

    if(createData("user", $data)) {
        echo "<script> alert('Data Berhasil Ditambahkan') 
            window.location.href = 'data_user.php';
        </script>";
        exit;
    } else {
        echo "<script> alert('Data Gagal Ditambahkan') </script>";
    }

}

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Tambah Data User</h3>
<form action="" method="post">
    <label for="name">Nama</label>
    <input type="text" name="name" id="name" placeholder="Masukkan Nama" required>

    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="Masukkan Username" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Masukkan Email" required>

    <label for="gender">Jenis Kelamin</label>
    <select name="gender" id="gender" required>
        <option value="Laki-Laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>

    <label for="role">Role</label>
    <select name="role" id="role" required>
        <?php foreach($dataRole as $role) : ?>
            <option value="<?= $role['id_role']; ?>"><?= $role['nama_role']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Masukkan Password" required>

    <button type="submit" name="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>