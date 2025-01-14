<?php
    
    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM data_pinjam INNER JOIN user ON data_pinjam.user_id = user.id_user INNER JOIN buku ON data_pinjam.buku_id = buku.id_buku");

    if(isset($_POST['btnDelete'])) {
        $id = $_POST['id'];
        if(deleteQueryPinjaman("data_pinjam", "id_pinjam", $id)) {
            echo "<script> alert('Data Berhasil Dihapus') 
                window.location.href = 'data_pinjam.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Dihapus') </script>";
        }
    }

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Riwayat Peminjaman</h3>
<a href="data_pinjam_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table border="1" cellpadding="50" class="full">
    <tr>
        <th>No</th>
        <th>Nama Peminjam</th>
        <th>Nama Buku</th>
        <th>Jumlah Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Action</th>
    </tr>
    <?php
        $nomor = 1;
        foreach($data as $d):
    ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td><?= $d["nama_user"] ?></td>
        <td><?= $d["nama_buku"] ?></td>
        <td><?= $d["jumlah"] ?></td>
        <td><?= $d["tanggal_pinjam"] ?></td>
        <td><?= $d["tanggal_kembali"] ?></td>
        <td>
            <a href="data_pinjam_edit.php?id=<?= $d["id_pinjam"] ?>" class="btn btn-edit">Edit</a>
            <form action="" method="post" class="delete-form">
                <input type="hidden" name="id" value="<?= $d["id_pinjam"] ?>">
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