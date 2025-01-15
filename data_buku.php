<?php
    
    require_once("base/function.php");
    $data = dataQuery("SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori");

    if(isset($_POST['btnDelete'])) {
        $id = $_POST['id'];
        $dataBuku = dataQuery("SELECT * FROM buku WHERE id_buku = $id");
        if(deleteQuery("buku", "id_buku = $id")) {
            $imageLama = $dataBuku[0]['cover'];
            if($imageLama != false) {
                hapusImageLama("img/books/$imageLama");
            }
            echo "<script> alert('Data Deleted Successfully') 
                window.location.href = 'data_buku.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Failed to Delete') </script>";
        }
    }

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Book Data Page</h3>
<a href="data_buku_tambah.php" class="btn btn-tambah">Tambah Data</a>
<table border="1" cellpadding="50" class="full">
    <tr>
        <th>No</th>
        <th>Book Name</th>
        <th>Stock</th>
        <th>Borrowing</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Category</th>
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
        <td><?= ($d["jumlah_peminjaman"] == NULL ? 0 : $d["jumlah_peminjaman"]) ?></td>
        <td><?= $d["penulis"] ?></td>
        <td><?= $d["penerbit"] ?></td>
        <td><?= $d["nama_kategori"] ?></td>
        <td>
            <a href="data_buku_edit.php?id=<?= $d["id_buku"] ?>" class="btn btn-edit">Edit</a>
            <form action="" method="post" class="delete-form">
                <input type="hidden" name="id" value="<?= $d["id_buku"] ?>">
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