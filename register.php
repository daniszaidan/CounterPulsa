<?php 
    
    include("koneksi.php");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up | Bootstrap Based Admin Template - Material Design</title>
    
    <?php include("css.php"); ?>

</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Counter-<b>Pulsa</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST" action="">
                    <div class="msg">Register Akun Baru</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="no_ktp" placeholder="Nomer KTP" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap (Sesuai KTP)" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="number" class="form-control" name="no_hp" placeholder="Nomer Handphone" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="alamat" placeholder="alamat" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">Saya setuju dengan <a href="javascript:void(0);">ketentuan yang berlaku</a>.</label>
                    </div>

                    <button name="submit" class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Register</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="index.php">Sudah punya akun ? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php 

    if (isset($_POST['submit'])) {

        $no_ktp         = $_POST['no_ktp'];
        $nama_lengkap   = $_POST['nama_lengkap'];
        $email          = $_POST['email'];
        $no_hp          = $_POST['no_hp'];
        $alamat         = $_POST['alamat'];
        $password       = $_POST['password'];
        
        $query = mysqli_query($connect, "INSERT INTO `user` (`id_user`, `no_ktp`, `nama_lengkap`, `email`, `no_hp`, `alamat`, `password`, `status`) VALUES (null, '$no_ktp', '$nama_lengkap', '$email', '$no_hp', '$alamat', '$password', '2')");

        if($query){
            header("location: index.php");
        }
    }

    ?>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-up.js"></script>
    
    <script> 
        // alert("Maaf, fitur register sedang dinonaktifkan karena masih dalam tahap pengembangan. Silahkan hubungi Admin untuk selengkapnya");
    </script>
    
</body>

</html>