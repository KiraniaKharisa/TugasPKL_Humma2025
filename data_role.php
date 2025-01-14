<?php
    
    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM user_role");

    if(isset($_POST['btnDelete'])) {
        $id = $_POST['id'];
        if(deleteQuery("user_role", "id_role = $id")) {
            echo "<script> alert('Data Berhasil Dihapus') 
                window.location.href = 'data_role.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Dihapus') </script>";
        }
    }

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Halaman Data Role</h3>
<a href="data_role_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table border="1" cellpadding="50">
    <tr>
        <th>NO</th>
        <th>NAMA ROLE</th>
        <!-- <th>ACTION</th> -->
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $d["nama_role"] ?></td>
        <!-- <td>
            <a href="data_role_edit.php?id=<?= $d["id_role"] ?>" class="btn btn-edit">Edit</a>
            <form action="" method="post" class="delete-form">
                <input type="hidden" name="id" value="<?= $d["id_role"] ?>">
                <button type="submit" name="btnDelete" onclick="return confirmButton('Anda Yakin ?')" class="btn btn-delete">Delete</button>
            </form>
        </td> -->
    </tr>
    <?php
        endforeach;
    ?>
</table>
<?php
    require_once("layout/bawah.php");
?>