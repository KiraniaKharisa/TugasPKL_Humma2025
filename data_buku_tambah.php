<?php
    require_once("base/function.php");

    $datakategori = dataQuery("SELECT * FROM kategori_buku");

    if(isset($_POST["submit"])) {
        $data = [
          "nama_buku" => $_POST["namaBuku"],  
          "isi" => $_POST["isiBuku"],
          "stock" => $_POST["stock"],
          "penulis" => $_POST["penulis"],
          "penerbit" => $_POST["penerbit"],
          "category_id" => $_POST["kategori"],
        ];

        if(createData("buku", $data)) {
            echo "<script> alert('Data Berhasil Ditambahkan') 
                window.location.href = 'data_buku.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Ditambahkan') </script>";
        }

    }

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Tambah Data Buku</h3>
<form action="" method="post">
    <label for="namaBuku">Nama Buku</label>
    <input type="text" name="namaBuku" id="namaBuku" placeholder="Masukkan Nama Buku" required>
    
    <label for="stock">Stock</label>
    <input type="number" name="stock" min="0" step="1" id="stock" placeholder="Masukkan Stock Buku" required>
    </select>

    <label for="penulis">Penulis</label>
    <input type="text" name="penulis" id="penulis" placeholder="Masukkan Nama Penulis" required>

    <label for="penerbit">Penerbit</label>
    <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" required>

    <label for="kategori">Kategori</label>
    <select name="kategori" id="kategori" required>
        <?php foreach($datakategori as $kategori) : ?>
            <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="isiBuku">Isi</label>
    <textarea type="text" name="isiBuku" id="isiBuku" placeholder="Masukkan Isi Buku" required></textarea>

    <button type="submit" name="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?> 

