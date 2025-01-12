<?php
    require_once("base/function.php");
    
    if(!isset($_GET['id'])) {
        header("Location: dashboard.php");
        exit;
    }
    $id = $_GET['id'];
    $dataBuku = dataQuery("SELECT * FROM buku WHERE id_buku = $id");
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
        
        if(editData("buku", "id_buku = $id", $data)) {
            echo "<script> alert('Data Berhasil Diedit') 
            window.location.href = 'data_buku.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Diedit') </script>";
        }
        
    }
    
    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
    ?>
<h3>Edit Data Buku</h3>
<form action="" method="post">
    <label for="namaBuku">Nama Buku</label>
    <input type="text" name="namaBuku" id="namaBuku" placeholder="Masukkan Nama Buku" required value="<?= cekvalue($dataBuku[0]['nama_buku']) ?>">
    
    <label for="stock">Stock</label>
    <input type="number" name="stock" min="0" step="1" id="stock" placeholder="Masukkan Stock Buku" required value="<?= cekvalue($dataBuku[0]['stock']) ?>">
    </select>

    <label for="penulis">Penulis</label>
    <input type="text" name="penulis" id="penulis" placeholder="Masukkan Nama Penulis" required value="<?= cekvalue($dataBuku[0]['penulis']) ?>">

    <label for="penerbit">Penerbit</label>
    <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" required value="<?= cekvalue($dataBuku[0]['penerbit']) ?>">

    <label for="kategori">Kategori</label>
    <select name="kategori" id="kategori" required>
        <?php foreach($datakategori as $kategori) : ?>
            <option <?= $dataBuku[0]['category_id'] == $kategori['id_kategori'] ? "selected" : "" ?> value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="isiBuku">Isi</label>
    <textarea type="text" name="isiBuku" id="isiBuku" placeholder="Masukkan Isi Buku" required><?= cekvalue($dataBuku[0]['isi']) ?></textarea>

    <button type="submit" name="submit" class="btn-submit">Edit Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?> 

