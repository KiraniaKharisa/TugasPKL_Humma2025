<?php

require_once("base/function.php");

if(!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$data_user = dataQuery("SELECT * FROM user");
$data_buku = dataQUery("SELECT * FROM buku");
$data_pinjam = dataQUery("SELECT * FROM data_pinjam WHERE id_pinjam = {$_GET['id']}");
$ubahJumlah = false;
$tanggalSekarang = date('Y-m-d');

// Ketika tombol submit/tambah data di klik 
if(isset($_POST["submit"])) {
    // cek apakah yang dimaksukkan tanggal apa tidak
    if(cekTanggal($_POST["tanggal_pinjam"]) && cekTanggal($_POST["tanggal_kembali"])) {
        // Cek apakah tanggal kembali lebih kecil atau kurang dari tanggal pinjam
        if(validasiTanggalKembali($_POST["tanggal_pinjam"], $_POST["tanggal_kembali"])) {
            // Cek Apakah yang dimasukkan kurang dari Tanggal sekarang
            if($_POST["tanggal_pinjam"] < $tanggalSekarang) {
                $dataBuku_byid = dataQuery("SELECT * FROM buku WHERE id_buku = {$_POST['buku']}");
                $dataPeminjaman_buku = ($dataBuku_byid[0]["jumlah_peminjaman"] == NULL ? 0 : $dataBuku_byid[0]["jumlah_peminjaman"]);
                $stockBuku = $dataBuku_byid[0]["stock"];
                
                // Cek Apakah Ia Mengganti Jumlah Peminjamannya, Jika Ia Setting Untuk Stock Nya Ditambah data yang dulu, dan untuk jumlah peminjamannya dikurangi, jika pengeditan gagal maka akan disetting lagi seperti awal
                if($_POST['jumlah_pinjam'] != $data_pinjam[0]['jumlah']) {
                    $dataBuku = [
                        "jumlah_peminjaman" => $dataPeminjaman_buku - $data_pinjam[0]['jumlah'],
                        "stock" => $stockBuku + $data_pinjam[0]['jumlah'],
                    ];
                    
                    $editData = editData("buku", "id_buku = {$_POST['buku']}", $dataBuku);
                    $ubahJumlah = true;
                    $dataBuku_byid = dataQuery("SELECT * FROM buku WHERE id_buku = {$_POST['buku']}");
                    $dataPeminjaman_buku = ($dataBuku_byid[0]["jumlah_peminjaman"] == NULL ? 0 : $dataBuku_byid[0]["jumlah_peminjaman"]);
                    $stockBuku = $dataBuku_byid[0]["stock"];
                }
    
    
                // Cek apakah yang dipinjam tidak melebihi dari stock
                if($_POST["jumlah_pinjam"] <= $dataBuku_byid[0]['stock']) {
                    $data = [
                      "user_id" => $_POST["user"], 
                      "buku_id" => $_POST["buku"],
                      "jumlah" => $_POST["jumlah_pinjam"],
                      "tanggal_pinjam" => $_POST["tanggal_pinjam"], 
                      "tanggal_kembali" => $_POST["tanggal_kembali"]
                    ];
                
                    if(editData("data_pinjam", "id_pinjam = {$_GET['id']}", $data)) {  
                        $dataBuku = [
                            "jumlah_peminjaman" => $dataPeminjaman_buku + $_POST['jumlah_pinjam'],
                            "stock" => $stockBuku - $_POST["jumlah_pinjam"],
                        ];
                        
                        if(editData("buku", "id_buku = {$_POST['buku']}", $dataBuku)) {
                            echo "<script> alert('Data Edited Successfully') 
                            window.location.href = 'data_pinjam.php';
                            </script>";
                            exit;
                        } else {
                            // Jika Ia Mengganti jumlah tapi gagal menambahkan maka kembalikan data nya seperti semula
                            if($ubahJumlah) {
                                $dataBuku = [
                                    "jumlah_peminjaman" => $dataPeminjaman_buku,
                                    "stock" => $stockBuku,
                                ];
                
                                editData("buku", "id_buku = {$_POST['buku']}", $dataBuku);
                                $ubahJumlah = true;
                            }
    
                            echo "<script> alert('Book Data Failed to Be Edited') </script>";
                        }
                    } else {
                        // Jika Ia Mengganti jumlah tapi gagal menambahkan maka kembalikan data nya seperti semula
                        if($ubahJumlah) {
                            $dataBuku = [
                                "jumlah_peminjaman" => $dataPeminjaman_buku,
                                "stock" => $stockBuku,
                            ];
            
                            editData("buku", "id_buku = {$_POST['buku']}", $dataBuku);
                        }
    
                        echo "<script> alert('Data Failed to Edit') </script>";
                    }
                } else {
    
                    // Jika Ia Mengganti jumlah tapi gagal menambahkan maka kembalikan data nya seperti semula
                    if($ubahJumlah) {
                        $dataBuku = [
                            "jumlah_peminjaman" => $dataPeminjaman_buku,
                            "stock" => $stockBuku,
                        ];
        
                        editData("buku", "id_buku = {$_POST['buku']}", $dataBuku);
                    }
    
                    $stock = $dataBuku_byid[0]["stock"];
                    echo "<script> alert(`The Amount You Borrow Exceeds Stock, Our Stock Remains $stock`) </script>";
                }
            } else {
                echo "<script> alert('The Return date Cannot Be Less Than The Current Date') </script>";
            }
            
        } else {
            echo "<script> alert('Return Date Cannot Be Less Than The Borrowing Date') </script>";

        }
        
    } else {
        echo "<script> alert('Waht You Entered Is Not The Date According To The Format') </script>";
    }
}

    require_once("layout/atas.php");
    cekRole($user_login[0]['role_id'], '1');
?>
<h3>Edit Borrowed Data</h3>
<form action="" method="post">
    <label for="user">User Name</label>
    <select name="user" id="user" required>
        <?php foreach($data_user as $data) : ?>
            <option <?= ($data['id_user'] == $data_pinjam[0]['user_id'] ? 'selected' : '') ?> value="<?= $data['id_user']; ?>"><?= $data['nama_user']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="buku">Book Name</label>
    <select name="buku" id="buku" required>
        <?php foreach($data_buku as $data) : ?>
            <option <?= ($data['id_buku'] == $data_pinjam[0]['buku_id'] ? 'selected' : '') ?> value="<?= $data['id_buku']; ?>"><?= $data['nama_buku']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="jumlah_pinjam">Total Borrowing</label>
    <input type="number" min="1" step="1" name="jumlah_pinjam" id="jumlah_pinjam" placeholder="Masukkan Jumlah Peminjaman" required value="<?= cekValue($data_pinjam[0]['jumlah']) ?>">
    
    <label for="tanggal_pinjam">Borrowing Date</label>
    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" placeholder="Masukkan Tanggal Peminjaman" required value="<?= cekValue($data_pinjam[0]['tanggal_pinjam']) ?>">
    
    <label for="tanggal_kembali">Return date</label>
    <input type="date" name="tanggal_kembali" id="tanggal_kembali" placeholder="Masukkan Tanggal Kembali" required value="<?= cekValue($data_pinjam[0]['tanggal_kembali']) ?>">

    <button type="submit" name="submit" class="btn-submit">Edit Data</button>
</form>
<?php
    require_once("layout/bawah.php");
?>