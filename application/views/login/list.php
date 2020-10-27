<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> <?php echo $title ?> </title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url() ?>assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>/assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

  <br><br><br><br>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <!-- <div class="col-xl-10 col-lg-12 col-md-9"> asli, baris bawah 1 edit-->
      <div class="col-xl-6 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row justify-content-center">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> asli, baris bawah 1 edit--> 
              <!-- <div class="col-lg-3 d-none d-lg-block"></div> -->
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><?php echo $title ?></h1>
                  </div>
                  
<?php
// Notifikasi error
echo validation_errors('<div class="alert alert-success">','</div>');

// Notifikasi gagal login
if($this->session->flashdata('warning')) {
  echo '<div class="alert alert-warning">';
  echo $this->session->flashdata('warning');
  echo '</div>';
}

// Notifikasi logout
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}

// Form open login
echo form_open(base_url('login'));
?>

                  <!-- <form class="user"> -->
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <!-- <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div> -->
                    </div>
                    <button type=submit class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
                  <!-- </form> -->
<?php echo form_close(); ?>
                  <!-- <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>/assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>/assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>/assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>/assets/admin/js/sb-admin-2.min.js"></script>

</body>

</html>
