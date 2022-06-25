<?php
error_reporting(0);
session_start();
include "./fungsi/session.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Klinik Dr Samidjan</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- <link rel="stylesheet" type="text/css" href="fontawesome/css/all.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="./style.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
	<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">

</head>
<style>
    .bg-ijo{
		background-color: #04aa6d;
	}
	.ukuran{
		width:110px;
	}
	.bg{
		background-color: #f0f1f4;
	}
	.nav-blue{
        width:150px;
        height:100%;
		box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.67);
		color: black !important;
        }   
	.nav-header{
        width:100%;
        height:90px;
		box-shadow: 0 0 20px  rgba(0, 0, 0, 0.67);
		color: black !important;
        }   
	.aktif{
        font-weight:bold;
        width:100%;
		border-radius: 0px 0px 0px 0px;
		color:#000000!important;
		background-color:#ffffff;
	}
	.aktif1{
		border-radius: px 0px 0px 0px;
        
		color:#ffffff;
	}
	.mt-10{
		margin-top:30px;
	}
	.nav-link:hover {
        color:#000!important;
		background-color:#ffffff;
	}
    .px-me{
        padding-left: 190px;
    }
    .pt-10{
        padding-top:130px;
    }
    .font-size{
        font-size: 19px;
    }
   
</style>

</head>
<body class="bg">
<nav class="navbar navbar-light bg-light nav-header px-me">
    <h3>Selamat Datang 
        <?php if ($_SESSION['hak_akses'] == 'admin'){ ?>Admin<?php }	?>
        <?php if ($_SESSION['hak_akses'] == 'dokter'){ ?>Dokter<?php }	?>
        <?php if ($_SESSION['hak_akses'] == 'pasien'){ ?>Pasien<?php }	?>
    </h3>
    <a class="mx-5 text-dark t-hover font-weight-bold" href="../fungsi/logout.php"><i width="30" data-feather="log-out"></i> Logout</a>
</nav>
<div class="container mt-5 pl-5">