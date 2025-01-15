<?php

require_once("base/function.php");

$dataRole = dataQuery("SELECT * FROM user_role ORDER BY id_role DESC");

if(isset($_POST["submit"])) {
    $password =  password_hash($_POST["password"], PASSWORD_DEFAULT);
    $data = [
      "nama_user" => htmlspecialchars($_POST["name"]),  
      "username" => htmlspecialchars($_POST["username"]),  
      "email" => htmlspecialchars($_POST["email"]),  
      "password" => $password,  
      "jenis_kelamin" => htmlspecialchars($_POST["gender"]),  
      "role_id" => $_POST["role"],  
    ];

    $cekUnikUsername = tambahCekUnique('user', 'username', $data['username']);
    $cekUnikEmail = tambahCekUnique('user', 'email', $data['email']);

    if($cekUnikUsername['status']) {
        if($cekUnikEmail['status']) {
            
            if( $_FILES['profile']['error'] === 4 )
            {
                $profile = "default.jpg";
            } else {
                $profile = uploudGambar($_FILES['profile'], 'img/profile/');

                if(!$profile['status']) {
                    $pesan = $profile['pesan'];
                    echo "<script> alert('$pesan'); 
                    window.location.href = 'data_user_tambah.php'; </script>";
                    exit;
                }
            }

            $data['profile'] = (empty($profile['pesan']) ? $profile : $profile['pesan']);


            if(createData("user", $data)) {
                echo "<script> alert('Data Added Successfully') 
                    window.location.href = 'data_user.php';
                </script>";
                exit;
            } else {
                echo "<script> alert('Data Failed to Add') </script>";
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
<h3>Add User Data</h3>
<form action="" method="post" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" placeholder="Masukkan Nama" required>

    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="Masukkan Username" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Masukkan Email" required>

    <label for="gender">Gender</label>
    <select name="gender" id="gender" required>
        <option value="Laki-Laki">Man</option>
        <option value="Perempuan">Woman</option>
    </select>

    <label for="role">Role</label>
    <select name="role" id="role" required>
        <?php foreach($dataRole as $role) : ?>
            <option value="<?= $role['id_role']; ?>"><?= $role['nama_role']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Masukkan Password" required>

    <label class="file-upload">
        Choose Profile
        <input type="file" id="fileInput" name="profile">
    </label>

    <!-- Preview Container -->
    <div class="preview-container" id="previewContainer">
        <img id="previewImage" src="img/profile/default.jpg" alt="Preview Gambar" mode="edit">
    </div>
    <button class="hapusProfile">Delete Profile</button>

    <button type="submit" name="submit" class="btn-submit">Add Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>