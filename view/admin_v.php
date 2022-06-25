<?php
	$page = "user";
?>
<?php
error_reporting(0);
session_start();
include "/fungsi/session.php";
?>
<?php if ($_SESSION['hak_akses'] == 'admin')
	{
?>


<body class="bg-abu">
<div class="container mt-5 pl-5">

<?php include "sidebar.php"; ?>

<div class="grey-bg container-fluid">
  <section id="minimal-statistics">
    <div class="row">
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT count(*) from berobat where status='menunggu' ORDER BY id desc");
                        $data = mysqli_fetch_array($tampil);
                        echo "<h3>" .$data['count(*)']. "</h3>";
                    ?>
                  <span>Pendaftar yang sedang menunggu</span><br>
                  <a href="./page/user.php" class="btn btn-success btn-sm active" role="button" aria-pressed="true">LIHAT</a>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT count(*) from pasien ORDER BY id desc");
                        $data = mysqli_fetch_array($tampil);
                        echo "<h3>" .$data['count(*)']. "</h3>";
                    ?>
                  <span>Jumlah Pasien</span><br>
                  <a href="./page/pembayaran.php" class="btn btn-success btn-sm active" role="button" aria-pressed="true">LIHAT</a>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT count(*) from berobat  where status='bayar' ORDER BY id desc");
                        $data = mysqli_fetch_array($tampil);
                        echo "<h3>" .$data['count(*)']. "</h3>";
                    ?>
                  <span>Aproval Pembayaran</span><br>
                  <a href="./page/pembayaran.php" class="btn btn-success btn-sm active" role="button" aria-pressed="true">LIHAT</a>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-sm-6 col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                <?php

                     
                    

                        if($_SESSION['hal'] == "buka")
                        {
                              echo "<h3> Buka </h3>";
                        }else {
                          echo "<h3> Tutup </h3>";
                        }

                        if ($_SESSION['hal'] == "tutup") {
                          unset($_SESSION['hal']);
                          $a = mysqli_query($koneksi, "ALTER TABLE reservasi AUTO_INCREMENT = 1");
                        }
                    ?>
                  <span>Status</span><br>
                  <a href="index.php?hal=buka" class="btn btn-success btn-sm active" role="button" aria-pressed="true">BUKA</a>
                  <a href="index.php?hal=tutup" class="btn btn-danger btn-sm active" role="button" aria-pressed="true">TUTUP</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	</section>
</div>


		<!-- Akhir Card Tabel -->

		</div>

	</div>
</div>

<div class="modal fade" id="ubahacc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    
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
                </form>

                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" name="bsimpan">Simpan</button>
                </div>
        </div>
    </div>
</div>


<?php
	}
	else{
		header('Location:../index.php');
	}
?>