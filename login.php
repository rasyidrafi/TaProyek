<?php

  session_start();

  // membuat koneksi ke database
  $conn = mysqli_connect("localhost","root","","db_kasir");

    // cek koneksi database
    /* if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } else {
        echo "Koneksi berhasil"; 
    } */

  //apabila tombol login ditekan
  if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];
    
    setcookie("nama", $email); // buat cookie username

    //cek apakah email & password yg diinputkan user ada yang sama dengan yg ada di database
    $result_email = mysqli_query($conn, " SELECT * FROM users WHERE email = '$email' ");
    $result_password = mysqli_query($conn, " SELECT * FROM users WHERE password = '$password' ");

    // jika tidak terdapat kolom yang kosong
    if (!empty($email) && !empty($password)) {
      //cek email
      if (mysqli_num_rows($result_email) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result_email);
        if (password_verify($password, $row["password"])) {
          
          $_SESSION["login"] = true; // jika user berhasil login, buat session login

          header('Location: index.php'); // alihkan ke halaman dashboard
          exit;
        }
      }
    } else {
      $err1 = true;
    }

    $err2 = true;
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
    />
    <title>CORK Admin Template - Login Page</title>
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:400,600,700"
      rel="stylesheet"
    />
    <link
      href="./bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link href="./assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link
      href="./assets/css/scrollspyNav.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="./assets/css/authentication/form-2.css"
      rel="stylesheet"
      type="text/css"
    />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link
      rel="stylesheet"
      type="text/css"
      href="./assets/css/forms/theme-checkbox-radio.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="./assets/css/forms/switches.css"
    />

    <link rel="stylesheet" href="./assets/css/elements/tooltip.css" />
    <link rel="stylesheet" href="./assets/css/elements/alert.css" />

    <!-- bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  
  </head>

  <body class="form">
    <script src="./middleware/index.js"></script>
    <script>
      middleware.redirectIfLogin();
    </script>


    <div class="form-container outer">
      <div class="form-form">
        <div class="form-form-wrap">
          <div class="form-container">
            <div class="form-content shadow-lg p-3 mb-5 bg-body rounded mt-5 px-4">
              <h1 class="">Sign In</h1>
              <p class="">Log in to your account to continue.</p>

              <!-- Jika Email / password salah, tampilkan pesan kesalahan -->
              <?php if (isset($err1)) : ?>
                <div class="alert alert-danger fw-bold" role="alert">
                  <i class="bi bi-exclamation-triangle-fill"></i> 
                  &nbsp;&nbsp;Data tidak boleh kosong!
                </div>
              <?php elseif (isset($err2)) : ?>
                <div class="alert alert-danger fw-bold" role="alert">
                  <i class="bi bi-exclamation-triangle-fill"></i> 
                  &nbsp;&nbsp;Email / password yang anda masukkan salah!
                </div>
              <?php endif; ?>

              <form action="" method="post" class="text-left">
                <div class="form">

                  <!-- email -->
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
                  
                  <!-- password -->
                  <div id="password-field" class="field-wrapper input mb-2">
                    <div class="d-flex justify-content-between">
                      <label for="password">PASSWORD</label>
                      <a
                        href="javascript:void(0);"
                        class="bs-tooltip forgot-pass-link"
                        title="Contact your administrator"
                        data-bs-toggle="modal" 
                        data-bs-target="#exampleModal"
                        >Forgot Password?</a
                      >
                    </div>

                    <!-- Forgot Password Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="exampleModalLabel">Peringatan!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>Please contact the administrator if you forget your password.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" >
                              <i class="bi bi-x-circle"></i>
                              Close
                            </button>
                            <a href="https://api.whatsapp.com/send?phone=6287862139165&text=Excuse%20me%20admin,%20I%20have%20an%20account%20and%20forgot%20the%20password.%0A%0AUsername:%20...%0ANew%20Password:%20...%0A%0AThanks%20very+much." target="_blank" style="width: 100%;">
                              <button type="button" class="btn btn-success" >
                                <i class="bi bi-whatsapp"></i>
                                Contact Admin
                              </button>
                            </a>
                          </div>
                        </div>
                      </div>
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

                  <div class="d-sm-flex justify-content-between">
                    <div class="field-wrapper">
                      <button class="btn btn-primary" name="login" value="">Log In</button>
                    </div>
                  </div>

                  <p class="signup-link">
                    Not registered ?
                    <a href="register.php">Create an account</a>
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
      $(document).ready(function () {
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
          email: { value: emailVal },
          password: { value: pwVal },
        } = e.target;

        if (!emailVal) $("#email-required").removeClass("d-none");
        else $("#email-required").addClass("d-none");
        if (!pwVal) $("#password-required").removeClass("d-none");
        else $("#password-required").addClass("d-none");
      });
    </script>
  </body>
</html>

