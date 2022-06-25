<div class="position-fixed ukuran">
	<nav class="nav nav-blue bg-ijo pt-3 fixed-top nav-ukuran flex-column">
		<p class="font-size px-3 text-white font-weight-bold" href="#">Klinik <br> Dr. Samidjan</p>
		
		<a class="mt-10 nav-link text-white font-weight-bold" href="../index.php"><i width="15" data-feather="monitor"></i> Beranda</a>
		<?php if ($_SESSION['hak_akses'] == 'admin'){ ?>
			<a class="nav-link  <?php if($page == "user") echo "aktif";?> text-white font-weight-bold "  href="user.php"><i width="15" data-feather="user"></i> User</a>
		<?php } ?>
		<?php if ($_SESSION['hak_akses'] == 'dokter' || $_SESSION['hak_akses'] == 'admin'){ ?>
		<a class="nav-link <?php if($page == "pasien") echo "aktif";?> text-white font-weight-bold" href="pasien.php"><i width="15" data-feather="users"></i> Pasien</a>
		<?php } ?>
		<?php if ( $_SESSION['hak_akses'] == 'admin'){ ?>
		<a class="nav-link <?php if($page == "dokter") echo "aktif";?> text-white font-weight-bold" href="dokter.php"><i width="15" data-feather="shield"></i> Dokter</a>
		<?php } ?>
		<?php if ($_SESSION['hak_akses'] == 'pasien' || $_SESSION['hak_akses'] == 'dokter' || $_SESSION['hak_akses'] == 'admin'){ ?>
		<a class="nav-link <?php if($page == "pembayaran") echo "aktif";?> text-white font-weight-bold" href="pembayaran.php"><i width="15" data-feather="shopping-cart"></i> Pembayaran</a>
		<?php } if ($_SESSION['hak_akses'] == 'pasien' ){ ?>
		<a class="nav-link <?php if($page == "reservasi") echo "aktif";?> text-white font-weight-bold" href="reservasi.php"><i width="15" data-feather="book"></i> Reservasi</a>
		<?php } ?>
		<?php if ($_SESSION['hak_akses'] == 'pasien' ){ ?>
		<a class="nav-link <?php if($page == "hpl") echo "aktif";?> text-white font-weight-bold" href="hpl.php"><i width="15" data-feather="book"></i> HPL</a>
		<?php } ?>
		<?php if ($_SESSION['hak_akses'] == 'pasien' ){ ?>
			<?php $tampil = mysqli_query($koneksi, "SELECT no_hp FROM dokter LIMIT 1");
			while($data = mysqli_fetch_array($tampil)) { ?>	
				<a class="mt-5 nav-link text-white font-weight-bold" href="https://wa.me/62<?=$data['no_hp']?>">
					<i width="15" data-feather="message-circle"></i> Whatsapp
				</a>
			<?php } ?>
		<?php } ?>
	</nav>
</div>