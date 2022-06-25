<?php
	$page = "dokter";
?>
<?php
error_reporting(0);
session_start();
include "./fungsi/session.php";
?>
<?php if ($_SESSION['hak_akses'] == 'admin' || $_SESSION['hak_akses'] == 'dokter')
	{
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
						document.location='dokter.php';
				     </script>";
	}
	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE dokter set
											 	nama_dokter = '$_POST[nama_dokter]',
											 	no_hp = '$_POST[no_hp]'
											 WHERE id = '$_GET[id]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='dokter.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='dokter.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO dokter (nama_dokter, no_hp)
										  VALUES ('$_POST[nama_dokter]', 
										  		 '$_POST[no_hp]' 
										  		 )
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='dokter.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='dokter.php';
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
			$tampil = mysqli_query($koneksi, "SELECT * FROM dokter WHERE id = '$_GET[id]'");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$nama_dokter = $data['nama_dokter'];
				$no_hp = $data['no_hp'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM dokter WHERE id = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='dokter.php';
				     </script>";
			}
		}
	}

?>

<?php include"header.php"; ?>



<div class="container mt-5 pl-5">

<?php include"sidebar.php"; ?>

	<h1 class="text-center white">Data Dokter</h1>
	<div class="row">
		<!-- Awal Card Form -->
		<?php if ($_SESSION['hak_akses'] == 'admin')
			{
		?>
			<div class="col-md-4">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Kelola Data Dokter
				</div>
				<div class="card-body">
					<form method="post" action="">
						<div class="form-group">
							<label>Nama Dokter</label>
							<input type="text" name="nama_dokter" value="<?=@$nama_dokter?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
						<div class="form-group">
							<label>Nomor HP</label>
							<input type="text" name="no_hp" value="<?=@$no_hp?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>

						<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
						<button  class="btn btn-secondary" name="breset">Kosongkan</button>

					</form>
				</div>
				</div>
			</div>
		<?php }?>
		<!-- Akhir Card Form -->

		<!-- Awal Card Tabel -->
			<div class="col-md-8">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Data Dokter
				</div>
				<div class="card-body">
					
					<table class="hover" id="table" style="width:100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Dokter</th>
								<th>Nomor HP</th>
								
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
								$tampil = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY id desc");
								while($data = mysqli_fetch_array($tampil)) {
			
							?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$data['nama_dokter']?></td>
								<td><?=$data['no_hp']?></td>
								
								<td>
								<?php if ($_SESSION['hak_akses'] == 'admin')
									{
								?>
									<a href="dokter.php?hal=edit&id=<?=$data['id']?>" class="btn btn-info btn-atur"> edit </a>
									<a href="dokter.php?hal=hapus&id=<?=$data['id']?>" 
									onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger btn-atur"> hapus </a>
								<?php } ?>
								</td>
							</tr>
							<?php }; //penutup perulangan while ?>
						</tbody>
					</table>
		
				</div>
				</div>
			</div>
		<!-- Akhir Card Tabel -->

		</div>

	</div>
</div>
<?php include"footer.php"; ?>

<?php
	}
	else{
		header('Location:../index.php');
	}
?>

