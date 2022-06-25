<?php
	$page = "pembayaran";
?>
<?php
error_reporting(0);
session_start();
include "../fungsi/session.php";
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
						document.location='pembayaran.php';
				     </script>";
	}
	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		//Pengujian Apakah data akan diedit atau disimpan baru
		if($_GET['hal'] == "edit")
		{
			//Data akan di edit
			$edit = mysqli_query($koneksi, "UPDATE berobat set
											pasien_id = '$_POST[pasien_id]',
												tgl_berobat = '$_POST[tgl_berobat]',
												dokter_id = '$_POST[dokter_id]',
											    keluhan = '$_POST[keluhan]',
												biaya = '$_POST[biaya]'
											WHERE no_transaksi = '$_GET[no_transaksi]'
										");
			if($edit) //jika edit sukses
			{
				echo "<script>
						alert('Edit data suksess!');
						document.location='pembayaran.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Edit data GAGAL!!');
						document.location='pembayaran.php';
				     </script>";
			}
		}
		else
		{
		
		
			//Data akan disimpan Baru
			$qry= "UPDATE berobat set
			dokter_id = '$_POST[dokter_id]',
			biaya = '$_POST[biaya]',
			status = 'Bayar'
			WHERE id= '$_GET[id]' ";
			
			$simpan = mysqli_query($koneksi, $qry);
			
			if($simpan ) //jika simpan sukses
			{
				$delete1 = mysqli_query($koneksi,"DELETE FROM reservasi WHERE pasien_id = '$_POST[pasien_id]'");
				if ($delete1) {
					echo "
						
						<script>	
						alert('Simpan data suksess!');
						document.location='pembayaran.php';
				     </script>";
				}else{
					echo "<script>	
						alert('Gagal!');
						document.location='pembayaran.php';
				     </script>";
				}
			}
			else
			{
				echo "<script>
						alert('Simpan data GAGAL!!');
						document.location='pembayaran.php';
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
			$tampil = mysqli_query($koneksi, "SELECT b.*, p.nama as nama_pasien, d.nama as nama_dokter FROM berobat b, pasien p, dokter d WHERE b.pasien_id = p.id AND b.dokter_id =d.id AND no_transaksi = '$_GET[no_transaksi]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$pasien_id = $data['pasien_id'];
				$tgl_berobat = $data['tgl_berobat'];
				$dokter_id = $data['dokter_id'];
				$keluhan = $data['keluhan'];
				$biaya = $data['biaya'];
			}
		}
		else if ($_GET['hal'] == "hapus")
		{
			//Persiapan hapus data
			$hapus = mysqli_query($koneksi, "DELETE FROM berobat WHERE id = '$_GET[id]' ");
			if($hapus){
				echo "<script>
						alert('Hapus Data Suksess!!');
						document.location='pembayaran.php';
				     </script>";
			}
		}
		else if ($_GET['hal'] == "proses")
		{
			$tampil = mysqli_query($koneksi, "SELECT b.*, p.nama_pasien FROM berobat b, pasien p WHERE b.pasien_id = p.id  AND b.id = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$nama_pasien = $data['nama_pasien'];
				$pasien_id = $data['pasien_id'];
			}
		}
		else if ($_GET['hal'] == "konfirmasi")
		{
			$tampil = mysqli_query($koneksi, "SELECT b.*, p.nama_pasien FROM berobat b, pasien p WHERE b.pasien_id = p.id  AND b.id = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				//Jika data ditemukan, maka data ditampung ke dalam variabel
				$nama_pasien = $data['nama_pasien'];
			}

			$simpan = mysqli_query($koneksi, "UPDATE berobat set status = 'Lunas' WHERE id='$_GET[id]'");
			if($simpan) //jika simpan sukses
			{
				echo "<script>
						alert('Pembayaran suksess!');
						document.location='pembayaran.php';
				     </script>";
			}
			else
			{
				echo "<script>
						alert('Pembayaran GAGAL!!');
						document.location='pembayaran.php';
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
<?php include "header.php"; ?>
<body class="bg-abu">
<div class="container mt-5 pl-5">
<?php include "sidebar.php"; ?>


	<h1 class="text-center white">Data Pembayaran</h1>
		<?php	$tamp = mysqli_query($koneksi, "SELECT b.* FROM berobat b, pasien p where b.pasien_id = p.id AND p.user_id = $_SESSION[id]  ");
		while($da= mysqli_fetch_array($tamp)){
		if ($da['status'] == 'Bayar' && $_SESSION['hak_akses'] == 'pasien') {
		?>
			
			<h4>Keterangan : Silahkan Menuju Kasir Untuk melakukan Pembayaran</h4>
		<?php } }?>
	<div class="row">
		<!-- Awal Card Form -->
		<?php if ($_SESSION['hak_akses'] == 'dokter')
				{
			?>
			<div class="col-md-3">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Kelola Data Pembayaran
				</div>
				<div class="card-body">
					<form method="post" action="">
					
						<div class="form-group">
                            <label>Nama dokter</label>
							<select class="form-control" name="dokter_id">
                                <option value="<?=@$dokter_id?>"><?=@$nama_dokter?></option>
								<?php
									$tampil = mysqli_query($koneksi, "SELECT * from dokter ORDER BY id desc");
									while($data = mysqli_fetch_array($tampil)) {
								?>
								<option value=<?=$data['id']?>><?=$data['nama_dokter']?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Biaya</label>
							<input type="number" name="biaya" value="<?=@$biaya?>" class="form-control" required oninvalid="this.setCustomValidity('Masukan ini tidak boleh kosong')" oninput="setCustomValidity('')">
						</div>
						<div class="form-group">
                            <label>Nama Pasien</label>
							<select class="form-control" name="pasien_id" readonly>
                                <option value="<?=@$pasien_id?>"><?=@$nama_pasien?></option>
								<?php
									$tampil = mysqli_query($koneksi, "SELECT * from pasien ORDER BY id desc");
									while($data = mysqli_fetch_array($tampil)) {
								?>
								<option value=<?=$data['id']?>><?=$data['nama_pasien']?></option>
								<?php } ?>
							</select>
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
	
			<div class="col-md-9">
				<div class="card mt-3 border-0">
				<div class="card-header bg-ijo text-white">
					Data Pembayaran
				</div>
	
				<div class="card-body">
					
					<table class="hover" id="table" style="width:100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Pasien</th>
								<th>Tgl. berobat</th>
								<th>Nama Dokter</th>
								<th>Keluhan</th>
								<th>Biaya</th>
								<th>Status</th>
								<?php if ( $_SESSION['hak_akses'] == 'dokter')
									{
								?>
								<th>Aksi</
								th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
			
								$no = 1;
								$tampil;
						
										
								$tamp = mysqli_query($koneksi, "SELECT * FROM berobat  ");
								while($da= mysqli_fetch_array($tamp)) {
									

									if($da['status'] ==='menunggu'){
											
											if ($_SESSION['hak_akses'] == 'pasien' )
											{
											
											$tampil = mysqli_query($koneksi, "SELECT b.*, p.nama_pasien, d.nama_dokter FROM berobat b LEFT JOIN pasien p ON p.id = b.pasien_id LEFT JOIN dokter d ON d.id=b.dokter_id  WHERE p.user_id= '$_SESSION[id]' ");
											}else{
										
												$tampil = mysqli_query($koneksi, "SELECT b.*, p.nama_pasien, d.nama_dokter FROM berobat b LEFT JOIN pasien p ON p.id = b.pasien_id LEFT JOIN dokter d ON d.id=b.dokter_id group by b.id desc");
											}
									}else{
										
											if ($_SESSION['hak_akses'] == 'pasien' )
											{
											
											$tampil = mysqli_query($koneksi, "SELECT b.*, p.nama_pasien, d.nama_dokter FROM berobat b LEFT JOIN pasien p ON p.id = b.pasien_id LEFT JOIN dokter d ON d.id=b.dokter_id where  p.user_id= '$_SESSION[id]'  ");
											
											}else{
										
												$tampil = mysqli_query($koneksi, "SELECT b.*, p.nama_pasien, d.nama_dokter FROM berobat b LEFT JOIN pasien p ON p.id = b.pasien_id LEFT JOIN dokter d ON d.id=b.dokter_id group by b.id desc");
											}
									}

								}

								while	($data = mysqli_fetch_array($tampil)){
								
								
							
									
							?>
							<tr>
								<td><?=$no++;?></td>
								<td><?=$data['nama_pasien']?></td>
								<td><?=$data['tgl_berobat']?></td>
								<td><?=$data['nama_dokter']?></td>
								<td><?= $data['keluhan']?></td>
								<td><?= "Rp.".$data['biaya']?></td>
								<td><?=$data['status']?></td>
								<td>
								<?php if ($_SESSION['hak_akses'] == 'dokter')
									{
										if($data['status']== 'menunggu'){
								?>
									<a href="pembayaran.php?hal=proses&id=<?=$data['id']?>" class="btn btn-info btn-atur"> Proses </a>
								<?php }} if ($_SESSION['hak_akses'] == 'admin' )
									{
										if($data['status']== 'Bayar'){

								?>
									<a href="pembayaran.php?hal=konfirmasi&id=<?=$data['id']?>" class="btn btn-info btn-atur"> Konfirmasi Pembayaran </a>
									<?php }?>
									<!-- <a href="pembayaran.php?hal=edit&no_transaksi=<?=$data['no_transaksi']?>" class="btn btn-info btn-atur"> edit </a>
									<a href="pembayaran.php?hal=hapus&id=<?=$data['id']?>" 
									onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger btn-atur"> hapus </a> -->
								<?php } ?>
								</td>
							</tr>
							<?php  } //penutup perulangan while ?>
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

