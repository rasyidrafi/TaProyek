<?php
session_start();

// membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_kasir");

// cek koneksi database
/* if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } else {
        echo "Koneksi berhasil"; 
    } */

//mengecek apakah form registrasi di submit atau tidak
if (isset($_POST['register'])) {

  $email = strtolower(stripslashes($_POST['email'])); // menghilangkan backshlases dan memaksa user untuk menginputkan huruf kecil
  $email = mysqli_real_escape_string($conn, $email); //cara sederhana mengamankan dari sql injection
  $username = strtolower(stripslashes($_POST['username']));
  $username = mysqli_real_escape_string($conn, $username);
  $password = strtolower(stripslashes($_POST['password']));
  $password = mysqli_real_escape_string($conn, $password);
  $repass = strtolower(stripslashes($_POST['repassword']));
  $repass = mysqli_real_escape_string($conn, $repass);
  //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if( !empty(trim($email)) && !empty(trim($username)) && !empty(trim($password)) && !empty(trim($repass)) ){

            // jika konfirmasi password tidak sama
            if ( $password == $repass) {

                //memanggil method cek_nama untuk mengecek apakah user sudah terdaftar atau belum
                if( cek_email($email,$conn) == 0 ){

                    $pass  = password_hash($password, PASSWORD_DEFAULT); //enkripsi password sebelum disimpan didatabase

                    //insert data ke database
                    $query = "INSERT INTO users (id, email, username, password ) VALUES (NULL,'$email','$username','$pass')";
                    $result   = mysqli_query($conn, $query);
                    $registrasi_info = true;

                    //jika insert data berhasil maka akan menyimpan data username ke session
                    if ($result) {
                        $_SESSION['username'] = $username;
                        $regis = true;

                        header("Location: login.php"); // alihkan ke halaman login
                    
                    //jika gagal maka buatlah variabel berikut :
                    } else {
                      $err1 = true;
                  }
              }else{
                      $err2 = true;
              }
          }else{
              $val = true;
          }
          
      }else {
          $err3 = true;
      }
  } 
    //fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_email($email,$conn){
        $email = mysqli_real_escape_string($conn, $email);
        $query = "SELECT * FROM users WHERE email = '$email'";
        if( $result = mysqli_query($conn, $query) ) return mysqli_num_rows($result);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
  <title>Register Page</title>
  <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet" />
  <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="./assets/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="./assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
  <link href="./assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <link rel="stylesheet" type="text/css" href="./assets/css/forms/theme-checkbox-radio.css" />
  <link rel="stylesheet" type="text/css" href="./assets/css/forms/switches.css" />

  <link rel="stylesheet" href="./assets/css/elements/tooltip.css" />
  <link rel="stylesheet" href="./assets/css/elements/alert.css" />

  <!-- bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- bootstrap icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

  <style>
    .bg-food-random {
      background-image: url("https://zenzapi.xyz/searching/gimage2?query=restaurant%20food&apikey=Rahasia123") !important;
      background-size: cover !important;
      background-position: center !important;
    }
  </style>
</head>

