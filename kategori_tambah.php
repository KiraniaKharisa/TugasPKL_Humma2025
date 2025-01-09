<?php
    require_once("layout/atas.php");
?>
<h3>Data Tambah Kategori</h3>
<form action="/submit-category" method="post">
    <label for="namaKategori">Nama Kategori</label>
    <input type="text" name="namaKategori" id="namaKategori" placeholder="Masukkan Nama Kategori" required>

    <button type="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>