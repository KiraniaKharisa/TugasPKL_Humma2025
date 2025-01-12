<?php
session_start();
if(isset($_SESSION["login"]))
{
  header("Location: dashboard.php");
  exit();
}
require_once("base/function.php");
    if(isset($_POST['login'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $result =  mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
        $data = dataQuery("SELECT * FROM user WHERE username = '$username'");

        // Cek Username 
        if( mysqli_num_rows($result) === 1 )
        {
            // Cek Pass 
            $row = mysqli_fetch_assoc($result);
            if( password_verify($password, $row["password"]) ) 
            {
                $_SESSION["user_id"] = $data[0]['id_user'];
                $_SESSION["login"] = true;
                echo "<script> alert('Login Berhasil') 
                    window.location.href = 'dashboard.php';
                </script>";
                exit();
            } else {
                echo "<script> alert('Login Gagal Data Tidak Diketahui') 
                </script>";

            }
        } else {
            echo "<script> alert('Login Gagal Data Tidak Diketahui') 
                </script>";
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
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="login">
            <h3>WELCOME TO LIBRARY</h3>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, ex.</p>
            <form action="" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="login">Login</button>
            </form>
            <p>Don't Have Account? <a href="register.php">Register Here</a></p>
        </div>
        <div class="gambar">
            <img src="img/login.svg" alt="">
        </div>
    </div>
</body>
</html>