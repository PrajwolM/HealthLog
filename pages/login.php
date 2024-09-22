<?php
include("connection.php");
session_start();
//Remove all data from previous session
session_unset();
session_destroy();
?>
<?php include '../layouts/header.php' ?>

<section class="login vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="../images/login.svg" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="loginRedirect.php" method="POST" id="adminLoginForm">
          <p class="lead fw-bold fs-3 justify-content-lg-start"><strong>Sign in</strong></p>

          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="userName">Username</label>
            <input type="text" id="userName" name="userName" class="form-control form-control-lg"
              placeholder="Enter a valid username" />
          </div>

          <div data-mdb-input-init class="form-outline mb-3">
            <label class="form-label" for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-lg"
              placeholder="Enter password" />

          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>