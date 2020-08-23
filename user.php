<?php 
    
    include("koneksi.php");
    session_start();

    if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
        header("location: index.php");
    }
    else{

        $username = $_SESSION['username'];

        $query = mysqli_query($connect, "select * from user where username='$username'");
        $data=mysqli_fetch_array($query);
        $nama       = $data[3];
        $username   = $data[4];
        $email      = $data[5];
        $level      = $data[6];

        switch ($level) {
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
    <div class="overlay-input" id="overlay-input" >
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah" id="overlay-input-form">
            <div class="card">
                <div class="header">
                    <h2>
                        Tambah Data
                        <small>Komplain</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="batalTambah" onclick="batalTambah()">
                                <i class="material-icons">clear</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form id="form-tambah">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="id_komplain" name="id_komplain" class="form-control">
                                    <label class="form-label">ID Komplain</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="id_user" name="id_user" class="form-control">
                                    <label class="form-label">ID User</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="subjek" name="subjek" class="form-control">
                                    <label class="form-label">Subjek</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="bukti" name="bukti" class="form-control">
                                    <label class="form-label">Bukti</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="4" id="deskripsi" name="deskripsi" class="form-control no-resize" placeholder="Deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">

                            </div>
                            <div class="col-xs-3">
                                <button id="submit" type="button" class="tombol-submit btn btn-block bg-light-blue waves-effect">Tambah</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay-input" id="overlay-edit">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah" style="margin-top: 100px;">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Data
                        <small>User</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="batalTambah" onclick="batalEdit()">
                                <i class="material-icons">clear</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form id="form-edit">
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Overlay For Sidebars -->
    
    <?php include("navigation.php"); ?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Halaman User</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Tabel User
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID User</th>
                                            <th>No KTP</th>
                                            <th>No Handphone</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID User</th>
                                            <th>No KTP</th>
                                            <th>No Handphone</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

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

        function removeFocus(){
            if ($('.form-line').hasClass('focused')) {
                $('.form-line').removeClass('focused');
            }
        }

        function resetForm(){
            $("#form-tambah")[0].reset();
        }

        function tambah() {
            removeFocus();
            $("#body").css({ "overflow" : "hidden" });
            $("#overlay-input").css({ "opacity" : "1", "z-index" : "10", "transition" : "all 0.5s" });
        }

        function batalTambah() {
            removeFocus();
            $("#overlay-input").css({ "opacity" : "0", "z-index" : "-1", "transition" : "all 0.2s" });
            $("#body").css({ "overflow" : "auto" });
            resetForm();
        }

        function batalEdit() {
            removeFocus();
            $("#overlay-edit").css({ "opacity" : "0", "z-index" : "-1", "transition" : "all 0.2s" });
            $("#body").css({ "overflow" : "auto" });
            resetForm();
        }

        function edit(id) {
            $("#body").css({ "overflow" : "hidden" });
            $("#overlay-edit").css({ "opacity" : "1", "z-index" : "10", "transition" : "all 0.5s" });

            var id = id;
            $('#form-edit').empty();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_user.php", 
                data    : { type    : "edit",
                            id      : id },
                success : function(data){
                    $('#form-edit').append(data);
                    $('.form-line').addClass('focused');
                }
            });
        }

        $("#submit").click(function(){
            var id_komplain = $('#id_komplain').val();
            var id_user     = $('#id_user').val();
            var subjek      = $('#subjek').val();
            var bukti       = $('#bukti').val();
            var deskripsi   = $('#deskripsi').val();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_user.php",
                data    : { type        : "insert",
                            id_komplain : id_komplain,
                            id_user     : id_user,
                            subjek      : subjek,
                            bukti       : bukti,
                            deskripsi   : deskripsi },
                success : function(data){
                    console.log(data);
                    batalTambah();
                    resetForm();
                    removeFocus();
                    loadData();
                }
            });
        });

        function update(){
            var id_user     = $('#id_user-edit').val();
            var no_ktp      = $('#no_ktp-edit').val();
            var no_hp       = $('#no_hp-edit').val();
            var nama        = $('#nama-edit').val();
            var username    = $('#username-edit').val();
            var email       = $('#email-edit').val();
            var level       = $('#level-edit').val();
            var password    = $('#password-edit').val();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_user.php",
                data    : { type        : "update",
                            id_user     : id_user,
                            no_ktp      : no_ktp,
                            no_hp       : no_hp,
                            nama        : nama,
                            username    : username,
                            email       : email,
                            level       : level,
                            password    : password },
                success : function(data){
                    console.log(data);
                    batalEdit();
                    loadData();
                }
            });
        };

        loadData();
        function loadData(){
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_user.php",
                data    : { type : "view" },
                success : function(data){
                    $('#tbody').empty();
                    $('#tbody').append(data);
                }
            });
        }

        function hapus(id) {
            var id = id;
            swal({
                title: "Hapus data ini?",
                text: "Setelah dihapus, data tidak bisa dikembalikan",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Hapus",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    method  : "POST",
                    url     : "ajax/ajax_user.php", 
                    data    : { type    : "delete",
                                id      : id },
                    success : function(data){
                        console.log(data);
                        loadData();
                    }
                });
                swal("Berhasil!", "Data telah dihapus", "success");
                setTimeout(function () {
                    swal.close();
                }, 1300);
            });
            
        }

        $(".bars").click(function(){
            $(".bars").toggleClass("bars-open");
            $(".navbar-brand").css({"z-index" : "99"});
        });

    </script>


    
</body>
</html>
<?php
    }
?>