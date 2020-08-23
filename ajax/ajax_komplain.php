<?php 

	include("../koneksi.php");
	session_start();

    if ($_POST['type'] == 'insert') {

        $id_user        = $_SESSION['akun']['id_user'];
        $judul          = $_POST['judul'];
        $deskripsi      = $_POST['deskripsi'];
        $gambar         = $_POST['gambar'];
        $tanggal        = date("Y/m/d");
        $waktu          = date("H:i:s");
        $id_transaksi   = $_POST['id_transaksi'];

        // echo $id_user . ", ";
        // echo $judul . ", ";
        // echo $deskripsi . ", ";
        // echo $gambar . ", ";
        // echo $tanggal . ", ";
        // echo $waktu . ", ";
        // echo $id_transaksi . ", ";

        $query = mysqli_query($connect, "INSERT INTO `komplain` (`id_user`, `id_komplain`, `judul`, `deskripsi`, `gambar`, `tanggal`, `waktu`, `status_komplain`, `id_transaksi`) VALUES ('$id_user', null, '$judul', '$deskripsi', '$gambar', '$tanggal', '$waktu', 1, '$id_transaksi')");

        if ($query) {
        	echo "BERHASIL INPUT DATA KOMPLAIN";
        }
        else{
        	echo "BERHASIL INPUT DATA KOMPLAIN";
        }
    }
    if ($_POST['type'] == 'view') {

        $no = 1;
        $query = mysqli_query($connect, "SELECT komplain.*, user.nama_lengkap, transaksi.no_hp FROM komplain, user, transaksi WHERE komplain.id_transaksi = transaksi.id_transaksi AND transaksi.id_user = user.id_user");
        while ($data = mysqli_fetch_array($query)) {
            $id_komplain    = $data['id_komplain'];
            $judul          = $data['judul'];
            $deskripsi      = $data['deskripsi'];
            $gambar         = $data['gambar'];
            $tanggal        = $data['tanggal'];
            $waktu          = $data['waktu'];
            $status_komplain= $data['status_komplain'];
            $nama           = $data['nama_lengkap'];
            $no_hp          = $data['no_hp'];
            
            switch ($status_komplain) {
                case 1:
                    $status = "<button onclick='lihat($id_komplain)' type='button' class='btn btn-block bg-deep-purple waves-effect'>Pending</button>";
                    break;
                case 2:
                    $status = "<button onclick='lihat($id_komplain)' type='button' class='btn btn-block bg-light-blue waves-effect'>Dilihat</button>";
                    break;
                case 3:
                    $status = "<button onclick='lihat($id_komplain)' type='button' class='btn btn-block bg-light-green waves-effect'>Fix</button>";
                    break;
                default:
                    $status = "<button onclick='lihat($id_komplain)' type='button' class='btn btn-block bg-red waves-effect'>Undefined</button>";
                    break;
            }
            
            if ($_SESSION['akun']['status'] == 1) {
                $action = " <td class='act' width='100px'>
                                <center>
                                <a onclick='lihat($id_komplain)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Lihat Komplain'>remove_red_eye</i></a>
                                <a onclick='edit($id_komplain)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Edit Komplain'>mode_edit</i></a>
                                <a onclick='hapus($id_komplain)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Hapus Komplain' data-type='confirm'>delete</i></a>
                                </center>
                            </td>";
            }else{
                $action = " <td class='act'>
                                <center>
                                <a onclick='lihat($id_komplain)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Lihat Komplain'>remove_red_eye</i></a>
                                <a onclick='hapus($id_komplain)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Hapus Komplain' data-type='confirm'>delete</i></a>
                                </center>
                            </td>";
            }
            
            echo "  <tr>
                        <td>$no</td>
                        <td>$nama</td>
                        <td>$judul</td>
                        <td>$deskripsi</td>
                        <td>$tanggal</td>
                        <td>$waktu</td>
                        <td>$no_hp</td>
                        <td>$status</td>
                        $action
                    </tr>";
            $no++;
        }
    }
    if ($_POST['type'] == 'edit'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "select * from `komplain` where id_komplain='$id'");
        $data = mysqli_fetch_row($query);

        $id_user        = $data[0];
        $id_komplain    = $data[1];
        $judul          = $data[2];
        $deskripsi      = $data[3];
        $gambar         = $data[4];
        $tanggal        = $data[5];
        $waktu          = $data[6];
        $status_komplain= $data[7];
        $id_transaksi   = $data[8];
        
        switch ($status_komplain) {
            case 1:
                $selected1 = "selected";
                break;
            case 2:
                $selected2 = "selected";
                break;
            case 3:
                $selected3 = "selected";
                break;
            default:
                $selected1 = "selected";
                break;
        }

        echo "  <input type='hidden' id='id_komplain-edit' class='form-control' value='$id_komplain'>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='judul-edit' class='form-control' value='$judul'>
                            <label class='form-label'>Judul</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group'>
                        <div class='form-line'>
                            <textarea rows='4' id='deskripsi-edit' class='form-control no-resize'>$deskripsi</textarea>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='id_transaksi-edit' class='form-control' value='$id_transaksi'>
                            <label class='form-label'>ID Transaksi</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12 marbot'>
                    <label>Status Komplain</label>
                    <select id='status_komplain-edit' class='form-control show-tick'>
                        <option id='1' value='1' $selected1>Pending</option>
                        <option id='2' value='2' $selected2>Dilihat</option>
                        <option id='3' value='3' $selected3>Fix</option>
                    </select>
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
        $id_komplain    = $_POST['id_komplain'];
        $judul          = $_POST['judul'];
        $deskripsi      = $_POST['deskripsi'];
        $gambar         = $_POST['gambar'];
        $status_komplain= $_POST['status_komplain'];
        $id_transaksi   = $_POST['id_transaksi'];

        $query = mysqli_query($connect, "UPDATE `komplain` SET 
                    judul               = '$judul',
                    deskripsi           = '$deskripsi',
                    gambar              = '$gambar',
                    status_komplain     = '$status_komplain',
                    id_transaksi        = '$id_transaksi'
                    WHERE id_komplain   = $id_komplain ");

        if ($query) {
            echo "BERHASIL UPDATE DATA KOMPLAIN";
        }
        else{
            echo "Gagal UPDATE DATA KOMPLAIN";
        }

    }
    if ($_POST['type'] == 'delete'){
        
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "DELETE FROM `komplain` where id_komplain='$id'");

        if ($query) {
            echo "BERHASIL DELETE DATA KOMPLAIN";
        }
        else{
            echo "Gagal DELETE DATA KOMPLAIN";
        }
    }
    
    if ($_POST['type'] == 'lihatKomplain'){
        
        $id    = $_POST['id'];
        
        $query = mysqli_query($connect, "SELECT komplain.*, user.nama_lengkap, transaksi.no_hp FROM komplain, user, transaksi WHERE komplain.id_transaksi = transaksi.id_transaksi AND transaksi.id_user = user.id_user AND id_komplain = '$id'");
        $data = mysqli_fetch_array($query);
        
        $judul          = $data['judul'];
        $deskripsi      = $data['deskripsi'];
        $gambar         = $data['gambar'];
        $tanggal        = $data['tanggal'];
        $waktu          = $data['waktu'];
        $status_komplain= $data['status_komplain'];
        $nama           = $data['nama_lengkap'];
        $no_hp          = $data['no_hp'];
        
        switch ($status_komplain) {
            case 1:
                $status = "Pending";
                break;
            case 2:
                $status = "Dilihat";
                break;
            case 3:
                $status = "Fix";
                break;
            default:
                $status = "Undefined";
                break;
        }
        
        echo '  <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">User</td>
                    <td style="width: 80%; padding: 10px 0;">' . $nama . '</td>
                </tr>
                <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">Judul</td>
                    <td style="width: 80%; padding: 10px 0;">' . $judul . '</td>
                </tr>
                <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">Deskripsi</td>
                    <td style="width: 80%; padding: 10px 0;">' . $deskripsi . '</td>
                </tr>
                <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">Gambar</td>
                    <td style="width: 80%; padding: 10px 0;">' . $gambar . '</td>
                </tr>
                <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">Tanggal</td>
                    <td style="width: 80%; padding: 10px 0;">' . $tanggal . '</td>
                </tr>
                <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">Waktu</td>
                    <td style="width: 80%; padding: 10px 0;">' . $waktu . '</td>
                </tr>
                <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">Transaksi</td>
                    <td style="width: 80%; padding: 10px 0;">' . $no_hp . '</td>
                </tr>
                <tr style="border-bottom: 2px solid #eee !important;">
                    <td style="width: 20%; padding: 10px 0;">Status</td>
                    <td style="width: 80%; padding: 10px 0;">' . $status . '</td>
                </tr>';
        
    }
    

?>