<!DOCTYPE html>
<html lang="en">
<head>
<?php
    include_once "layout/head.php";
?>
    <title>Home Page</title>
</head>
<body id="page-top">

    <?php
    include_once "layout/Sidebar.php";
    ?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Welcome to Cinema Management</h1>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="Login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "layout/script.php";
    ?>
</body>
</html>