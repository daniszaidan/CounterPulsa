<?php 

    include("../koneksi.php");
    session_start();

    if ($_POST['type'] == 'Validasi') {

        $no_hp = $_SESSION['akun']['no_hp'];
        $password = $_POST['password'];
 
        $login  = mysqli_query($connect, "SELECT * FROM user WHERE no_hp = '$no_hp' AND password='$password'");
        $row    = mysqli_fetch_array($login);

        if ($row != null AND $row['no_hp'] == $no_hp AND $row['password'] == $password){
            echo "true";
        }else{
            echo "false";
        }

    }
    if ($_POST['type'] == 'update'){
        $id_user     = $_SESSION['akun']['id_user'];
        $no_ktp      = $_POST['no_ktp'];
        $nama_lengkap= $_POST['nama_lengkap'];
        $email       = $_POST['email'];
        $no_hp       = $_POST['no_hp'];
        $alamat      = $_POST['alamat'];
        $password    = $_POST['password'];

        $query = mysqli_query($connect, "UPDATE `user` SET 
                id_user     = '$id_user',
                no_ktp      = '$no_ktp',
                nama_lengkap= '$nama_lengkap',
                email       = '$email',
                no_hp       = '$no_hp',
                alamat      = '$alamat',
                password    = '$password'
                WHERE id_user = $id_user ");

        if ($query) {
            echo "BERHASIL UPDATE DATA USER";
        }
        else{
            echo "GAGAL UPDATE DATA USER";
        }
    }
    if ($_POST['type'] == 'delete'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "DELETE FROM `user` where id_user='$id'");

        if ($query) {
            echo "BERHASIL DELETE DATA TRANSAKSI";
        }
        else{
            echo "GAGAL DELETE DATA TRANSAKSI";
        }
    }
    if ($_POST["type"] == "pp"){

        $id_user    = $_SESSION['akun']['id_user'];
        $currentPP  = $_POST["gambar"];

        if ($currentPP == "pp_cp.png") {
            // echo 'gambarnya itu pp_cp';
            $new_name = $_SESSION['akun']['nama_lengkap'] . "-" . rand(0, 99999) . "-" . $_FILES['file']['name'];  
            $path = "../images/" . $new_name;

            $query = mysqli_query($connect, "UPDATE `user` SET `pp` = '$new_name' WHERE `id_user` = '$id_user'");
            move_uploaded_file($_FILES['file']['tmp_name'], $path);

            $_SESSION['akun']['pp']= $new_name;

            if ($query) {
              echo 'berhasil';
            }else{
              echo 'gagal';
            }

        }else{
            // echo 'gambarnya bukan pp_cp';
            $query  = mysqli_query($connect, "SELECT `pp` FROM user WHERE `id_user` = '$id_user'");
            $data   = mysqli_fetch_row($query);
            $currentPP     = $data[0];
            $currentPath   = "../images/" . $currentPP;
            $deleteImage = unlink($currentPath);

            $new_name = $_SESSION['akun']['nama_lengkap'] . "-" . rand(0, 99999) . "-" . $_FILES['file']['name'];
            $path = "../images/" . $new_name;

            $query = mysqli_query($connect, "UPDATE `user` SET `pp` = '$new_name' WHERE `id_user` = '$id_user'");
            move_uploaded_file($_FILES['file']['tmp_name'], $path);

            $_SESSION['akun']['pp']= $new_name;

            if ($query) {
              echo 'berhasil';
            }else{
              echo 'gagal';
            }
        }
    }
    

?>