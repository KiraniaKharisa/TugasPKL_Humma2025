<?php

    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM kategori_buku");

    require_once("layout/atas.php");
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