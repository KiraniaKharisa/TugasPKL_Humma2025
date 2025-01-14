<?php

$koneksi = mysqli_connect("localhost", "root", "", "perpus_rania"); 

// READ
function dataQuery($query) {
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query);
    $data = [];
    while($baris = mysqli_fetch_assoc($hasil)) {
        $data[] = $baris;
    }
    return $data;
}

// CREATE
function createData($table, $data) {
    global $koneksi;
    $kolom = implode(", ", array_keys($data)); // Memisahkan kunci atau key dari array data yang dikirimkan sesuai kolom dari data base jadinya akan seperti ini contoh yang dikirim kan itu array seperti ini 
    // ['nama_buku' => $nama_buku, 'kategori_buku' => 1]; maka akan jadi seperti ini nama_buku, kategori _buku jadi yang diambil cuman key nya saja untuk kolom di database


    $value = implode(", ", array_fill(0, count($data), '?')); 
    $query = "INSERT INTO $table ($kolom) VALUES ($value)";

    // siapkan statement 
    $statement = mysqli_prepare($koneksi, $query);
    if(!$statement) {
        throw new Exception("Gagal Prepare Statement ". mysqli_error($koneksi));
    } 

    $types = "";
    foreach($data as $key => $value) {
        if(is_int($value) || is_bool($value)) {
            $types .= "i";
        } else if(is_double($value)) {
            $types .= "d";           
        } else {
            $types .= "s";
        }
    }
    
    mysqli_stmt_bind_param($statement, $types, ...array_values($data));
    mysqli_stmt_execute($statement);
    if(mysqli_affected_rows($koneksi) > 0) {
        return true;
        mysqli_stmt_close();
    } else {
        return false;
        mysqli_stmt_close();
    }
}

// EDIT
function editData($table, $kondisi, $data) {
    global $koneksi;

    $types = "";
    $setKolom = [];
    $values = [];
    foreach($data as $key => $value) {
        $setKolom[] = "$key = ?";
        $values[] = $value;
        if(is_int($value) || is_bool($value)) {
            $types .= "i";
        } else if(is_double($value)) {
            $types .= "d";           
        } else {
            $types .= "s";
        }
    }
    
    $kolom = implode(", ", $setKolom);
    $query = "UPDATE $table SET $kolom WHERE $kondisi";

    // siapkan statement 
    $statement = mysqli_prepare($koneksi, $query);
    if(!$statement) {
        return throw new Exception("Gagal Prepare Statement ". mysqli_error($koneksi));
    } 
    
    mysqli_stmt_bind_param($statement, $types, ...array_values($data));
    mysqli_stmt_execute($statement);
    if(mysqli_affected_rows($koneksi) > 0) {
        return true;
        mysqli_stmt_close();
    } else {
        return false;
        mysqli_stmt_close();
    }
}

function deleteQuery($table, $kondisi) {
    global $koneksi;
    $query = "DELETE FROM $table WHERE $kondisi";
    
    try {
        // Eksekusi query
        if(!mysqli_query($koneksi, $query)) {
            throw new Exception("Error executing query: " . mysqli_error($koneksi));
        }
        if (mysqli_affected_rows($koneksi)) {
            return true;
        } else {
            return false;
        } 
    } catch(Exception $error) {
        return false;
    }
}

function cekValue($value) {
    return (isset($value) ? $value : '');
}

function cekInput($isi, $element) {
    // if($isi isset)
}

function cekRole($role_id, $role) {
    if($role_id != $role) {
        header("Location: dashboard.php");
        exit;
    }
}

function cekTanggal($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function validasiTanggalKembali($pinjamDate, $kembaliDate) {
    $pinjamDateTime = new DateTime($pinjamDate);
    $kembaliDateTime = new DateTime($kembaliDate);

    // Periksa apakah tanggal kembali >= tanggal pinjam
    return $kembaliDateTime > $pinjamDateTime;
}

function tambahCekUnique($table, $field, $input) {
    global $koneksi;

    // Cek apakah data sudah ada di database
    $query = "SELECT COUNT(*) as count FROM $table WHERE $field = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $input);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] > 0) {
        return [
            'status' => false,
            'pesan' => "Data '$input' sudah ada dan harus unique",
        ];
    } else {
        return [
            'status' => true,
            'pesan' => 'Data diterima',
        ];
    }
}

