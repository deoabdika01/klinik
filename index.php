<?php 
include "view/header.php"; 
session_start();

if($_GET['hal'] == "buka")
{
	$_SESSION['hal'] = 'buka';
} else if($_GET['hal'] == "tutup"){
	$_SESSION['hal'] = 'tutup';
}



?>
<?php include "view/sidebar.php"; ?>
<?php if ($_SESSION['hak_akses'] == 'admin')
		{ ?>
			<?php include "view/admin_v.php"; ?>
		<?php } ?>	
<?php if ($_SESSION['hak_akses'] == 'pasien')
		{ ?>
			<?php include "view/pasien_v.php"; ?>
		<?php }	?>	
<?php if ($_SESSION['hak_akses'] == 'dokter')
		{ ?>
			<?php include "view/dokter_v.php"; ?>
		<?php }	?>
			
<?php include "view/footer.php"; ?>