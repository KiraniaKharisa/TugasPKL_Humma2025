<?php

    session_start();
    require_once("base/function.php");
    $idMasuk = $_SESSION["user_id"];
    $data = dataQuery("SELECT * FROM user INNER JOIN user_role ON user.role_id = user_role.id_role WHERE id_user != $idMasuk");

    if(isset($_POST['btnDelete'])) {
        $id = $_POST['id'];
        $dataUser = dataQuery("SELECT * FROM user WHERE id_user = $id");
        if(deleteQuery("user", "id_user = $id")) {
            $imageLama = $dataUser[0]['profile'] != "default.jpg" ? $dataUser[0]['profile'] : false;
                if($imageLama != false) {
                    hapusImageLama("img/profile/$imageLama");
                }
            echo "<script> alert('Data Deleted Successfully') 
                window.location.href = 'data_user.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Failed to Delete') </script>";
        }
    }

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>User Data</h3>
<a href="data_user_tambah.php" class="btn btn-tambah">Add Data</a>
<table class="full" border="1" cellpadding="50">
    <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $d["nama_user"] ?></td>
        <td><?= $d["username"] ?></td>
        <td><?= $d["email"] ?></td>
        <td><?= $d["jenis_kelamin"] ?></td>
        <td><?= $d["nama_role"] ?></td>
        <td>
            <a href="data_user_edit.php?id=<?= $d["id_user"] ?>" class="btn btn-edit">Edit</a>
            <form action="" method="post" class="delete-form">
                <input type="hidden" name="id" value="<?= $d["id_user"] ?>">
                <button type="submit" name="btnDelete" onclick="return confirmButton('Anda Yakin ?')" class="btn btn-delete">Delete</button>
            </form>
        </td>
    </tr> 
    <?php
        endforeach;
    ?>
</table>
<?php
    require_once("layout/bawah.php");
?>