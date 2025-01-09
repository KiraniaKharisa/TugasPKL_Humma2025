<?php
    require_once("layout/atas.php");
?>
<h3>Halaman Data Role</h3>
<a href="" class="btn btn-tambah">Tambah Data</a>
<form action="/submit-role" method="post">
    <label for="namaRole">Nama Role</label>
    <input type="text" name="namaRole" id="namaRole" placeholder="Masukkan Nama Role" required>

    <button type="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>