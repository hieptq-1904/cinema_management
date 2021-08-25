
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "layout/head.php";
    ?>
    <title>Detail Movie</title>
</head>
<body id="page-top">

<?php
include_once "layout/Sidebar.php";
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail movie for Cinema Management </h1>
    </div>
    <span style="color: red"><?php
        echo $_SESSION['errors'][0];
        unset($_SESSION['errors']);
        ?></span>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <form action="" method="post" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Movie name: </label>
                                <?php echo $data->movie_name ?>
                            </div>
                            <div class="form-group">
                                <label for="">Categories: </label>
                                <?php foreach ($data->categories as $category){
                                    echo $category->name.',';
                                } ?>
                            </div>
                            <div class="form-group">
                                <label for="">Image: </label><br>
                                <img src="public/image/<?php echo $data->image ?> " width="300px" ">
                            </div>
                            <div class="form-group">
                                <label for="">Description: </label>
                                <?php echo $data->description ?>
                            </div>
                            <div class="form-group">
                                <label for="">Time(minutes): </label>
                                <?php echo $data->time ?>
                            </div>
                            <div class="form-group" style="text-align: end;">
                                <a class="btn btn-danger" href="listmovie"
                                   style="width: 100px;background: dodgerblue; margin-left: 100px">Cancel</a>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php
include_once "layout/script.php";
?>
</body>
</html>
