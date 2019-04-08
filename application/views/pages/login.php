<?php include('server.php') ?>

<body class="bg-light">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="post" action="login">
           <?php include('errors.php'); ?>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control"  type="text"  name="username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control"  type="password" name="password">
          </div>
<div class="g-recaptcha" data-sitekey="6LfkJZwUAAAAAOz7PcBhMv8iaCTULegOTNJhZiBf"></div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
        

          <button type="submit" class="btn btn-primary btn-block" name="login_user">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register">Register an Account</a>
       <a class="d-block small" href="forgot-password">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
