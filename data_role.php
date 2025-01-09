<?php
    
    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM user_role INNER JOIN user ON user_role.id = user.id");

    require_once("layout/atas.php");
?>
<h3>Halaman Data Role</h3>
<a href="data_role_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table border="1" cellpadding="50">
    <tr>
        <th>NO</th>
        <th>NAMA ROLE</th>
        <th>ACTION</th>
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $d["nama_role"] ?></td>
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