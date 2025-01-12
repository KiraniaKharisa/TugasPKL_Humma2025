<?php

    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM riwayat_peminjaman INNER JOIN user ON riwayat_peminjaman.user_id = user.id_user INNER JOIN status ON riwayat_peminjaman.status_id = status.id_status INNER JOIN buku ON riwayat_peminjaman.buku_id = buku.id_buku INNER JOIN user_role ON user.role_id = user_role.id_role");
    require_once("layout/atas.php");
?>
<h3>Riwayat Buku</h3>
<table  border="1" cellpadding="50" class="full">
    <tr>
        <th>No.</th>
        <th>Nama Status</th>
        <th>Tanggal</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= "{$d['nama_role']} {$d['nama_user']} Me{$d['status_nama']} Buku {$d['nama_buku']}" ?></td>
        <td><?= $d['tanggal'] ?></td>
        <td><?= $d['tanggal_pinjam'] ?></td>
        <td><?= $d['tanggal_kembali'] ?></td>
    </tr>
    <?php
        endforeach;
    ?>
</table>
<?php
    require_once("layout/bawah.php");
?>