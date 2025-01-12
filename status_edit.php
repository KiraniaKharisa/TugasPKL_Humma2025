<?php

    require_once("base/function.php");

    $id = $_GET["id"];
    $data = dataQuery("SELECT * FROM status WHERE id_status = $id");

    if(isset($_POST["submit"])) {
        $data = [
            "status_nama" => $_POST["nama"],  
          ];
  
          if(editData("status", "id_status = $id", $data)) {
              echo "<script> alert('Data Berhasil Diedit') 
                  window.location.href = 'status.php';
              </script>";
              exit;
          } else {
              echo "<script> alert('Data Gagal Diedit') </script>";
          }
    }


    require_once("layout/atas.php");
?>
<h3>Tambah Data Status</h3>
<form action="" method="post">
            <label for="nama">Nama Status</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan Nama" required value="<?= cekValue($data[0]['status_nama']) ?>" >

            <button type="submit" class="btn-submit" name="submit">Edit Data</button>
        </form>
<?php
    require_once("layout/bawah.php");
?>