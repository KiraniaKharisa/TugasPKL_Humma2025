<?php
session_start();
require_once("base/function.php");

$id = $_SESSION['user_id'];
$dataUser = dataQuery("SELECT * FROM user WHERE id_user = $id");

if(isset($_POST["submit"])) {
    $passwordUser = $dataUser[0]['password'];
    $passwordLama = $_POST['passwordlama'];
    $passwordBaru = $_POST['passwordbaru'];
    $konfirmasiPassword = $_POST['passwordkonfirmasi'];
    
    if($passwordBaru == $konfirmasiPassword) {
        if(password_verify($passwordLama, $passwordUser)) {
            $passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);

            $data = [
                "password" => $passwordBaru
            ];

            if(editData("user", "id_user = $id", $data)) {
                echo "<script> alert('Data Successfully Edited') 
                    window.location.href = 'update_password.php';
                </script>";
                exit;
            } else {
                echo "<script> alert('Data Failed to Edit') </script>";
            }

        } else {
            echo "<script> alert('Old Password Does Not Match') 
                    </script>";
            
        }
    } else {
        echo "<script> alert('New Password Doesn't Match Confirmation') 
                </script>";
    }
}
    require_once("layout/atas.php");
?>
<h3>Edit Password</h3>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="hapusProfile" id="hapusProfile" value="false">

    <label for="passwordlama">Old Password</label>
    <input type="password" name="passwordlama" id="passwordlama" placeholder="Enter Old Password" required">

    <label for="passwordbaru">New Password</label>
    <input type="password" name="passwordbaru" id="passwordbaru" placeholder="Enter Name" required">

    <label for="passwordkonfirmasi">Konfirmasi Password</label>
    <input type="password" name="passwordkonfirmasi" id="passwordkonfirmasi" placeholder="Enter Confirm Password" required">

    <button type="submit" name="submit" class="btn-submit">Edit Password</button>
</form>
<?php
    require_once("layout/bawah.php");
?>