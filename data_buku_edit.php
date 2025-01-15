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

        $coverLama =  $dataBuku[0]['cover'];
        if( $_FILES['cover']['error'] === 4 )
        {
            $cover = $coverLama;
        } else {
            $cover = uploudGambar($_FILES['cover'], 'img/books/', $dataBuku[0]['cover']);
            if(!$cover['status']) {
                $pesan = $cover['pesan'];
                echo "<script> alert('$pesan'); 
                window.location.href = 'data_buku_edit.php?id=$id'; </script>";
                exit;
            }
        }

        $data = [
            "nama_buku" => htmlspecialchars($_POST["namaBuku"]),  
            "isi" => htmlspecialchars($_POST["isiBuku"]),
            "stock" => htmlspecialchars($_POST["stock"]),
            "penulis" => htmlspecialchars($_POST["penulis"]),
            "penerbit" => htmlspecialchars($_POST["penerbit"]),
            "cover" => (empty($cover['pesan']) ? $cover : $cover['pesan']),
            "category_id" => $_POST["kategori"],
        ];
        
        if(editData("buku", "id_buku = $id", $data)) {
            echo "<script> alert('Data Edited Successfully') 
            window.location.href = 'data_buku.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Failed to Edit') </script>";
        }
        
    }
    
    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
    ?>
<h3>Edit Data Buku</h3>
<form action="" method="post" enctype="multipart/form-data">
    <label for="namaBuku">Book Name</label>
    <input type="text" name="namaBuku" id="namaBuku" placeholder="Masukkan Nama Buku" required value="<?= cekvalue($dataBuku[0]['nama_buku']) ?>">
    
    <label for="stock">Stock</label>
    <input type="number" name="stock" min="0" step="1" id="stock" placeholder="Masukkan Stock Buku" required value="<?= cekvalue($dataBuku[0]['stock']) ?>">
    </select>

    <label for="penulis">Author</label>
    <input type="text" name="penulis" id="penulis" placeholder="Masukkan Nama Penulis" required value="<?= cekvalue($dataBuku[0]['penulis']) ?>">

    <label for="penerbit">Publisher</label>
    <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" required value="<?= cekvalue($dataBuku[0]['penerbit']) ?>">

    <label for="kategori">Category</label>
    <select name="kategori" id="kategori" required>
        <?php foreach($datakategori as $kategori) : ?>
            <option <?= $dataBuku[0]['category_id'] == $kategori['id_kategori'] ? "selected" : "" ?> value="<?= $kategori['id_kategori']; ?>"><?= $kategori['nama_kategori']; ?></option>
        <?php endforeach; ?>
    </select>

    <label class="file-upload">
        Choose Cover
        <input type="file" id="fileInput" name="cover">
    </label>

    <!-- Preview Container -->
    <div class="preview-container" id="previewContainer">
        <img id="previewImage" src="img/books/<?= $dataBuku[0]['cover'] ?>" alt="Preview Gambar" mode="edit">
    </div>

    <label for="isiBuku">Contents</label>
    <textarea type="text" name="isiBuku" id="isiBuku" placeholder="Masukkan Isi Buku" required><?= cekvalue($dataBuku[0]['isi']) ?></textarea>

    <button type="submit" name="submit" class="btn-submit">Edit Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?> 

