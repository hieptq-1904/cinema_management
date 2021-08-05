<?php
    include '../Controllers/Login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "layout/head.php";
    ?>
    <title>Login</title>
</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <span style="color: red"><?php
                                    echo $_SESSION['errors'][0];
                                    unset($_SESSION['errors']);
                                     ?></span>
                                <form class="user" action="" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                               name="username" aria-describedby="emailHelp"
                                               placeholder="Enter Username...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <button  class="btn btn-primary btn-user btn-block" name="btn_login" type="submit">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include_once "layout/script.php";
?>
</body>

</html>