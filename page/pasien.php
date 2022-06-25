<?php
	$page = "pasien";
?>
<?php
error_reporting(0);
session_start();
include"./fungsi/session.php";
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
						document.location='pasien.php';
				     </script>";
	}
	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE pasien set
											 	nama_pasien = '$_POST[nama_pasien]',
											 	tgl_lahir = '$_POST[tgl_lahir]',
												alamat = '$_POST[alamat]',
											 	user_id = '$_POST[user_id]'
											 WHERE id = '$_GET[id]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='pasien.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='pasien.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO pasien (nama_pasien, tgl_lahir, alamat, user_id)
										  VALUES ('$_POST[nama_pasien]', 
										  		 '$_POST[tgl_lahir]', 
										  		 '$_POST[alamat]', 
										  		 '$_POST[user_id]')
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='pasien.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='pasien.php';
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
			$tampil = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$nama = $data['nama'];
				$tgl_lahir = $data['tgl_lahir'];
				$alamat = $data['alamat'];
				$user_id = $data['user_id'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM pasien WHERE id = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='pasien.php';
				     </script>";
			}
		}
	}

?>

<?php include"header.php"; ?>

<?php include"sidebar.php"; ?>


<div class="container mt-5 pl-5">



	
	<h1 class="text-center white">Data Pasien</h1>

	<div class="row">
		<!-- Awal Card Form -->
			<div class="col-md-4">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Kelola Data Pasien
				</div>
				<div class="card-body">
					<form method="post" action="">
						<div class="form-group">
							<label>Nama Pasien</label>
							<input type="text" name="nama_pasien" value="<?=@$nama?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
						<div class="form-group">
							<label>Tgl. Lahir</label>
							<input type="date" name="tgl_lahir" value="<?=@$tgl_lahir?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" name="alamat" value="<?=@$alamat?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>

						<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
						<button  class="btn btn-secondary" name="breset">Kosongkan</button>

					</form>
				</div>
				</div>
			</div>
		<!-- Akhir Card Form -->

		<!-- Awal Card Tabel -->
			<div class="col-md-8">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Data Pasien
				</div>
				<div class="card-body">
					
					<table class="hover" id="table" style="width:100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Pasien</th>
								<th>Tgl. Lahir</th>
								<th>Alamat</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								$tampil = mysqli_query($koneksi, "SELECT * from pasien ORDER BY id desc");
								while($data = mysqli_fetch_array($tampil)) {
			
							?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$data['nama_pasien']?></td>
								<td><?=$data['tgl_lahir']?></td>
								<td><?=$data['alamat']?></td>
								<td>
									<a href="pasien.php?hal=edit&id=<?=$data['id']?>" class="btn btn-info btn-atur"> edit </a>
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
<?php }?>

