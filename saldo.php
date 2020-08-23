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

        if($user = $_SESSION['akun']['id_user'] != 2){
            $value = 'value="50000"';
        }else{
            $value = '';
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
    <!-- <div class="overlay-input" id="overlay-input">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Tambah Data
                        <small>Saldo</small>
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
                        <form id="form-tambah">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="id_saldo" name="id_komplain" class="form-control">
                                    <label class="form-label">ID Saldo</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="id_user" name="id_user" class="form-control">
                                    <label class="form-label">ID User</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="saldo_sekarang" name="subject" class="form-control">
                                    <label class="form-label">Saldo Sekarang</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="saldo_keluar" name="bukti" class="form-control">
                                    <label class="form-label">Saldo Keluar</label>
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
    </div> -->
    <div class="overlay-input" id="overlay-input">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Tambah Data
                        <small>Saldo</small>
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
                        <form id="form-tambah">
                        <div class="col-sm-12">
                            <div class="form-group form-float">
                                <div class="form-line focused">
                                    <input type="number" id="saldo" name="saldo" class="form-control" <?php echo $value; ?>>
                                    <label class="form-label">Masukkan Nominal Saldo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">

                            </div>
                            <div class="col-xs-3">
                                <button name="submit-saldo" id="submit" type="button" class="tombol-submit btn btn-block bg-light-blue waves-effect">Tambah</button>
                            </div>
                        </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay-input" id="overlay-edit">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Saldo
                        <small>Tabel Saldo</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="bataltambah" onclick="batalEdit()">
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
      <div class="overlay-input" id="overlay-editPesanSaldo">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Transaksi
                        <small>Tabel Transaksi</small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="bataltambah" onclick="batalEditPesanSaldo()">
                                <i class="material-icons">clear</i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form id="form-editPesanSaldo">
                        
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
                <h2>Halaman Saldo</h2>
            </div>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <!-- <button type="button" class="btn bg-light-blue waves-effect tombol-kanan" onclick="tambah()">Tambah Saldo</button> -->
                            <!-- <button type="button" class="btn bg-light-blue waves-effect tombol-kanan" onclick="tambah()">Tambah Saldo</button>
                            <h2> -->
                                Tabel Saldo
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
                                            <th>Saldo Sekarang</th>
                                            <th>Saldo Keluar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID User</th>
                                            <th>Saldo Sekarang</th>
                                            <th>Saldo Keluar</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody">
                                        <tr>
                                            <td>Anda Sedang Offline, fitur ini muncul saat anda sedang online</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            
            <?php if($user = $_SESSION['akun']['id_user'] == 1){ ?>
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <?php if($user = $_SESSION['akun']['id_user'] != 1){ ?>
                            <!-- <button type="button" class="btn bg-light-blue waves-effect tombol-kanan" onclick="tambah()">Request Saldo</button> -->
                            <?php } ?>
                            <h2>
                                Pesan Saldo
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
                                            <th>Nominal</th>
                                            <th>Harga</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <!--<th>Bukti Pembayaran</th>-->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID User</th>
                                            <th>Nominal</th>
                                            <th>Harga</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <!--<th>Bukti Pembayaran</th>-->
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody-pesansaldo">
                                        <tr>
                                            <td>Anda Sedang Offline, fitur ini muncul saat anda sedang online</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            
            <?php } ?>

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
            $('.form-line').addClass('focused');
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
        
        function batalEditPesanSaldo(){
            $("#overlay-editPesanSaldo").css({ "opacity" : "0", "z-index" : "-1", "transition" : "all 0.2s" });
            $("#form-editPesanSaldo")[0].reset();
        }

        function edit(id) {
            $("#body").css({ "overflow" : "hidden" });
            $("#overlay-edit").css({ "opacity" : "1", "z-index" : "10", "transition" : "all 0.5s" });

            var id = id;
            $('#form-edit').empty();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_saldo.php", 
                data    : { type    : "edit",
                            id      : id },
                success : function(data){
                    $('#form-edit').append(data);
                    $('.form-line').addClass('focused');
                }
            });
        }
        
        function editPesanSaldo(id) {
            $("#body").css({ "overflow" : "hidden" });
            $("#overlay-editPesanSaldo").css({ "opacity" : "1", "z-index" : "10", "transition" : "all 0.5s" });

            var id = id;
            $('#form-editPesanSaldo').empty();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_saldo.php", 
                data    : { type    : "editPesanSaldo",
                            id      : id },
                success : function(data){
                    $('#form-editPesanSaldo').append(data);
                    $('.form-line').addClass('focused');
                }
            });
        }

        $("#submit").click(function(){
            var saldo        = $('#saldo').val();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_saldo.php",
                data    : { type    : "insert",
                            saldo   : saldo },
                success : function(data){
                    console.log(data);
                    // response = JSON.parse(data);
                    // console.log("resultnya : " + response.result + ", messegenya : " + response.message);
                    batalTambah();
                    resetForm();
                    removeFocus();
                    loadData();
                    loadDataPesanSaldo();
                }
            });
        });

        // $("#submit").click(function(){
        //     var id_saldo        = $('#id_saldo').val();
        //     var id_user         = $('#id_user').val();
        //     var saldo_sekarang  = $('#saldo_sekarang').val();
        //     var saldo_keluar    = $('#saldo_keluar').val();
        //     $.ajax({
        //         method  : "POST",
        //         url     : "ajax/ajax_saldo.php",
        //         data    : { type            : "insert",
        //                     id_saldo        : id_saldo,
        //                     id_user         : id_user,
        //                     saldo_sekarang  : saldo_sekarang,
        //                     saldo_keluar    : saldo_keluar },
        //         success : function(response){
                    
        //             // console.log(data);
        //             // alert(data);
        //             batalTambah();
        //             resetForm();
        //             removeFocus();
        //             // loadData();
        //         }
        //     });
        // });

        function update(){
            var id_saldo        = $('#id_saldo-edit').val();
            var id_user         = $('#id_user-edit').val();
            var saldo_sekarang  = $('#saldo_sekarang-edit').val();
            var saldo_keluar    = $('#saldo_keluar-edit').val();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_saldo.php",
                data    : { type            : "update",
                            id_saldo        : id_saldo,
                            id_user         : id_user,
                            saldo_sekarang  : saldo_sekarang,
                            saldo_keluar    : saldo_keluar },
                success : function(data){
                    console.log(data);
                    batalEdit();
                    loadData();
                }
            });
        };
        
        function updatePesanSaldo(){
            var id_pesan_saldo      = $('#id_pesan_saldo-edit').val();
            var nominal             = $('#nominal-edit').val();
            var harga               = $('#harga-edit').val();
            var status              = $('#status-edit').val();
            var bukti_pembayaran    = "";
            
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_saldo.php",
                data    : { type                : "updatePesanSaldo",
                            id_pesan_saldo      : id_pesan_saldo,
                            nominal             : nominal,
                            harga               : harga,
                            status              : status,
                            bukti_pembayaran    : bukti_pembayaran },
                success : function(data){
                    console.log(data);
                    batalEditPesanSaldo();
                    loadDataPesanSaldo();
                }
            });
        };

        // loadData();
        // function loadData(){
        //     $.ajax({
        //         method  : "POST",
        //         url     : "ajax/ajax_saldo.php",
        //         data    : { type : "view" },
        //         success : function(data){
        //             $('#tbody').empty();
        //             $('#tbody').append(data);
        //         }
        //     });
        // }
        
        // loadDataPesanSaldo();
        // function loadDataPesanSaldo(){
        //     $.ajax({
        //         method  : "POST",
        //         url     : "ajax/ajax_saldo.php",
        //         data    : { type : "viewPesanSaldo" },
        //         success : function(data){
        //             $('#tbody-pesansaldo').empty();
        //             $('#tbody-pesansaldo').append(data);
        //         }
        //     });
        // }

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
                    url     : "ajax/ajax_saldo.php", 
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
        
        function hapusPesanSaldo(id) {
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
                    url     : "ajax/ajax_saldo.php", 
                    data    : { type    : "deletePesanSaldo",
                                id      : id },
                    success : function(data){
                        console.log(data);
                        loadDataPesanSaldo();
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