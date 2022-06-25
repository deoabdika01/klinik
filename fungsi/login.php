<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "e_klinik";

$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));


if (isset($_POST['login'])) 
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = mysqli_query($koneksi, "SELECT * FROM user where username = '$username' and password = '$password' ");
	$data = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) > 0 ){
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['hak_akses'] = $data['hak_akses'];
		$_SESSION['status'] = $data['status'];
		$_SESSION['id']=$data['id'];

		header('Location:../index.php');
	}
	else{
    echo "<script>
            alert('Username atau Password Salah');
            document.location='login.php';
             </script>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>e-klinik</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<script>
		function myFunction() 
		{
			var x = document.getElementById("myInput");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
</script>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

* {
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.flex-r,
.flex-c {
  justify-content: center;
  align-items: center;
  display: flex;
}
.flex-c {
  flex-direction: column;
}
.flex-r {
  flex-direction: row;
}

.container {
  width: 100%;
  min-height: 100vh;
  padding: 20px 10px;
  background: #e5e5e5;
}

.login-text {
  background-color: #f6f6f6;
  max-width: 400px;
  min-height: 500px;
  border-radius: 10px;
  padding: 10px 20px;
}

.logo {
  margin-bottom: 20px;
}
.logo span,
.logo span i {
  font-size: 25px;
  color: #0d8aa7;
}

.login-text h1 {
  font-size: 25px;
}
.login-text p {
  font-size: 15px;
  color: #000000b2;
}

form {
  align-items: flex-start !important;
  width: 100%;
  margin-top: 15px;
}

.input-box {
  margin: 10px 0px;
  width: 100%;
}
.label {
  font-size: 15px;
  color: black;
  margin-bottom: 3px;
}
.input {
  background-color: #f6f6f6;
  padding: 0px 5px;
  border: 2px solid rgba(216, 216, 216, 1);
  border-radius: 10px;
  overflow: hidden;
  justify-content: flex-start;
}

input {
  border: none;
  outline: none;
  padding: 10px 5px;
  background-color: #f6f6f6;
  flex: 1;
}
.input i {
  color: rgba(0, 0, 0, 0.4);
}

.check span {
  color: #000000b2;
  font-size: 15px;
  font-weight: bold;
  margin-left: 5px;
}

.btn {
  color: #ffffff;
  border-radius: 30px;
  padding: 10px 15px;
  background: linear-gradient(122.33deg, #34eb89 30.62%, #34eb59 100%);
  margin-top: 30px;
  margin-bottom: 10px;
  font-size: 16px;
  transition: all 0.3s linear;
  width: 100%;
}

.btn:hover {
  transform: translateY(-2px);
  background: linear-gradient(122.33deg, #0dac57 30.62%, #34eb59 100%);
  color: #ffffff;
}
.extra-line {
  font-size: 15px;
  font-weight: 600;
}
.extra-line a {
  color: #0095b6;
}

.standard-btn {
  text-decoration:none;
  border: 2px solid #00ACEC;
  padding:10px 20px 10px 20px;
  border-radius:2px;
  color:#00ACEC;
  margin:5px;
  width: 100% !important;
}
.standard-btn:hover {
  color:#FFFFFF;
  background-color:#00acec;
}
  </style>
</head>
<body class="bg">

<div class=" flex-r container">
    <div class="flex-r login-wrapper">
      <div class="login-text">
        <div class="logo">
          <span>Klinik Dr Samidjan</span>
		</div>		

        <form class="flex-c" action="" method="post">
          <div class="input-box">
            <span class="label">Username</span>
            <div class=" flex-r input">
              <input type="text" placeholder="username" name ="username">
              <i class="fas fa-user"></i>
            </div>
          </div>
          <div class="input-box">
            <span class="label">Password</span>
            <div class="flex-r input">
              <input type="password" placeholder="8+ (a, A, 1, #)" id="myInput" name ="password">
              <i class="fas fa-lock"></i>
            </div>
          </div>
          <div class="check">
            <input type="checkbox" name="" id="" onclick="myFunction()" >
            <span>Show Password</span>
          </div>
          <input class="btn" type="submit" name="login" value="LOGIN">
          <span class="extra-line">
            <span>Belum punya akun?</span><br><br>
            <a class="standard-btn" href="register.php">Sign In</a>
          </span>
        </form>

      </div>
    </div>
  </div>
</body>
</html>
