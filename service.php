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

    <style>
        
        /*Custom css untuk search data table hanya di halaman ini*/

        .dataTables_wrapper label{
            width: 100%;
            float: right;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        div.dataTables_wrapper div.dataTables_filter label{
            text-align: right;
        }
        div.dataTables_wrapper div.dataTables_filter input{
            width: calc(100% - 55px);
        }
        .left-table{
            width: 40.5%; 
            float: left;
        }
        .right-table{
            width: 56.5%;  
            float: left; 
            margin-right: 3%;
        }

        @media (max-width: 900px){
            .left-table{
                width: auto;
                float: none;
            }
            .right-table{
                width: auto;
                float: none; 
                margin-right: 0px;
            }
            div.dataTables_wrapper div.dataTables_filter input{
                width: auto;
            }
        }

    </style>

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
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Tambah Service
                        <small>Tabel Service</small>
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
                                        <input type="text" id="nama_service" class="form-control">
                                        <label class="form-label">Nama Service</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="harga_service" class="form-control">
                                        <label class="form-label">Harga</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 marbot">
                                <select id='status_service' class="form-control show-tick">
                                    <!--<option value="">Status</option>-->
                                    <option id="1" value="1">On</option>
                                    <!--<option id="0" value="0">Off</option>-->
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <span class="spanlabel"><a href="https://portalpulsa.com/pulsa-murah-all-operator/">Lihat Kodenya Disini</a></span>
                                <div class="form-group form-float" style="margin-top: 7px;">
                                    <div class="form-line">
                                        <input type="text" id="kode" class="form-control">
                                        <label class="form-label">Kode</label>
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
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 tengah">
            <div class="card">
                <div class="header">
                    <h2>
                        Edit Service
                        <small>Tabel Service</small>
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
    
    <?php include("navigation.php"); ?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Halaman Service</h2>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card right-table">
                        <div class="header">
                            <?php 
                                if ($_SESSION['akun']['status'] == 1) {
                                    echo '<button type="button" class="btn bg-light-blue waves-effect tombol-kanan" onclick="tambah()">Tambah Service</button>';
                                }
                            ?>
                            <h2>
                                Semua Service
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
                                            <th width="300px">Nama Service</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Kode</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th width="300px">Nama Service</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Kode</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card left-table" style=>
                        <div class="header">
                            <h2>
                                Service - Active
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
                                            <th>Nama Service</th>
                                            <th>Harga</th>
                                            <th>Kode</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Service</th>
                                            <th>Harga</th>
                                            <th>Kode</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tbodyactive">
                                    </tbody>
                                </table>
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

    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/forms/basic-form-elements.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

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

        $("#media").change(function(){
            var id=$("#media :selected").val();
            var dataString = 'id='+ id;
            alert(id); return false;
        });

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
                url     : "ajax/ajax_service.php", 
                data    : { type    : "edit",
                            id      : id },
                success : function(data){
                    $('#form-edit').append(data);
                    $('.form-line').addClass('focused');
                }
            });
        }

        $("#submit").click(function(){
            var nama_service    = $('#nama_service').val();
            var harga_service   = $('#harga_service').val();
            var status_service  = $('#status_service').val();
            var kode            = $('#kode').val();

            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_service.php",
                data    : { type            : "insert",
                            nama_service    : nama_service,
                            harga_service   : harga_service,
                            status_service  : status_service,
                            kode            : kode},
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
            var id_service      = $('#id_service-edit').val();
            var nama_service    = $('#nama_service-edit').val();
            var harga_service   = $('#harga_service-edit').val();
            var status_service  = $('#status_service-edit').val();
            var kode            = $('#kode-edit').val();
            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_service.php",
                data    : { type        : "update",
                            id_service      : id_service,
                            nama_service    : nama_service,
                            harga_service   : harga_service,
                            status_service  : status_service,
                            kode            : kode},
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
                url     : "ajax/ajax_service.php",
                data    : { type : "view" },
                success : function(data){
                    $('#tbody').empty();
                    $('#tbody').append(data);
                }
            });

            $.ajax({
                method  : "POST",
                url     : "ajax/ajax_service.php",
                data    : { type : "view-active" },
                success : function(data){
                    $('#tbodyactive').empty();
                    $('#tbodyactive').append(data);
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
                    url     : "ajax/ajax_service.php", 
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