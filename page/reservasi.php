<?php
	$page = "reservasi";
?>
<?php
error_reporting(0);
session_start();
include"./fungsi/session.php";
?>

<?php
	//Koneksi Database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "e_klinik";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));
	if (isset($_POST['breset']))
	{
		echo "<script>
						document.location='reservasi.php';
				     </script>";
	}
	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE reservasi set
											 	tgl_reservasi = '$_POST[tgl_reservasi]',
											 	pasien_id = '$_POST[pasien_id]',
												dokter_id = '$_POST[dokter_id]',
											 	status = '$_POST[status]'
											 WHERE id = '$_GET[id]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='reservasi.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='reservasi.php';
				     </script>";
			}
		}
		else
		{
			$tampil = mysqli_query($koneksi, "SELECT id FROM pasien WHERE user_id = '$_SESSION[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				$pasien_id = $data['id'];
			}
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO berobat (pasien_id, tgl_berobat,keluhan, status)
										  VALUES ('$pasien_id', 
										  		 NOW(),
												   '$_POST[keluhan]',
										  		 'menunggu')
										 ");
			$simpan1 = mysqli_query($koneksi, "INSERT INTO reservasi ( tgl_reservasi,pasien_id, status)
											VALUES ( NOW(),
													'$pasien_id',
													'menunggu')
										");					 
			if($simpan && $simpan1) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='pembayaran.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='reservasi.php';
				     </script>";
			}
		}


		
	}


	//Pengujian jika tombol Edit / Hapus di klik
	if(isset($_GET['hal']))
	{
		//Pengujian jika edit Data
		if($_GET['hal'] == "edit")
		{
			//Tampilkan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT r.*, p.nama as nama_pasien, p.id AS pasien_id, d.nama as nama_dokter, d.id AS dokter_id FROM reservasi r, pasien p, dokter d WHERE r.pasien_id = p.id AND r.dokter_id = d.id AND r.id='$_GET[id]'");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$tgl_reservasi = $data['tgl_reservasi'];
				$nama_pasien = $data['nama_pasien'];
				$nama_dokter = $data['nama_dokter'];
				$status = $data['status'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM reservasi WHERE id = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='reservasi.php';
				     </script>";
			}
		}
	}

?>

<?php include "header.php"; ?>



<div class="container mt-5 pl-5">

<?php include "sidebar.php"; ?>

	<h1 class="text-center white">Reservasi</h1>
	<div class="row">
		<!-- Awal Card Form -->
		
			<div class="col-md-8  mx-auto mr-12">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Masukkan Keluhan
				</div>
				<div class="card-body">
					<form method="post" action="">
					<div class="form-group">
							<label>Keluhan</label>
							<input type="text" name="keluhan" value="<?=@$keluhan?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>	
					
						<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
						<button  class="btn btn-secondary" name="breset">Kosongkan</button>

					</form>
				</div>
				</div>
			</div>
	
		<!-- Akhir Card Form -->
	
		<!-- Awal Card Tabel -->
			<!-- <div class="col-mx-8">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Data Revervasi
				</div>
				<div class="card-body">
					
					<table class="hover" id="table" style="width:100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Tgl. Reservasi</th>
								<th>Nama Pasien</th>
								<th>Status</th>
								<?php if ($_SESSION['hak_akses'] == 'admin')
									{
								?>
								<th>Aksi</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								$tampil = mysqli_query($koneksi, "SELECT r.*, p.nama_pasien FROM reservasi r LEFT JOIN pasien p ON p.id = r.pasien_id   WHERE p.user_id= '$_SESSION[id]' AND r.status='menunggu'");
								while($data = mysqli_fetch_array($tampil)) {
			
							?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$data['tgl_reservasi']?></td>
								<td><?=$data['nama_pasien']?></td>
								<td><?=$data['status']?></td>
								<td>
								<?php if ($_SESSION['hak_akses'] == 'admin')
									{
								?>
									<a href="reservasi.php?hal=edit&id=<?=$data['id']?>" class="btn btn-info btn-atur"> edit </a>
									<a href="reservasi.php?hal=hapus&id=<?=$data['id']?>" 
									onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger btn-atur"> hapus </a>
								<?php } ?>
								</td>
							</tr>
							<?php }; //penutup perulangan while ?>
						</tbody>
					</table>
		
				</div>
				</div> -->
			</div>
		<!-- Akhir Card Tabel -->

		</div>

	</div>
</div>
<?php include "footer.php"; ?>