// Fungsi untuk mengedit data (tidak boleh mengubah nama yang sudah ada)
function editCekUnique($table, $field, $filedId, $idValue, $input) {
    global $koneksi;

    // Cek apakah ID yang diberikan ada
    $query = "SELECT COUNT(*) as count FROM $table WHERE $filedId = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $idValue);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Ambil hasil query sebagai array
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] == 0) {
        return [
            'status' => false,
            'pesan' => "Data dengan ID '$idValue' tidak ditemukan",
        ];
    }

    // Periksa apakah nama baru sudah ada di database
    $query = "SELECT COUNT(*) as count FROM $table WHERE $field = ? AND $filedId != ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "si", $input, $idValue);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Ambil hasil query sebagai array
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] > 0) {
        return [
            'status' => false,
            'pesan' => "Data '$input' sudah ada dan harus unique",
        ];
    } else {
        return [
            'status' => true,
            'pesan' => "Data diterima",
        ];
    }
}


function deleteQueryPinjaman($table, $idField, $id) {
    global $koneksi;
    $dataPinjaman = dataQuery("SELECT * FROM $table WHERE $idField = $id");
    $bukuId = $dataPinjaman[0]['buku_id'];
    $jumlahDipinjam = $dataPinjaman[0]['jumlah'];
    $dataBuku = dataQuery("SELECT * FROM buku WHERE id_buku = $bukuId");
    $data = [
        "stock" => $dataBuku[0]['stock'] + $jumlahDipinjam,
    ];
    
    if(editData("buku", "id_buku = $bukuId", $data)) {
        if(deleteQuery($table, "$idField = $id")) {
            return true;
        } else {
            return false;
        }
    } else {
       return false;
    }
    
}

function cariBuku($search = "", $kategori = "") {
    if($kategori != "" && $search != "") {
        $query = "SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori
        WHERE
          (nama_buku LIKE '%$search%' OR
          penulis LIKE '%$search%' OR
          penerbit LIKE '%$search%')
          AND category_id = '$kategori'";

    } else if($search == "" && $kategori != "") {
        $query = "SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori
        WHERE category_id = '$kategori'";

    } else if($search == "" && $kategori == "") {
        $query = "SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori";
    } else {
        $query = "SELECT * FROM buku INNER JOIN kategori_buku ON buku.category_id = kategori_buku.id_kategori
                  WHERE
                nama_buku LIKE '%$search%' OR
                penulis LIKE '%$search%' OR
                penerbit LIKE '%$search%'";
    }

    return $query;
}

function hapusImageLama($file) {
    if (file_exists($file)) {
        if (!unlink($file)) {
            return [
                "status" => false,
                "pesan" => "Gagal Hapus File Lama",
            ];
        } else {
            return [
                "status" => true,
                "pesan" => "Berhasil",
            ];
        }
    } else {
        return [
            "status" => false,
            "pesan" => "File lama tidak ditemukan",
        ];
    }
}

function uploudGambar($files, $pathSaveImage, $imageLama = false) {

    if($imageLama != false) {
        $file = $pathSaveImage . $imageLama;
        $hapusFileLama = hapusImageLama($file);
        if(!$hapusFileLama['status']) {
            return [
                "status" => false,
                "pesan" => $hapusFileLama['pesan'],
            ]; 
        }
    }

  $namaFile = $files['name'];
  $ukuranFile = $files['size'];
  $error = $files['error'];
  $tmpName = $files['tmp_name'];
  
  // Cekk Apakah Tidak Ada Gambar Yg Di Uploud
  if( $error === 4 )
  {
    return [
        "status" => false,
        "pesan" => "File tidak ada",
    ];
  }
  
  // Cek Apakah Yang DiUploud Adalah Gambar
  $ektensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ektensiGambar = explode('.', $namaFile);
  $ektensiGambar = strtolower(end($ektensiGambar));
  
  if( !in_array($ektensiGambar, $ektensiGambarValid) ) 
  {
    return [
        "status" => false,
        "pesan" => "Gambar harus berektenis jpg jpeg png",
    ];
  }
  
  // Cek Jika Ukurannya Terlalu Besar
  if( $ukuranFile > 3000000 )
  {
    return [
        "status" => false,
        "pesan" => "Gambar terlalu besar",
    ];
  }
  
  // Lolos Pengecekan, Gambar Siap Di Uploud
  
  // Generate Nama Gambar Baru 
  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $ektensiGambar;
  
  move_uploaded_file($tmpName, $pathSaveImage .$namaFileBaru);
  
  return [
    "status" => true,
    "pesan" => $namaFileBaru,
    ];
}


?>