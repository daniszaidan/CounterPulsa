<?php 

	include("../koneksi.php");
	session_start();

    if ($_POST['type'] == 'insert') {

    	$id_service         = $_POST['id_service'];
        $nama_service       = $_POST['nama_service'];
        $harga_service      = $_POST['harga_service'];
        $status_service     = $_POST['status_service'];
        $kode               = $_POST['kode'];
       
        $query = mysqli_query($connect, "INSERT INTO `service` (`id_service`, `nama_service`, `harga_service`, `status_service`, `kode`) VALUES ('$id_service', '$nama_service', '$harga_service', '$status_service', '$kode')");

        if ($query) {
        	echo "BERHASIL INPUT DATA SERVICE";
        }
        else{
        	echo "GAGAL INPUT DATA SERVICE";
        }
    }
    if ($_POST['type'] == 'view') {

        $no = 1;
        $query = mysqli_query($connect, "select * from `service`");
        while ($data = mysqli_fetch_row($query)) {
            $id_service         = $data[0];
            $nama_service       = $data[1];
            $harga_service      = $data[2];
            $status_service     = $data[3];
            $kode               = $data[4];
            
            if ($_SESSION['akun']['status'] == 1) {
                $action = " <td class='act'>
                                <center>
                                <a onclick='edit($id_service)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Edit Data'>mode_edit</i></a>
                                <a onclick='hapus($id_service)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Hapus Data' data-type='confirm'>delete</i></a>
                                </center>
                            </td>";
            }else{
                $action = " <td class='act'>
                                <center>
                                    <a class='btn bg-light-blue waves-effect' onclick='aktif($id_service)' class='action'>Aktifkan</a>
                                </center>
                            </td>";
            }
            
            if($status_service == 1){
                $status = "on";
            }else{
                $status = "off";
            }
            
            echo "  <tr>
                        <td>$no</td>
                        <td>$nama_service</td>
                        <td>$harga_service</td>
                        <td>$status</td>
                        <td>$kode</td>
                        $action
                    </tr>";
            $no++;
        }
    }
    if ($_POST['type'] == 'view-active') {

        $no = 1;
        $query = mysqli_query($connect, "select * from `service` where status_service = '1'");
        while ($data = mysqli_fetch_row($query)) {
            $nama_service       = $data[1];
            $harga_service      = $data[2];
            $status_service     = $data[3];
            $kode               = $data[4];
            
            echo "  <tr>
                        <td>$no</td>
                        <td>$nama_service</td>
                        <td>$harga_service</td>
                        <td>$kode</td>
                    </tr>";
            $no++;
        }
    }
    if ($_POST['type'] == 'edit'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "select * from `service` where id_service='$id'");
        $data = mysqli_fetch_row($query);
            $id_service         = $data[0];
            $nama_service       = $data[1];
            $harga_service      = $data[2];
            $status_service     = $data[3];
            $kode               = $data[4];

            $on = ""; $off = "";
            if ($status_service == "1") {
                $on = "selected";
            }else {
                $off = "selected";
            }

        echo "  <div class='col-sm-12'>
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
                            <input type='text' id='nama_service-edit' class='form-control' value='$nama_service'>
                            <label class='form-label'>Nama Service</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='harga_service-edit' class='form-control' value='$harga_service'>
                            <label class='form-label'>Harga Service</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12 marbot'>
                    <select id='status_service-edit' class='form-control show-tick'>
                        <option id='1' value='1' $on >On</option>
                        <option id='0' value='0' $off >Off</option>
                    </select>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='kode-edit' class='form-control' value='$kode'>
                            <label class='form-label'>Kode</label>
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

        $id_service         = $_POST['id_service'];
        $nama_service       = $_POST['nama_service'];
        $harga_service      = $_POST['harga_service'];
        $status_service     = $_POST['status_service'];
        $kode               = $_POST['kode'];

        $query = mysqli_query($connect, "UPDATE `service` SET
                    `id_service`        = '$id_service', 
                    `nama_service`      = '$nama_service', 
                    `harga_service`     = '$harga_service', 
                    `status_service`    = '$status_service',
                    `kode`              = '$kode'
                    WHERE `id_service`  = $id_service ");
        
        if ($query) {
            echo "BERHASIL UPDATE DATA SERVICE";
        }
        else{
            echo "GAGAL UPDATE DATA SERVICE";
        }

    }
    
    if ($_POST['type'] == 'delete'){

        $id    = $_POST['id'];

        $query = mysqli_query($connect, "DELETE FROM `service` where id_service='$id'");

        if ($query) {
            echo "BERHASIL DELETE DATA SERVICE";
        }
        else{
            echo "GAGAL DELETE DATA SERVICE";
        }
    }
    
    

?>