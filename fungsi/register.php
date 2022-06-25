<!DOCTYPE html>
<html>
<head>
	<title>E-Klinik</title>

</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<?php
    // --- koneksi ke database
    $koneksi = mysqli_connect("localhost","root","","e_klinik") or die(mysqli_error($koneksi));

    // --- Fungsi daftar pasien (Create)
    function daftar($koneksi){
        
        if (isset($_POST['btn_simpan'])){
            
            $nama = $_POST['nama'];
            $tgl_lahir = $_POST['tgl_lahir'];
            $alamat = $_POST['alamat'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            
            if(!empty($nama) && !empty($tgl_lahir) && !empty($alamat) && !empty($username) && !empty($password)){
                $sql = "INSERT INTO user (username, password, hak_akses) VALUES('$username','$password','pasien');INSERT INTO pasien (nama, tgl_lahir, alamat, user_id) VALUES('$nama','$tgl_lahir','$alamat', LAST_INSERT_ID()) ";
                $simpan = mysqli_multi_query($koneksi, $sql);
                if($simpan ){
                    
                        header('location: ../index.php');
                   
                }
            } else {
                $pesan = "Tidak dapat mendaftar, data belum lengkap!";
            }
        }
        
        ?>
     <div class="continer m-4 mt-5">
         <div class="row">
             <div class="col-md-6 mx-auto">
                 <!-- view Daftar Pasien -->
                 <form method="POST">
                     <fieldset>
                         <legend><h2>Daftar Pasien</h2></legend>
                         <p>
                             <?php echo isset($pesan) ? $pesan : "" ?>
                         </p>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="nama">
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="exampleFormControlInput1"  name="tgl_lahir">
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="alamat">
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"  name="username">
                            </div>
                            <div class="mb-1">
                                <label for="exampleFormControlInput1" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword"  name="password">
                                <br><input type="checkbox" onclick="myFunction()"> Tampilkan Password
                            </div>
                            <br>
                            <label>
                                <input class="btn btn-primary" type="submit" name="btn_simpan" value="Simpan"/>
                                <input class="btn btn-secondary" type="reset" name="reset" value="Bersihkan"/>
                            </label>
                            <br>
                        </fieldset>
                    </form>
             </div>
         </div>
     </div>
    <?php
    }



    // --- Program Utama
    if (isset($_GET['aksi'])){
        switch($_GET['aksi']){
            case "create":
                echo '<a href="index.php"> &laquo; Home</a>';
                daftar($koneksi);
                break;
            default:
                echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
                daftar($koneksi);

        }
    } else {
        daftar($koneksi);

    }

?>
<script>
    function myFunction() {
        var x = document.getElementById("inputPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>