<body class="form">
  <script src="./middleware/index.js"></script>
  <script>
    middleware.redirectIfLogin();
  </script>


  <div class="form-container outer bg-food-random">
    <div class="form-form">
      <div class="form-form-wrap">
        <div class="form-container">
          <div class="form-content shadow-lg p-3 mb-5 bg-body rounded mt-5 px-4">
            <h1 class="">Register</h1>
            <p class="">Register a account to continue.</p>

            <!-- notifikasi error -->
            <?php

            // panggil semua variabel lokal ke variabel global
            global $query;
            global $result;
            global $nama;
            global $err1;
            global $err2;
            global $err3;
            global $val;
            global $username;
            global $password;
            global $validate;
            global $repass;

            // jika registrasi gagal
            if (isset($err1)) : ?>
              <div class="alert alert-danger" role="alert">
                <p>Registrasi akun gagal!</p>
              </div>

            <!-- jika email sudah ada -->
            <?php elseif ( isset($err2) ): ?>
               <div class="alert alert-danger font-weight-bold" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>  
                &nbsp;&nbsp;Email ini sudah digunakan user lain!
               </div>

            <!-- jika salah satu form input kosong -->
            <?php elseif (isset($err3)) : ?>
              <div class="alert alert-danger font-weight-bold" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                &nbsp;&nbsp;Data tidak boleh kosong!
              </div>

            <!-- jika password dan konfirmasi password tidak sama -->
            <?php elseif (isset($val)) : ?>
              <div class="alert alert-danger font-weight-bold" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                &nbsp;&nbsp;Konfirmasi password tidak sama!
              </div>
            <?php endif; ?>

            <!-- form registrasi -->
              <form action="" method="post" class="text-left" >
                <div class="form">

                <!-- kolom email -->
                  <div id="email-field" class="field-wrapper input">
                    <label for="email">EMAIL</label>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-user"
                    >
                      <path
                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                      ></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input
                      id="email"
                      name="email"
                      class="form-control"
                      placeholder="Input Email"
                    />
                  </div>

                  <!-- kolom username -->
                  <div id="username-field" class="field-wrapper input">
                    <label for="username">USERNAME</label>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-user"
                    >
                      <path
                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                      ></path>
                      <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <input
                      id="username"
                      name="username"
                      class="form-control"
                      placeholder="Input username"
                      onkeypress="return event.charCode < 48 || event.charCode  >57"
                    />
                  </div>

                  <!-- kolom password -->
                  <div id="password-field" class="field-wrapper input mb-2">
                    <div class="d-flex justify-content-between">
                      <label for="password">PASSWORD</label>
                    </div>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-lock"
                    >
                      <rect
                        x="3"
                        y="11"
                        width="18"
                        height="11"
                        rx="2"
                        ry="2"
                      ></rect>
                      <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input
                      id="password"
                      name="password"
                      type="password"
                      class="form-control"
                      placeholder="Input Password"
                    />
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      id="toggle-password"
                      class="feather feather-eye"
                    >
                      <path
                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                      ></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </div>

                  <!-- kolom confirm password -->
                  <div id="password-field" class="field-wrapper input mb-2">
                    <div class="d-flex justify-content-between">
                      <label for="password">CONFIRM PASSWORD</label>
                    </div>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-lock"
                    >
                      <rect
                        x="3"
                        y="11"
                        width="18"
                        height="11"
                        rx="2"
                        ry="2"
                      ></rect>
                      <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <input
                      id="password"
                      name="repassword"
                      type="password"
                      class="form-control"
                      placeholder="Input Confirm Password"
                    />
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      id="toggle-password"
                      class="feather feather-eye"
                    >
                      <path
                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                      ></path>
                      <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </div>

                  <div class="d-sm-flex justify-content-between">
                    <div class="field-wrapper">
                      <button class="btn btn-primary" type="submit" name="register" value="">Register</button>
                    </div>
                  </div>

                  <p class="signup-link">
                    Was registered ?
                    <a href="Login.php">Log in to your account</a>
                  </p>
                </div>
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
  <script src="./assets/js/libs/jquery-3.1.1.min.js"></script>
  <script src="./assets/js/libs/axios.min.js"></script>
  <script src="./bootstrap/js/popper.min.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="./plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/app.js"></script>
  <script>
    $(document).ready(function() {
      App.init();
    });
  </script>
  <script src="./assets/js/custom.js"></script>

  <!-- END GLOBAL MANDATORY SCRIPTS -->
  <script src="./assets/js/elements/tooltip.js"></script>
  <script src="./assets/js/scrollspyNav.js"></script>
  <script src="./assets/js/authentication/form-2.js"></script>

  <script>
    $("#form").submit((e) => {
      e.preventDefault();

      const {
        email: {
          value: emailVal
        },
        password: {
          value: pwVal
        },
      } = e.target;

      if (!emailVal) $("#email-required").removeClass("d-none");
      else $("#email-required").addClass("d-none");
      if (!pwVal) $("#password-required").removeClass("d-none");
      else $("#password-required").addClass("d-none");
    });
  </script>
</body>

</html>
