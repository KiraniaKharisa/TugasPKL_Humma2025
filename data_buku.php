<?php
    
    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id");

    require_once("layout/atas.php");
?>
<h3>Halaman Data Buku</h3>
<a href="data_buku_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table border="1" cellpadding="50" class="full">
    <tr>
        <th>No</th>
        <th>Nama Buku</th>
        <th>Stock</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Kategori</th>
        <th>Action</th>
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $d["nama_buku"] ?></td>
        <td><?= $d["stock"] ?></td>
        <td><?= $d["penulis"] ?></td>
        <td><?= $d["penerbit"] ?></td>
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