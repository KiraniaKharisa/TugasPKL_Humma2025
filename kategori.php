<?php

    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM kategori_buku");
    if(isset($_POST['btnDelete'])) {
        $id = $_POST['id'];
        if(deleteQuery("kategori_buku", "id_kategori = $id")) {
            echo "<script> alert('Data Berhasil Dihapus') 
                window.location.href = 'kategori.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Dihapus') </script>";
        }
    }

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Data Kategori Buku</h3>
<a href="kategori_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table border="1" cellpadding="50">
    <tr>
        <th>No.</th>
        <th>Nama Kategori</th>
        <th>Action</th>
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
    <td><?= $nomor++ ?></td>
    <td><?= $d["nama_kategori"] ?></td>
        <td>
            <a href="kategori_edit.php?id=<?= $d["id_kategori"] ?>" class="btn btn-edit">Edit</a>
            <form action="" method="post" class="delete-form">
                <input type="hidden" name="id" value="<?= $d["id_kategori"] ?>">
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