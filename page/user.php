<?php
	$page = "user";
?>
<?php
error_reporting(0);
session_start();
include"./fungsi/session.php";
?>
<?php if ($_SESSION['hak_akses'] == 'admin')
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
						document.location='user.php';
				     </script>";
	}
	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE user set
											 	username = '$_POST[username]',
											 	password = '$_POST[password]',
												status = '$_POST[status]',
											 	hak_akses = '$_POST[hak_akses]'
											 WHERE id = '$_GET[id]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='user.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='user.php';
				     </script>";
			}
		}
		else
		{
			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO user (username, password, status, hak_akses)
										  VALUES ('$_POST[username]', 
										  		 '$_POST[password]', 
										  		 '$_POST[status]', 
										  		 '$_POST[hak_akses]')
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='user.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='user.php';
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
			$tampil = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$username = $data['username'];
				$password = $data['password'];
				$status = $data['status'];
				$hak_akses = $data['hak_akses'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM user WHERE id = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='user.php';
				     </script>";
			}
		}
	}

?>

<?php include"header.php"; ?>


<?php
 if(isset($_GET['pesan'])){
  if($_GET['pesan']=="gagal"){
   echo "<div class='alert'>Username dan Password Salah !</div>";
  }
 }
 ?>

<body class="bg-abu">
<div class="container mt-5 ml-5">

<?php include"sidebar.php"; ?>

	<h1 class="text-center white">Data User</h1>
	<div class="row">
		<!-- Awal Card Form -->
			<div class="col-mx-4 mr-3">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Kelola Data User
				</div>
				<div class="card-body">
					<form method="post" action="">
						<div class="form-group">
							<label>username</label>
							<input type="text" name="username" value="<?=@$username?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
						<div class="form-group">
							<label>password</label>
							<input id ="inpupassword" type="password" name="password" value="<?=@$password?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
							<br><input type="checkbox" onclick="myFunction()"> Tampilkan Password
						</div>
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="status">
								<option value="<?=@$status?>"><?=@$status?></option>
								<option value="accepted">Accepted</option>
								<option value="denied">Denied</option>
							</select>
						</div>
						<div class="form-group">
							<label>Hak Akses</label>
							<select class="form-control" name="hak_akses">
								<option value="<?=@$hak_akses?>"><?=@$hak_akses?></option>
								<option value="admin">admin</option>
								<option value="pasien">pasien</option>
								<option value="dokter">dokter</option>
							</select>
						</div>

						<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
						<button  class="btn btn-secondary" name="breset">Kosongkan</button>

					</form>
				</div>
				</div>
			</div>
		<!-- Akhir Card Form -->

		<!-- Awal Card Tabel -->
			<div class="col-mx-8">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Data User
				</div>
				<div class="card-body">
					
					<table class="hover" id="table" style="width:100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>username</th>
								<th>password</th>
								<th>status</th>
								<th>Hak Akses</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								$tampil = mysqli_query($koneksi, "SELECT * from user ORDER BY status='denied' desc");
								while($data = mysqli_fetch_array($tampil)) {
			
							?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$data['username']?></td>
								<td onclick="myFunction()"><input width="50px" id ="inpupassword" type="password" class="border-0" value="<?=$data['password']?>" disabled></td>
								<td><?=$data['status']?></td>
								<td><?=$data['hak_akses']?></td>
								<td>
									<a href="user.php?hal=edit&id=<?=$data['id']?>" class="btn btn-info"> edit </a>
									<a href="user.php?hal=hapus&id=<?=$data['id']?>" 
									onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger btn-atur"> hapus </a>
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