<header class="masthead-register">
    <div class="container h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-10 pt-100">
        <h3 class="mb-4">Welcome</h3>
        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    
            <div class="form-label-group h3">
                <input type="text" name="user_name" class="form-control" placeholder="Name">
            </div>

            <div class="form-label-group h3">
                <input type="email" name="user_email" class="form-control" placeholder="Email address">
            </div>

            <div class="form-label-group h3">
                <input type="password" name="user_password" class="form-control" placeholder="Password">
            </div>

            <div class="form-label-group h3">
                <input type="password" name="current-password" class="form-control" placeholder="Password">
            </div>

            <input class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2 h3" name="btn_register" type="submit" value="Login" />
        </form>
      </div>
    </div>
