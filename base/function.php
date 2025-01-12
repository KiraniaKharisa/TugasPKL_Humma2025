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
        throw new Exception("Gagal Prepare Statement ". mysqli_error($koneksi));
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
<<<<<<< HEAD
    
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
=======

    // Eksekusi query
    mysqli_query($koneksi, $query);
    if (mysqli_affected_rows($koneksi)) {
        return true;
    } else {
>>>>>>> 2991aac5dec7e877eecedac829850d44627d3872
        return false;
    }
}

function cekValue($value) {
    return (isset($value) ? $value : '');
}

<<<<<<< HEAD
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

=======
>>>>>>> 2991aac5dec7e877eecedac829850d44627d3872

?>