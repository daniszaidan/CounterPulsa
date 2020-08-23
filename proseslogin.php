<?php

    include("koneksi.php");
    if (isset($_POST['submit'])) {

        $no_hp = $_POST['no_hp'];
        $password = $_POST['password'];

        $login  = mysqli_query($connect, "SELECT * FROM user WHERE no_hp = '$no_hp' AND password='$password'");
        $row    = mysqli_fetch_array($login);

        if ($row != null AND $row['no_hp'] == $no_hp AND $row['password'] == $password){
          session_start();

          $_SESSION['akun'] = $row;
          header("location:dashboard.php");
        }
        else{
            // echo '  <script type="text/javascript">
            //         window.location = "http://counterpulsa.xyz/backup/";
            //         alert("password salah");
            //     <script>';
            header("location:index.php");
        }
        
    }
    else{
        // echo '  <script type="text/javascript">
        //             window.location = "http://counterpulsa.xyz/backup/";
        //         <script>';
        header("location:index.php");
    }

?>