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
                $levelstatus = "Siapa Anda ?tab";
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
    <div class="overlay-input" id="overlay-input">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah" style="margin-top: -30px;">
            <div class="card">
                <div class="header">
                    <h2>
                        Tambah Transaksi
                        <small>Tabel Transaksi</small>
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
                            <!--<div class="col-sm-12">-->
                            <!--    <div class="form-group form-float">-->
                            <!--        <div class="form-line">-->
                            <!--            <input type="number" id="id_transaksi" class="form-control">-->
                            <!--            <label class="form-label">ID Transaksi</label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-sm-12">-->
                            <!--    <div class="form-group form-float">-->
                            <!--        <div class="form-line">-->
                            <!--            <input type="number" id="id_user" class="form-control">-->
                            <!--            <label class="form-label">ID User</label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-sm-12">-->
                            <!--    <div class="form-group form-float">-->
                            <!--        <div class="form-line">-->
                            <!--            <input type="number" id="id_service" class="form-control">-->
                            <!--            <label class="form-label">ID Service</label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-sm-12 marbot">
                                <select id='id_service' class="form-control show-tick">
                                    <option value="">Pilih Serive</option>
                                    <?php
                                        $query = mysqli_query($connect, "select id_service, kode from service where status_service = '1'");
                                        while($data = mysqli_fetch_row($query)){
                                            echo '<option id="'.$data[0].'" value="'.$data[0].'">'.$data[1].'</option>';   
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="no_hp" class="form-control">
                                        <label class="form-label">No Handphone</label>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-12">-->
                            <!--    <span class="spanlabel">Tanggal (Contoh : 30/12/2018)</span>-->
                            <!--    <div class="input-group">-->
                            <!--        <div class="form-line">-->
                            <!--            <input id="tanggal" type="text" class="form-control">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-md-12">-->
                            <!--    <span class="spanlabel">Waktu (Contoh : 23:59)</span>-->
                            <!--    <div class="input-group">-->
                            <!--        <div class="form-line">-->
                            <!--            <input id="waktu" type="text" class="form-control">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="col-sm-12">-->
                            <!--    <div class="form-group form-float">-->
                            <!--        <div class="form-line">-->
                            <!--            <input type="text" id="status_transaksi" class="form-control">-->
                            <!--            <label class="form-label">Status</label>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
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
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah" style="margin-top: 80px;">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Transaksi
                        <small>Tabel Transaksi</small>
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
    <div class="overlay-input" id="overlay-lihat">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Status Transaksi
                        <small>Nama User - level</small>
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
                        <div class="isi-notif">
                            <table style="width: 100%;">
                                <tr style="border-bottom: 2px solid #eee !important;">
                                    <td style="width: 30%; padding: 10px 0;">Nomor Handphone</td>
                                    <td style="width: 70%; padding: 10px 0;" id="phone-cek"></td>
                                </tr>
                                <tr style="border-bottom: 2px solid #eee !important;">
                                    <td style="width: 30%; padding: 10px 0;">Status</td>
                                    <td style="width: 70%; padding: 10px 0;" id="status-cek"></td>
                                </tr>
                                <tr style="border-bottom: 2px solid #eee !important;">
                                    <td style="width: 30%; padding: 10px 0;">Note</td>
                                    <td style="width: 70%; padding: 10px 0;" id="note-cek"></td>
                                </tr>
                            </table>
                        </div>
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
                <h2>Halaman Transaksi</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <button type="button" class="btn bg-light-blue waves-effect tombol-kanan" onclick="tambah()">Tambah Transaksi</button>
                            <h2>
                                Tabel Transaksi
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
                                            <!--<th>ID Transaksi</th>-->
                                            <!--<th>ID User</th>-->
                                            <!--<th>ID Service</th>-->
                                            <th>Nomer Handphone</th>
                                            <th>Harga</th>
                                            <!--<th>Trxid</th>-->
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th width="70px">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <!--<th>ID Transaksi</th>-->
                                            <!--<th>ID User</th>-->
                                            <!--<th>ID Service</th>-->
                                            <th>Nomer Handphone</th>
                                            <th>Harga</th>
                                            <!--<th>Trxid</th>-->
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th width="70px">Action</th>
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

    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <script src="js/pages/ui/tooltips-popovers.js"></script>

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
            $("#overlay-lihat").css({ "opacity" : "0", "z-index" : "-1", "transition" : "all 0.2s" });
            $("#body").css({ "overflow" : "auto" });
            resetForm();
            $('#phone-cek').empty();
            $('#status-cek').empty();
            $('#note-cek').empty();
            loadData();
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
                url     : "ajax/ajax_transaksi.php", 
                data    : { type    : "edit",
                            id      : id },
                success : function(data){
                    $('#form-edit').append(data);
                    $('.form-line').addClass('focused');
                }
            });
        }

        $("#submit").click(function(){
            alert("Fitur ini hanya ada saat anda online");
            batalTambah();
        });

        function update(){
            var id_transaksi        = $('#id_transaksi-edit').val();
            var id_user             = $('#id_user-edit').val();
            var id_service          = $('#id_service-edit').val();
            var no_hp               = $('#no_hp-edit').val();
            var tanggal             = $('#tanggal-edit').val();
            var waktu               = $('#waktu-edit').val();
            var status_transaksi    = $('#status_transaksi-edit').val();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_transaksi.php",
                data    : { type                : "update",
                            id_transaksi        : id_transaksi,
                            id_user             : id_user,
                            id_service          : id_service,
                            no_hp               : no_hp,
                            tanggal             : tanggal,
                            waktu               : waktu,
                            status_transaksi    : status_transaksi },
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
                url     : "ajax/ajax_transaksi.php",
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
                    url     : "ajax/ajax_transaksi.php", 
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
        
        function lihat(id) {
            $("#body").css({ "overflow" : "hidden" });
            $("#overlay-lihat").css({ "opacity" : "1", "z-index" : "10", "transition" : "all 0.5s" });
            
            var id = id;
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_transaksi.php", 
                data    : { type    : "statusTransaksi",
                            id      : id },
                success : function(response){
                    response = JSON.parse(response);
                    var status = response.message[0].status;
                    switch (status){
            			case '1':
            				status = "Pending";
            				break;
            			case '2':
            				status = "Gagal";
            				break;
            			case '3':
            				status = "Refund";
            				break;
            			case '4':
            				status = "Sukses";
            				break;
            			default:
            			    status = "Undefined";
            		}
                    $('#phone-cek').empty();
                    $('#status-cek').empty();
                    $('#note-cek').empty();
                    $('#phone-cek').append(response.message[0].phone);
                    $('#status-cek').append(status);
                    $('#note-cek').append(response.message[0].note);
                }
            });
        }

    </script>

    
</body>
</html>
<?php
    }
?>