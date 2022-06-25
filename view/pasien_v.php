
<?php
error_reporting(0);
session_start();
include "/fungsi/session.php";
?>
<?php if ($_SESSION['hak_akses'] == 'pasien')
	{
?>


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
                        $id = $_SESSION['id'];
                      
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT count(*) as total from hpl h,pasien p WHERE h.pasien_id = p.id AND p.user_id = $id ");
                        $data = mysqli_fetch_array($tampil);
                        echo "<h3>" .$data['total']. "</h3>";
						
                    ?>
                  <span>HPL</span> <br>
                  <a href="./page/HPL.php" class="btn btn-success btn-sm active" role="button" aria-pressed="true">LIHAT</a>
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
                <span>Jumlah</span> <br>
                <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT COUNT(status) as status FROM reservasi WHERE status ='menunggu'");
						$data = mysqli_fetch_array($tampil);
						echo "<h3>" .$data['status']. "</h3>";
						
                    ?>
                  <span>Pasien dalam antrian</span> <br>
                 
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
                <span>Nomer</span> <br>
                <?php
                 
                $tampil = mysqli_query($koneksi, "SELECT b.id FROM pasien p, reservasi b WHERE p.user_id = '$_SESSION[id]' AND p.id=b.pasien_id AND b.status='menunggu' ");
                $data = mysqli_fetch_array($tampil);
                echo "<h3>" .$data['id']. "</h3>";
              
                    ?>
                <span>Antrian Anda</span> <br>
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
                <span>Nomer</span> <br>
                <?php
                $tampil = mysqli_query($koneksi, "SELECT id FROM reservasi  WHERE  status='menunggu' group by id ASC");
                $data = mysqli_fetch_array($tampil);
                echo "<h3>" .$data['id']. "</h3>";
                    ?>
                <span>Antrian Saat ini</span> <br>
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
                    
                  <span>DAFTAR BEROBAT</span> <br>
                  <a href="./page/reservasi.php" class="btn btn-success btn-sm active" role="button" aria-pressed="true">BEROBAT</a>
                </div>
                <div class="align-self-center">
                  <i class="icon-user success font-large-2 float-right"></i>
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




<?php
	}
	else{
		header('Location:../index.php');
	}
?>