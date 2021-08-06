<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "layout/head.php";
    ?>
    <title>Register</title>
</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <span style="color: red"><?php
                            echo $_SESSION['errors'][0];
                            unset($_SESSION['errors']);
                            ?></span>
                        <form class="user" action="" method="post">
                            <div class="form-group ">
                                <input type="text" class="form-control form-control-user" name="name"
                                       placeholder="Name">
                            </div>
                            <div class="form-group ">
                                <input type="text" class="form-control form-control-user" name="address"
                                       placeholder="Address">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="email"
                                       placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control form-control-user" name="phone"
                                       placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" name="username"
                                       placeholder="Username">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           name="password" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                           name="repassword" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" type="submit" name="btn_register">
                                Register Account</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="login">Already have an account? Login!</a>
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
