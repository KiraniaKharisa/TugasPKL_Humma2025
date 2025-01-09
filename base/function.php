<?php

$koneksi = mysqli_connect("localhost", "root", "", "perpus_rania"); 

function dataQuery($query) {
    global $koneksi;
    $hasil = mysqli_query($koneksi, $query);
    $data = [];
    while($baris = mysqli_fetch_assoc($hasil)) {
        $data[] = $baris;
    }
    return $data;
}

function executeQuery($query) {
    global $koneksi;
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

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
        // Eksekusi statement
    if (mysqli_stmt_execute($statement)) {
        // Tutup statement
        mysqli_stmt_close($statement);

        // Kembalikan ID terakhir jika berhasil
        return mysqli_insert_id($koneksi);
    } else {
        // Tangani kesalahan jika eksekusi gagal
        $error = mysqli_stmt_error($statement);
        mysqli_stmt_close($statement);
        throw new Exception("Gagal Eksekusi Query: " . $error);
    }
}
?>