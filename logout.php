<?php 

	session_start();
// 	unset($_SESSION['akun']);
	session_destroy();

	header("location: index.php");

?>