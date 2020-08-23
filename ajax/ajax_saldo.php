<?php

	include("../koneksi.php");
	
	session_start();
	$user = $_SESSION['akun']['id_user'];

    if ($_POST['type'] == 'insert') {
        
        $saldo      = $_POST['saldo'];
        $harga      = $saldo + 1000 + rand(100, 999);
        $tanggal    = date("Y/m/d");
        $waktu      = date("H:i:s");
        
        if ($_SESSION['akun']['status'] == 2){
    
            $query = mysqli_query($connect, "INSERT INTO `request_portalpulsa` (`id_request`, `id_user`, `result`, `messege`, `tanggal`, `waktu`) VALUES (NULL, '$user', '$title', '$message', $tanggal, $waktu)");
        }else{
            
            $query = mysqli_query($connect, "INSERT INTO `pesan_saldo` (`id_pesan_saldo`, `id_user`, `nominal`, `harga`, `tanggal`, `waktu`, `status`, `bukti_pembayaran`) VALUES (NULL, '$user', '$saldo', '$harga', '$tanggal', '$waktu', '1', '0')");
        }

    }
    if ($_POST['type'] == 'view') {
        
        if($user == 1){
            
            $query = mysqli_query($connect, "UPDATE `saldo` SET `saldo_sekarang` = '$balance' WHERE `id_user` = $user");
            
        }

        $no = 1;
        $query = mysqli_query($connect, "select * from `saldo` where id_saldo='$user'");
        while ($data = mysqli_fetch_row($query)) {
            $id_saldo       = $data[0];
            $id_user        = $data[1];
            $saldo_sekarang = $data[2];
            $saldo_keluar   = $data[3];
            
            echo "  <tr>
                        <td>$no</td>
                        <td>$id_user</td>
                        <td>$saldo_sekarang</td>
                        <td>$saldo_keluar</td>
                        <td class='act'>
                            <center>
                            <a onclick='edit($id_saldo)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Edit Data'>mode_edit</i></a>
                            <a onclick='hapus($id_saldo)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Hapus Data' data-type='confirm'>delete</i></a>
                            </center>
                        </td>
                    </tr>";
            $no++;
        }
    }
    if ($_POST['type'] == 'viewPesanSaldo') {
        
        $no = 1;
        $query = mysqli_query($connect, "select * from `pesan_saldo`");
        while ($data = mysqli_fetch_array($query)) {
            $id_pesan_saldo     = $data['id_pesan_saldo'];
            $id_user            = $data['id_user'];
            $nominal            = $data['nominal'];
            $harga              = $data['harga'];
            $tanggal            = $data['tanggal'];
            $waktu              = $data['waktu'];
            $status             = $data['status'];
            $bukti_pembayaran   = $data['bukti_pembayaran'];
            
            switch ($status) {
                case 1:
                    $statusnya = "<button onclick='lihat($id_komplain)' type='button' class='btn btn-block bg-deep-purple waves-effect'>Pending</button>";
                    break;
                case 2:
                    $statusnya = "<button onclick='lihat($id_komplain)' type='button' class='btn btn-block bg-light-blue waves-effect'>Done</button>";
                    break;
                default:
                    $statusnya = "<button onclick='lihat($id_komplain)' type='button' class='btn btn-block bg-red waves-effect'>Undefined</button>";
                    break;
            }
            
            echo "  <tr>
                        <td>$no</td>
                        <td>$id_user</td>
                        <td>$nominal</td>
                        <td>$harga</td>
                        <td>$tanggal</td>
                        <td>$waktu</td>
                        <td>$statusnya</td>
                        <td class='act'>
                            <center>
                            <a onclick='editPesanSaldo($id_pesan_saldo)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Edit Data'>mode_edit</i></a>
                            <a onclick='hapusPesanSaldo($id_pesan_saldo)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Hapus Data' data-type='confirm'>delete</i></a>
                            </center>
                        </td>
                    </tr>";
            $no++;
        }
    }
    if ($_POST['type'] == 'edit'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "select * from `saldo` where id_saldo='$id'");
        $data = mysqli_fetch_row($query);

            $id_saldo       = $data[0];
            $id_user        = $data[1];
            $saldo_sekarang = $data[2];
            $saldo_keluar   = $data[3];

        echo "  <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='id_saldo-edit' name='id_saldo-edit' class='form-control' value='$id_saldo'>
                            <label class='form-label'>ID Saldo</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='id_user-edit' name='id_user-edit' class='form-control' value='$id_user'>
                            <label class='form-label'>ID User</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='saldo_sekarang-edit' name='saldo_sekarang-edit' class='form-control' value='$saldo_sekarang'>
                            <label class='form-label'>Saldo Sekarang</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='saldo_keluar-edit' name='saldo_keluar-edit' class='form-control' value='$saldo_keluar'>
                            <label class='form-label'>Saldo Keluar</label>
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
        $id_saldo           = $_POST['id_saldo'];
        $id_user            = $_POST['id_user'];
        $saldo_sekarang     = $_POST['saldo_sekarang'];
        $saldo_keluar       = $_POST['saldo_keluar'];

        $query = mysqli_query($connect, "UPDATE `saldo` SET 
                    `id_saldo`      = '$id_saldo',
                    `id_user`       = '$id_user',
                    `saldo_sekarang`= '$saldo_sekarang', 
                    `saldo_keluar`  = '$saldo_keluar' 
                    WHERE `id_saldo`= $id_saldo ");

        if ($query) {
            echo "BERHASIL UPDATE SALDO";
        }
        else{
            echo "GAGAL UPDATE SALDO";
        }
    }
    
    if ($_POST['type'] == 'updatePesanSaldo'){
        $id_pesan_saldo     = $_POST['id_pesan_saldo'];
        $nominal            = $_POST['nominal'];
        $harga              = $_POST['harga'];
        $status             = $_POST['status'];
        $bukti_pembayaran   = $_POST['bukti_pembayaran'];
        
        // echo $id_pesan_saldo     . ", ";
        // echo $nominal            . ", ";
        // echo $harga              . ", ";
        // echo $status             . ", ";
        // echo $bukti_pembayaran   . ", ";

        $query = mysqli_query($connect, "UPDATE `pesan_saldo` SET 
                    `nominal`           = '$nominal',
                    `harga`             = '$harga',
                    `status`            = '$status', 
                    `bukti_pembayaran`  = '$bukti_pembayaran' 
                    WHERE `id_pesan_saldo`= $id_pesan_saldo ");

        if ($query) {
            echo "BERHASIL UPDATE SALDO";
        }
        else{
            echo "GAGAL UPDATE SALDO";
        }
    }
    
    if ($_POST['type'] == 'delete'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "DELETE FROM `saldo` where id_saldo='$id'");

        if ($query) {
            echo "BERHASIL DELETE DATA SALDO";
        }
        else{
            echo "GAGAL DELETE DATA SALDO";
        }
    }
    
    if ($_POST['type'] == 'deletePesanSaldo'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "DELETE FROM `pesan_saldo` where id_pesan_saldo='$id'");

        if ($query) {
            echo "BERHASIL DELETE DATA SALDO";
        }
        else{
            echo "GAGAL DELETE DATA SALDO";
        }
    }
    
    if ($_POST['type'] == 'editPesanSaldo'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "select * from `pesan_saldo` where id_pesan_saldo='$id'");
        $data = mysqli_fetch_row($query);

        $id_pesan_saldo      = $data[0];
        $id_user             = $data[1];
        $nominal             = $data[2];
        $harga               = $data[3];
        $tanggal             = $data[4];
        $waktu               = $data[5];
        $status              = $data[6];
        $bukti_pembayaran    = $data[7];
        
        switch ($status) {
            case 1:
                $selected1 = "selected";
                break;
            case 2:
                $selected2 = "selected";
                break;
            default:
                $selected1 = "selected";
                break;
        }

        echo "  <input type='hidden' id='id_pesan_saldo-edit' class='form-control' value='$id_pesan_saldo'>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='nominal-edit' class='form-control' value='$nominal'>
                            <label class='form-label'>Nominal</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='number' id='harga-edit' class='form-control' value='$harga'>
                            <label class='form-label'>Harga</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12 marbot'>
                    <label>Status</label>
                    <select id='status-edit' class='form-control show-tick'>
                        <option id='1' value='1' $selected1>Pending</option>
                        <option id='2' value='2' $selected2>Done</option>
                    </select>
                </div>
                <div class='row'>
                    <div class='col-xs-8'>

                    </div>
                    <div class='col-xs-3'>
                        <button onclick='updatePesanSaldo()' type='button' class='tombol-submit btn btn-block bg-light-blue waves-effect'>Edit</button>
                    </div>
                </div>";
    }
    

?>