<?php

    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM user INNER JOIN user_role ON user.role_id = user_role.id");

    require_once("layout/atas.php");
?>
<h3>Data User</h3>
<a href="data_user_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table class="full" border="1" cellpadding="50">
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Email</th>
        <th>Jenis Kelamin</th>
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