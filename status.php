<?php

    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM status");


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
            <a href="" class="btn btn-edit">Edit</a>
            <a href="" class="btn btn-delete">Delete</a>
        </td>
    </tr>
    <?php
        endforeach;
    ?>
</table>
<?php
    require_once("layout/bawah.php");
?>