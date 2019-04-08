<?php include('server.php') ?>

<body class="bg-light">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="post" action="register">
          <?php include('errors.php'); ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">Username</label>
                <input class="form-control" id="exampleInputName" type="text"   name="username" value="<?php echo $username; ?>" >
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" name="email" value="<?php echo $email; ?>" >
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" id="exampleInputPassword1" type="password" name="password_1" >
              </div>
             <div class="col-md-6">
                <label for="exampleInputPassword1">Confirm Password</label>
                <input class="form-control" id="exampleInputPassword2" type="password" name="password_2" >
              </div>
            </div>
          </div>
          
           <button type="submit" class="btn btn-primary btn-block" name="reg_user">Register</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login">Login Page</a>
        </div>
      </div>
    </div>
  </div>
