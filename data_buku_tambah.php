<?php
    require_once("layout/atas.php");
?>
<h3>Halaman Data Buku</h3>
<a href="" class="btn btn-tambah">Tambah Data</a>
<form action="/submit-data" method="post">
    <label for="namaBuku">Nama Buku</label>
    <input type="text" name="namaBuku" id="namaBuku" placeholder="Masukkan Nama Buku" required>

    <label for="isiBuku">Isi</label>
    <input type="text" name="isiBuku" id="isiBuku" placeholder="Masukkan Isi Buku" required>

    <label for="stock">Stock</label>
    <select name="stock" id="stock" required>
    </select>

    <label for="penulis">Penulis</label>
    <input type="text" name="penulis" id="penulis" placeholder="Masukkan Nama Penulis" required>

    <label for="penerbit">Penerbit</label>
    <input type="text" name="penerbit" id="penerbit" placeholder="Masukkan Nama Penerbit" required>

    <label for="kategori">Kategori</label>
    <select name="kategori" id="kategori" required>
        <option value="">Pilih Kategori</option>
        <option value="fiksi">Fiksi</option>
        <option value="non-fiksi">Non-Fiksi</option>
        <option value="pendidikan">Pendidikan</option>
        <option value="teknologi">Teknologi</option>
    </select>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Masukkan Password" required>

    <button type="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?> 

