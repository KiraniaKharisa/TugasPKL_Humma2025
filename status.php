<?php

    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM status");
    if(isset($_POST['btnDelete'])) {
        $id = $_POST['id'];
        if(deleteQuery("status", "id_status = $id")) {
            echo "<script> alert('Data Berhasil Dihapus') 
                window.location.href = 'status.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Dihapus') </script>";
        }
    }


    require_once("layout/atas.php");
?>
<h3>Data Status Riwayat Buku</h3>
<a href="status_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table  border="1" cellpadding="50">
    <tr>
        <th>No.</th>
        <th>Nama Status</th>
        <th>Action</th>
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $d["status_nama"] ?></td>
        <td>
            <a href="status_edit.php?id=<?= $d['id_status'] ?>" class="btn btn-edit">Edit</a>
            <form action="" method="post" class="delete-form">
                <input type="hidden" name="id" value="<?= $d["id_status"] ?>">
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