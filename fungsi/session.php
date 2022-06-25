<?php 
if(!isset($_SESSION['hak_akses']))
{
	header("location:./fungsi/login.php");
}
else if($_SESSION['status'] == 'denied'){
	header("location:./fungsi/login.php");
}
?>
<?php
error_reporting(0);
$server = "localhost";
$user = "root";
$pass = "";
$database = "e_klinik";

$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));
?>