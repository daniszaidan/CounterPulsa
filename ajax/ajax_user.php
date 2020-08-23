<?php 

	include("../koneksi.php");

    if ($_POST['type'] == 'insert') {

        $id_user      	= $_POST['id_user'];
        $no_ktp         = $_POST['no_ktp'];
        $no_hp      	= $_POST['no_hp'];
        $nama   		= $_POST['nama'];
        $username       = $_POST['username'];
        $email          = $_POST['email'];
        $level          = $_POST['level'];
        $password       = $_POST['password'];

        $query = mysqli_query($connect, "INSERT INTO `user` (`id_user`, `no_ktp`, `no_hp`, `nama`, `username`, `email`, `level`, `password`) VALUES ('$id_user', '$no_ktp', '$no_hp', '$nama', '$username', '$email', '$level', '$password')");

        if ($query) {
        	echo "BERHASIL INPUT DATA USER";
        }
        else{
        	echo "GAGAL INPUT DATA USER";
        }
    }
    if ($_POST['type'] == 'view') {

        $no = 1;
        $query = mysqli_query($connect, "select * from `user`");
        while ($data = mysqli_fetch_row($query)) {
            $id_user       = $data[0];
            $no_ktp        = $data[1];
            $no_hp         = $data[2];
            $nama          = $data[3];
            $username      = $data[4];
            $email         = $data[5];
            $level         = $data[6];
            echo "  <tr>
                        <td>$no</td>
                        <td>$id_user</td>
                        <td>$no_ktp</td>
                        <td>$no_hp</td>
                        <td>$nama</td>
                        <td>$username</td>
                        <td>$email</td>
                        <td>$level</td>
                        <td class='act'>
                            <center>
                            <a onclick='edit($id_user)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Edit Data'>mode_edit</i></a>
                            <a onclick='hapus($id_user)' class='action'><i class='material-icons md-18' data-toggle='tooltip' data-placement='bottom' title='Hapus Data' data-type='confirm'>delete</i></a>
                            </center>
                        </td>
                    </tr>";
            $no++;
        }
    }
    if ($_POST['type'] == 'edit'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "select * from `user` where id_user='$id'");
        $data = mysqli_fetch_row($query);

        $id_user       = $data[0];
        $no_ktp        = $data[1];
        $no_hp         = $data[2];
        $nama          = $data[3];
        $username      = $data[4];
        $email         = $data[5];
        $level         = $data[6];
        $password      = $data[7];
    echo " <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='id_user-edit' name='id_user' class='form-control' value='$id_user'>
                            <label class='form-label'>ID USERuser</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='no_ktp-edit' name='no_ktp' class='form-control' value='$no_ktp'>
                            <label class='form-label'>No KTP</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='no_hp-edit' name='no_hp' class='form-control' value='$no_hp'>
                            <label class='form-label'>NO HP</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='nama-edit' name='nama' class='form-control' value='$nama'>
                            <label class='form-label'>Nama</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='username-edit' name='username' class='form-control' value='$username'>
                            <label class='form-label'>Username</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='email-edit' name='email' class='form-control' value='$email'>
                            <label class='form-label'>Email</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='text' id='level-edit' name='level' class='form-control' value='$level'>
                            <label class='form-label'>Level</label>
                        </div>
                    </div>
                </div>
                <div class='col-sm-12'>
                    <div class='form-group form-float'>
                        <div class='form-line'>
                            <input type='password' id='password-edit' name='password' class='form-control' value='$password'>
                            <label class='form-label'>Password</label>
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
        $id_user     = $_POST['id_user'];
        $no_ktp      = $_POST['no_ktp'];
        $no_hp       = $_POST['no_hp'];
        $nama        = $_POST['nama'];
        $username    = $_POST['username'];
        $email       = $_POST['email'];
        $level       = $_POST['level'];
        $password    = $_POST['password'];

        $query = mysqli_query($connect, "UPDATE `user` SET 
                id_user    = '$id_user',
                no_ktp     = '$no_ktp',
                no_hp      = '$no_hp',
                nama       = '$nama',
                username   = '$username',
                email      = '$email',
                level      = '$level',
                password   = '$password'
                WHERE id_user = $id_user ");

        if ($query) {
            echo "BERHASIL UPDATE DATA USER";
        }
        else{
            echo "GAGAL UPDATE DATA USER";
        }
    }
    if ($_POST['type'] == 'delete'){
        $id    = $_POST['id'];

        $query = mysqli_query($connect, "DELETE FROM `user` where id_user='$id'");

        if ($query) {
            echo "BERHASIL DELETE DATA TRANSAKSI";
        }
        else{
            echo "GAGAL DELETE DATA TRANSAKSI";
        }
    }
    

?>