<?php

require_once("base/function.php");

if(!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET["id"];
$dataRole = dataQuery("SELECT * FROM user_role ORDER BY id_role DESC");
$dataUser = dataQuery("SELECT * FROM user WHERE id_user = $id");

if(isset($_POST["submit"])) {

    $data = [
      "nama_user" => htmlspecialchars($_POST["name"]),  
      "username" => htmlspecialchars($_POST["username"]),  
      "email" => htmlspecialchars($_POST["email"]),
      "jenis_kelamin" => htmlspecialchars($_POST["gender"]),  
      "role_id" => $_POST["role"],  
    ];

    $cekUnikUsername = editCekUnique('user', 'username', 'id_user', $id, $data["username"]);
    $cekUnikEmail = editCekUnique('user', 'email', 'id_user', $id, $data["email"]);

    if($cekUnikUsername['status']) {
        if($cekUnikEmail['status']) {
            if($_POST['hapusProfile'] == "true") {
                $imageLama = $dataUser[0]['profile'] != "default.jpg" ? $dataUser[0]['profile'] : false;
                if($imageLama != false) {
                    hapusImageLama("img/profile/$imageLama");
                }
                $profileLama =  'default.jpg';
        
            } else {
                $profileLama =  $dataUser[0]['profile'];
            }
            
            if( $_FILES['profile']['error'] === 4 )
            {
                $profile = $profileLama;
            } else {
                $imageLama = $dataUser[0]['profile'] != "default.jpg" ? $dataUser[0]['profile'] : false;
                $profile = uploudGambar($_FILES['profile'], "img/profile/", $imageLama);
        
                if(!$profile['status']) {
                    $pesan = $profile['pesan'];
                    echo "<script> alert('$pesan'); 
                    window.location.href = 'data_user_edit.php?id=$id'; </script>";
                    exit;
                }
            }

            $data['profile'] = (empty($profile['pesan']) ? $profile : $profile['pesan']);
            if(editData("user", "id_user = $id", $data)) {
                echo "<script> alert('Data Berhasil Diedit') 
                    window.location.href = 'data_user.php';
                </script>";
                exit;
            } else {
                echo "<script> alert('Data Gagal Diedit') </script>";
            }

        } else {
            $pesan = $cekUnikEmail['pesan'];
            echo "<script> alert(`$pesan`) </script>";
        }
        
    } else {
        $pesan = $cekUnikUsername['pesan'];
        echo "<script> alert(`$pesan`) </script>";
    }

}

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Edit Data User</h3>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="hapusProfile" id="hapusProfile" value="false">

    <label for="name">Nama</label>
    <input type="text" name="name" id="name" placeholder="Masukkan Nama" required value="<?= cekValue($dataUser[0]['nama_user']) ?>">

    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="Masukkan Username" required value="<?= cekValue($dataUser[0]['username']) ?>">

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Masukkan Email" required value="<?= cekValue($dataUser[0]['email']) ?>">

    <label for="gender">Jenis Kelamin</label>
    <select name="gender" id="gender" required>
        <option <?= $dataUser[0]['jenis_kelamin'] == "Laki-Laki" ? "selected" : "" ?> value="Laki-Laki">Laki-laki</option>
        <option <?= $dataUser[0]['jenis_kelamin'] == "Perempuan" ? "selected" : "" ?> value="Perempuan">Perempuan</option>
    </select>

    <label for="role">Role</label>
    <select name="role" id="role" required>
        <?php foreach($dataRole as $role) : ?>
            <option <?= $dataUser[0]['role_id'] == $role['id_role'] ? "selected" : "" ?> value="<?= $role['id_role']; ?>"><?= $role['nama_role']; ?></option>
        <?php endforeach; ?>
    </select>

    <label class="file-upload">
        Pilih Profile
        <input type="file" id="fileInput" name="profile">
    </label>

    <!-- Preview Container -->
    <div class="preview-container" id="previewContainer">
        <img id="previewImage" src="img/profile/<?= $dataUser[0]['profile'] ?>" alt="Preview Gambar" mode="edit">
    </div>
    <button class="hapusProfile">Hapus Profile</button>

    <button type="submit" name="submit" class="btn-submit">Edit Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>