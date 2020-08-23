<?php 
    
    include("koneksi.php");
    session_start();

    if (!isset($_SESSION['akun']['no_hp']) && !isset($_SESSION['akun']['password'])) {
        header("location: index.php");
    }
    else{

        switch ($_SESSION['akun']['status']) {
            case 1:
                $levelstatus = "Admin";
                break;
            case 2:
                $levelstatus = "Member";
                break;
            case 3:
                $levelstatus = "Non Member";
                break;
            default:
                $levelstatus = "Siapa Anda ?";
                break;
        }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Counter Pulsa | Dashboard</title>
    
    <?php include("css.php"); ?>

</head>

<body class="theme-light-blue" id="body">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <div class="overlay-input" id="overlay-password">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Validasi Akun
                        <small>User</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="bataltambah" onclick="batalTambah()">
                                <i class="material-icons">clear</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line form-line-password">
                                    <input type="password" id="passwordValidasi" class="form-control">
                                    <label class="form-label">Masukkan Password Untuk Validasi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">

                            </div>
                            <div class="col-xs-3">
                                <button id="Validasi" type="button" class="tombol-submit btn btn-block bg-light-blue waves-effect">Validasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay-input" id="overlay-pp">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Ganti Foto
                        <small>Profile User</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="bataltambah" onclick="batalTambah()">
                                <i class="material-icons">clear</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form id="submit_form" action="ajax/ajax_akun.php" method="post">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line form-line-password">
                                    <label>Pilih gambar (.jpg / .jpeg / .png / .gif)</label>
                                    <input type="file" name="file" id="image_file" / style="margin-bottom: 30px;">
                                    <input type="hidden" name="type" id="type" value="pp"/>
                                    <input type="hidden" name="gambar" value="<?php echo $_SESSION['akun']['pp']; ?>"/>
                                    <p style="font-size: 13px;">Note : Disarankan menggunakan gambar yang kotak (tidak berbentuk persegi panjang).<br>
                                    Silahkan crop gambar apabila tidak kotak, dengan tools bawaan gadget anda atau menggunakan tools online : <a href="https://imageresize.org/" target="_blank">imageresize.org</a>
                                    </p>
                                    <!-- <p></p> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">

                            </div>
                            <div class="col-xs-3">
                                <!-- <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" /> -->
                                <button type="submit" name="upload_button" class="tombol-submit btn btn-block bg-light-blue waves-effect">Upload</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include("navigation.php"); ?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Halaman Akun</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card right-layout">
                        <div class="sampul-akun">
                            <img src="images/flatblack.jpg" class="sampul">
                            <div class="photo-profile">
                                <div class="photo-profile-frame">
                                    <img src="images/<?php echo $_SESSION['akun']['pp']; ?>">
                                </div>
                                <div class="edit-pp" data-toggle='tooltip' data-placement='bottom' title='Ganti Foto Profile'>
                                    <a onclick='editPP()' id='editPP'><i class='material-icons md-18' style="color: white; font-size: 30px; display: block;">mode_edit</i></a>
                                </div>
                            </div>
                        </div>
                        <div class="profile">
                            <p class="profile-name"><?php echo $_SESSION['akun']['nama_lengkap']; ?></p>
                            <p class="profile-type"><?php echo $levelstatus; ?> Counter-Pulsa</p>
                        </div>
                    </div>

                    <div class="card left-layout">
                        <div class="header">
                            <h2>
                                Profile <?php echo $_SESSION['akun']['nama_lengkap']; ?>
                                <small>Detail Profile</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <form id="form-data">
                                    <div class='col-sm-12'>
                                        <div class='form-group form-float'>
                                            <div class='form-line'>
                                                <input type='text' id='no_ktp' class='form-control' value='<?php echo $_SESSION['akun']['no_ktp']; ?>' disabled>
                                                <label class='form-label'>Nomor KTP</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-12'>
                                        <div class='form-group form-float'>
                                            <div class='form-line'>
                                                <input type='text' id='nama_lengkap' class='form-control' value='<?php echo $_SESSION['akun']['nama_lengkap']; ?>' disabled>
                                                <label class='form-label'>Nama Lengkap</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-12'>
                                        <div class='form-group form-float'>
                                            <div class='form-line'>
                                                <input type='text' id='email' class='form-control' value='<?php echo $_SESSION['akun']['email']; ?>' disabled>
                                                <label class='form-label'>Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-12'>
                                        <div class='form-group form-float'>
                                            <div class='form-line'>
                                                <input type='text' id='no_hp' class='form-control' value='<?php echo $_SESSION['akun']['no_hp']; ?>' disabled>
                                                <label class='form-label'>Nomor Handphone</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-12'>
                                        <div class='form-group form-float'>
                                            <div class='form-line'>
                                                <input type='text' id='alamat' class='form-control' value='<?php echo $_SESSION['akun']['alamat']; ?>' disabled>
                                                <label class='form-label'>Alamat</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-12' id="levelValue">
                                        <div class='form-group form-float'>
                                            <div class='form-line'>
                                                <input type='text' id='level' class='form-control' value='<?php echo $levelstatus; ?>' disabled>
                                                <label class='form-label'>Level</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-sm-12' id="passwordValue">
                                        <div class='form-group form-float'>
                                            <div class='form-line'>
                                                <input type='password' id='password' class='form-control' value="<?php echo $_SESSION['akun']['password']; ?>" disabled>
                                                <label class='form-label'>Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-xs-8'>

                                        </div>
                                        <div class='col-xs-3'>
                                            <button onclick='validasiEdit()' id="edit-profile-satu" type='button' class='tombol-submit btn btn-block bg-light-blue waves-effect'>Edit Profile</button>
                                            <button onclick='editData()' id="edit-profile-dua" type='button' class='tombol-submit btn btn-block bg-light-blue waves-effect'>Edit Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/pages/ui/tooltips-popovers.js"></script>
    <script src="js/pages/ui/dialogs.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <script>
        function batalTambah() {
            $("#overlay-password").css({ "opacity" : "0", "z-index" : "-1", "transition" : "all 0.2s" });
            $("#overlay-pp").css({ "opacity" : "0", "z-index" : "-1", "transition" : "all 0.2s" });
            $("#body").css({ "overflow" : "auto" });
        }
        function validasiEdit() {
            if ($('.form-line-password').hasClass('focused')) {
                $('.form-line-password').removeClass('focused');
            }
            $("#passwordValidasi").val('');
            $("#body").css({ "overflow" : "hidden" });
            $("#overlay-password").css({ "opacity" : "1", "z-index" : "10", "transition" : "all 0.5s" });
        }

        function editData() {
            var no_ktp      = $('#no_ktp').val();
            var nama_lengkap= $('#nama_lengkap').val();
            var email       = $('#email').val();
            var no_hp       = $('#no_hp').val();
            var alamat      = $('#alamat').val();
            var password    = $('#password').val();

            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_akun.php",
                data    : { type        : "update",
                            no_ktp      : no_ktp,
                            nama_lengkap: nama_lengkap,
                            email       : email,
                            no_hp       : no_hp,
                            alamat      : alamat,
                            password    : password },
                success : function(data){
                    console.log(data);
                    batalTambah();
                    swal({
                        title: "Data akun berhasil di update",
                        text: "Anda akan Log-Out, silahkan Log-In kembali",
                        timer: 3000,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        window.location.href = "http://counterpulsa.xyz/eins/logout.php";
                    }, 3000);
                }
            });
        }

        $("#Validasi").click(function(){
            var password = $('#passwordValidasi').val();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_akun.php",
                data    : { type        : "Validasi",
                            password    : password },
                success : function(data){
                    if (data == "true") {
                        batalTambah();
                        $("#passwordValidasi").val('');
                        if ($('.form-line-password').hasClass('focused')) {
                            $('.form-line-password').removeClass('focused');
                        }
                        $("#passwordValue").css({ "display" : "block" });
                        $("#edit-profile-satu").css({ "display" : "none" });
                        $("#edit-profile-dua").css({ "display" : "block" });
                        $("#levelValue").css({ "display" : "none" });

                        $("#no_ktp").prop("disabled", false);
                        $("#nama_lengkap").prop("disabled", false);
                        $("#email").prop("disabled", false);
                        $("#no_hp").prop("disabled", false);
                        $("#alamat").prop("disabled", false);
                        $("#password").prop("disabled", false);
                    }else{
                        batalTambah();
                        $("#passwordValidasi").val('');
                        if ($('.form-line-password').hasClass('focused')) {
                            $('.form-line-password').removeClass('focused');
                        }
                        alert("Password Salah");
                    }
                }
            });
        });

        function editPP(){
            $("#body").css({ "overflow" : "hidden" });
            $("#overlay-pp").css({ "opacity" : "1", "z-index" : "10", "transition" : "all 0.5s" });
        }

        $('#submit_form').on('submit', function(e){  
            e.preventDefault();
            var image_file = $('#image_file').val();
            if(image_file == ''){
                alert("Pilih gambar terlebih dahulu");
                return false;
            }else{
                var extension = $('#image_file').val().split('.').pop().toLowerCase();
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
                    alert("Maaf, bukan file gambar");
                    $('#image_file').val('');
                    return false;
                }else{
                    $.ajax({  
                        url         :"ajax/ajax_akun.php",  
                        method      :"POST",  
                        data        :new FormData(this),  
                        contentType :false,  
                        processData :false,  
                        success     :function(data){
                            if (data == "berhasil") {
                                swal({
                                    title: "Gambar berhasil diubah",
                                    text: "Halaman akan dimuat ulang...",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }else{
                                alert("Gagal mengubah gambar, silahkan coba sesaat lagi");
                            }
                        }  
                    })
                }
            }            
        });
        
    </script>

</body>

</html>
<?php
    }
?>