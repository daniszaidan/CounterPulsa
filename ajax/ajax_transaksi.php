<?php 

	include("../koneksi.php");
	session_start();

    if ($_POST['type'] == 'insert') {
        
        if ($_SESSION['akun']['status'] == 1){

            $id_user           = $_SESSION['akun']['id_user'];
            $id_service        = $_POST['id_service'];
            $no_hp             = $_POST['no_hp'];
            $tanggal           = date("Y/m/d");
            $waktu             = date("H:i:s");
            $trxid             = "x" . rand(100, 999);
            $no                = 1;
            
            $query = mysqli_query($connect, "select harga_service, kode from `service` where id_service='$id_service'");
            $data = mysqli_fetch_array($query);
            $harga = $data['harga_service'];
            $kode = $data['kode'];
    
            $query2 = mysqli_query($connect, "select * from `transaksi` where id_user='$id_user'");
            while ($view = mysqli_fetch_array($query2)) {
                if ($view['trxid'] == $trxid) {
                    $trxid = "x" . rand(100, 999);
                }
                if ($view['tanggal'] == $tanggal) {
                    $no++;
                }
            }
    
            $query3 = mysqli_query($connect, "INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_service`, `no_hp`, `trxid`, `tanggal`, `waktu`, `status_transaksi`) VALUES (NULL, '$id_user', '$id_service', '$no_hp', '$trxid', '$tanggal', '$waktu', 0)");
            
            $query4 = mysqli_query($connect, "UPDATE `saldo` SET `saldo_keluar` = (`saldo_keluar` + $harga) WHERE `id_user` = '$id_user'");
            
            echo "id_user : " . $id_user . ", ";
            echo "id_service : " . $id_service . ", ";
            echo "harga : " . $harga . ", ";
            echo "kode : " . $kode . ", ";
            echo "no_hp : " . $no_hp . ", ";
            echo "trxid : " . $trxid . ", ";
            echo "no : " . $no . ", ";
            echo "tanggal : " . $tanggal . ", ";
            echo "waktu : " . $waktu . ", ";
            echo $result;
            
        }else{
            echo "Maaf, anda bukan admin, fitur transaksi untuk user coming soon. Sementara ini fitur transaksi hanya bisa untuk admin";
        }
    }
        
    if ($_POST['type'] == 'view') {

        $no = 1;
        $query = mysqli_query($connect, "SELECT transaksi.*, service.harga_service FROM transaksi, service WHERE transaksi.id_service = service.id_service;");
        while ($data = mysqli_fetch_array($query)) {

            // $id_transaksi      = $data[0];
            // $id_user           = $data[1];
            // $id_service        = $data[2];
            // $no_hp             = $data[3];
            // $trxid             = $data[4];
            // $tanggal           = $data[5];
            // $waktu             = $data[6];
            // $status_transaksi  = $data[7];
            
            $id_transaksi             = $data['id_transaksi'];
            $no_hp             = $data['no_hp'];
            $trxid             = $data['trxid'];
            $tanggal           = $data['tanggal'];
            $waktu             = $data['waktu'];
            $status_transaksi  = $data['status_transaksi'];
            $harga_service     = $data['harga_service'];
            
            if($status_transaksi == 0){
                $status = "<button onclick='lihat($id_transaksi)' type='button' class='btn btn-block bg-deep-purple waves-effect'>Belum dicek</button>";
            }else{
                $status = $status_transaksi;
                switch ($status) {
                    case 1:
                        $status = "<button onclick='lihat($id_transaksi)' type='button' class='btn btn-block bg-deep-purple waves-effect'>Pending</button>";
                        break;
                    case 2:
                        $status = "<button onclick='lihat($id_transaksi)' type='button' class='btn btn-block bg-red waves-effect'>Gagal</button>";
                        break;
                    case 3:
                        $status = "<button onclick='lihat($id_transaksi)' type='button' class='btn btn-block bg-light-green waves-effect'>Refund</button>";
                        break;
                    case 4:
                        $status = "<button onclick='lihat($id_transaksi)' type='button' class='btn btn-block bg-light-blue waves-effect'>Sukses</button>";
                        break;
                    default:
                        $status = "<button onclick='lihat($id_transaksi)' type='button' class='btn btn-block bg-red waves-effect'>Undefined</button>";
                        break;
                }
            }

            echo "  <tr>
                        <td>$no</td>
                        <td>$no_hp</td>
                        <td>$harga_service</td>
                        <td>$tanggal</td>
                        <td>$waktu</td>
                        <td>$status</td>
                        <td class='act'>
                            <center>
                            <a onclick='edit($id_transaksi)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Edit Data'>mode_edit</i></a>
                            <a onclick='hapus($id_transaksi)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Hapus Data' data-type='confirm'>delete</i></a>
                            </center>
                        </td>
                    </tr>";
            $no++;
        }
    }
    if ($_POST['type'] == 'edit'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "select * from `transaksi` where id_transaksi='$id'");
        $data = mysqli_fetch_row($query);

        $id_transaksi      = $data[0];
        $id_user           = $data[1];
        $id_service        = $data[2];
        $no_hp             = $data[3];
        $trxid             = $data[4];
        $tanggal           = $data[5];
        $waktu             = $data[6];
        $status_transaksi  = $data[7];

        echo "  <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='id_transaksi-edit' class='form-control' value='$id_transaksi'>
                            <label class='form-label'>ID Transaksi</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='id_user-edit' class='form-control' value='$id_user'>
                            <label class='form-label'>ID User</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='id_service-edit' class='form-control' value='$id_service'>
                            <label class='form-label'>ID Service</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='no_hp-edit' class='form-control' value='$no_hp'>
                            <label class='form-label'>No Handphone</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='tanggal-edit' class='form-control' value='$tanggal'>
                            <label class='form-label'>Tanggal</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='waktu-edit' class='form-control' value='$waktu'>
                            <label class='form-label'>Waktu</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='status_transaksi-edit' class='form-control' value='$status_transaksi'>
                            <label class='form-label'>Status</label>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-8'>

                    </div>
                    <div class='col-xs-3'>
                        <button onclick='update()' type='button' class='tombol-submit btn btn-block bg-light-blue waves-effect'>Edit</button>
                    </div>
                </div>";
    }

    if ($_POST['type'] == 'update'){

        $id_transaksi      = $_POST['id_transaksi'];
        $id_user           = $_POST['id_user'];
        $id_service        = $_POST['id_service'];
        $no_hp             = $_POST['no_hp'];
        $tanggal           = $_POST['tanggal'];
        $waktu             = $_POST['waktu'];
        $status_transaksi  = $_POST['status_transaksi'];

        $query = mysqli_query($connect, "UPDATE `transaksi` SET 
                id_transaksi        = '$id_transaksi',
                id_user             = '$id_user',
                id_service          = '$id_service',
                no_hp               = '$no_hp',
                tanggal             = '$tanggal',
                waktu               = '$waktu',
                status_transaksi    = '$status_transaksi'
                WHERE id_transaksi  = $id_transaksi ");

        if ($query) {
            echo "BERHASIL UPDATE DATA TRANSAKSI";
        }
        else{
            echo "GAGAL UPDATE DATA TRANSAKSI";
        }
    }
    if ($_POST['type'] == 'delete'){
       
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "DELETE FROM `transaksi` where id_transaksi='$id'");

        if ($query) {
            echo "BERHASIL DELETE DATA TRANSAKSI";
        }
        else{
            echo "GAGAL DELETE DATA TRANSAKSI";
        }
    }
    if ($_POST['type'] == 'statusTransaksi'){
       
        $id    = $_POST['id'];
        
        $query = mysqli_query($connect, "select * from `transaksi` where id_transaksi='$id'");
        $data = mysqli_fetch_array($query);
        $trxid = $data['trxid'];
        
        $query2 = mysqli_query($connect, "UPDATE `transaksi` SET `status_transaksi` = '$status' WHERE `id_transaksi` = '$id'");
    }
    
    
    

?>