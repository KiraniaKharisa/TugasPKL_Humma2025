<?php

    require_once("base/function.php");

    if(isset($_POST["submit"])) {
        $nama = $_POST["nama"];

        $query = "INSERT INTO status (status_nama) VALUES ('$nama')";
        mysqli_query($koneksi, $query);

        if(mysqli_affected_rows($koneksi) > 0) {
            echo "<script> alert('Data Berhasil Ditambahkan') 
                window.location.href = 'status.php';
            </script>";
            exit;
        } else {
            echo "<script> alert('Data Gagal Ditambahkan') </script>";
        }
    }


    require_once("layout/atas.php");
?>
<h3>Tambah Data Status</h3>
<form action="" method="post">
            <label for="nama">Nama Status</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan Nama" required>

            <button type="submit" class="btn-submit" name="submit">Tambah Data</button>
        </form>
<?php
    require_once("layout/bawah.php");
?>