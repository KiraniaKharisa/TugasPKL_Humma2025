<?php

    $koneksi = mysqli_connect("localhost", "root", "", "perpus_rania");

    $hasil = mysqli_query($koneksi, "SELECT * FROM user INNER JOIN user_role ON user.role_id = user_role.id ");
    $data = [];
    while($baris = mysqli_fetch_assoc($hasil)) {
        $data[] = $baris;
    }

    require_once("layout/atas.php");
?>
<h3>Tambah Data User</h3>
<form action="/submit-data" method="post">
    <label for="name">Nama</label>
    <input type="text" name="name" id="name" placeholder="Masukkan Nama" required>

    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="Masukkan Username" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Masukkan Email" required>

    <label for="gender">Jenis Kelamin</label>
    <select name="gender" id="gender" required>
        <option value="male">Laki-laki</option>
        <option value="female">Perempuan</option>
    </select>

    <label for="role">Role</label>
    <select name="role" id="role" required>
        <option value="admin">Admin</option>
        <option value="user">User</option>
        <option value="editor">Editor</option>
    </select>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Masukkan Password" required>

    <button type="submit" class="btn-submit">Tambah Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>