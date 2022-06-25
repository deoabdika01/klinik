<?php
	$page = "hpl";
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
						document.location='hpl.php';
				     </script>";
	}
	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE hpl set
										        siklus_haid = '$_POST[siklus_haid]',
												tgl_haid = '$_POST[tgl_haid]',
												pasien_id = '$_POST[pasien_id]'
			
											 WHERE id_hpl = '$_GET[id_hpl]'
										   ");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='hpl.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='hpl.php';
				     </script>";
			}
		}
		else
		{
							$in = $_POST["siklus_haid"];
							$in2 = $_POST["tgl_haid"];
							
							$hari =date("d F Y",strtotime($in2));
						
							$mount = date("m",strtotime($in2));
							$years1 = date("Y", strtotime($hari));
							// Rumus HPl Januari - Maret 
							if ($in == 28) {
								if(01 <= $mount && $mount <= 03){
									$day1 = date("d", strtotime("+7 days", strtotime($hari)));
									$mount1 = date("F ", strtotime("+9 month", strtotime($hari)));
									$years1 = date("Y", strtotime($hari));;
									$tgl_haid= $day1.$mount1.$years1;
									$tgl_haid1 = date("d F Y",strtotime($tgl_haid));
									
								}
								
								// //Rumus HPl APRIL - DESEMBER 
								else if(04 <= $mount && $mount <= 12){
									$day1 = date("d", strtotime("+7 days", strtotime($hari)));
									$mount1 = date("F ", strtotime("-3 month", strtotime($hari)));
									$years1 = date("Y", strtotime("+1 year", strtotime($hari)));
									$tgl_haid= $day1.$mount1.$years1;
									$tgl_haid1 = date("d F Y",strtotime($tgl_haid));
									
									
								}
							}else{
								$mount1 = date("d F Y", strtotime("+9 month", strtotime($hari)));
								$tot = $in-21;
								$tgl_haid1= date("d F Y", strtotime("+".$tot."days", strtotime($mount1)));
							
								
							}

			//Tampilkan Data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT id FROM pasien WHERE user_id = '$_SESSION[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				$pasien_id = $data['id'];
			}

			//Data akan disimpan Baru
			$simpan = mysqli_query($koneksi, "INSERT INTO hpl (siklus_haid, tgl_haid, pasien_id, hasil)
										  VALUES ('$_POST[siklus_haid]', 
												'$hari', 
										  		'$pasien_id', 
												  '$tgl_haid1')
										 ");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Simpan data suksess!');
						document.location='hpl.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Hapus data GAGAL!!');
						document.location='hpl.php';
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
			$tampil = mysqli_query($koneksi, "SELECT * FROM hpl WHERE id_hpl = '$_GET[id_hpl]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$siklus_haid = $data['siklus_haid'];
				$tgl_haid = $data['tgl_haid'];
				$pasien_id = $data['pasien_id'];
				$hasil = $data['hasil'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM hpl WHERE id_hpl = '$_GET[id_hpl]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='hpl.php';
				     </script>";
			}
		}
	}

?>




<?php
 if(isset($_GET['pesan'])){
  if($_GET['pesan']=="gagal"){
   echo "<div class='alert'>Username dan Password Salah !</div>";
  }
 }
 ?>
<?php include"header.php"; ?>
<body class="bg-abu">
<div class="container mt-5 pl-5">
<?php include"sidebar.php"; ?>


	<h1 class="text-center white">Data HPL</h1>
	<div class="row">
		<!-- Awal Card Form -->
			<div class="col-md-4">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Kelola Data HPL
				</div>
				<div class="card-body">
					<form method="post" action="">
						<div class="form-group">
                            <label>Siklus Haid</label>
							<select class="form-control" name="siklus_haid">
                                <option value="<?=@$siklus_haid?>"><?=@$siklus_haid?></option>
								<?php
								for ($i=20; $i <= 42 ; $i++) {
								
									echo "<option value=".$i.">".$i."</option>";
								}
								?>
							</select>
						</div>
                        <div class="form-group">
							<label>Tanggal Haid</label>
							<input type="date" name="tgl_haid" value="<?=@$tgl_haid?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
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
					Data HPL
				</div>
				<div class="card-body">
						<table class="hover" id="table" style="width:100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Siklus Haid</th>
								<th>Tanggal</th>
								<th>Pasien</th>
								<th>Hasil</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$id = $_SESSION['id'];
							$no = 1;
							if ($_SESSION['hak_akses'] == 'admin' || $_SESSION['hak_akses'] == 'dokter')
								{
									$tampil = mysqli_query($koneksi, "SELECT h.*, p.nama_pasien FROM hpl h, pasien p WHERE h.pasien_id = p.id ");
								}else{
									$tampil = mysqli_query($koneksi, "SELECT h.*, p.nama_pasien, p.user_id FROM hpl h, pasien p WHERE h.pasien_id = p.id AND p.user_id = $id");

								}
								$no = 1;
								while($data = mysqli_fetch_array($tampil)) {
			
							?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$data['siklus_haid']?></td>
								<td><?=$data['tgl_haid']?></td>
								<td><?=$data['nama_pasien']?></td>
								<td><?=$data['hasil']?></td>
								<td>
									<a href="hpl.php?hal=hapus&id_hpl=<?=$data['id_hpl']?>" 
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
<?php include "footer.php"; ?>
