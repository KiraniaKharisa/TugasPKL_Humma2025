<?php
session_start();
if(isset($_SESSION["login"]))
{
  header("Location: dashboard.php");
  exit();
}
require_once("base/function.php");
if(isset($_POST['register'])) {
    if($_POST["password"] === $_POST["konfirpassword"]) {
        $password =  password_hash($_POST["password"], PASSWORD_DEFAULT);
        $data = [
            "nama_user" => htmlspecialchars($_POST["nama"]),  
            "username" => htmlspecialchars($_POST["username"]),  
            "email" => htmlspecialchars($_POST["email"]),  
            "password" => $password,  
            "jenis_kelamin" => htmlspecialchars($_POST["gender"]),  
            "role_id" => 2,  
        ];

        $cekUnikUsername = tambahCekUnique('user', 'username', $data['username']);
        $cekUnikEmail = tambahCekUnique('user', 'email', $data['email']);

        if($cekUnikUsername['status']) {
            if($cekUnikEmail['status']) {
                if(createData("user", $data)) {
                    echo "<script> alert('Registrasi Berhasil Silahkan Login') 
                        window.location.href = 'login.php';
                    </script>";
                    exit;
                } else {
                    echo "<script> alert('Registrasi Gagal') </script>";
                }

            } else {
                $pesan = $cekUnikEmail['pesan'];
                echo "<script> alert(`$pesan`) </script>";
            }
            
        } else {
            $pesan = $cekUnikUsername['pesan'];
            echo "<script> alert(`$pesan`) </script>";
        }
      
          
    } else {
        echo "<script> alert('Password Tidak Cocok') </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/auth.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Register Page</title>
</head>
<body>
    <div class="container">
        <div class="gambar">
            <img src="img/login.svg" alt="">
        </div>
        <div class="login">
            <h3>WELCOME TO LIBRARY</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, ex.</p>
            <form action="" method="post">
                <input type="text" name="nama" placeholder="Nama">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="email" placeholder="Email">
                <select name="gender" id="gender" required>
                    <option value="Laki-Laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="konfirpassword" placeholder="Konfirmasi Password">
                <button type="submit" name="register">Register</button>
            </form>
            <p>Have Account? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</body>
</html>