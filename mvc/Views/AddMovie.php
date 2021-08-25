<?php
include_once ('mvc/Database/DB.php');
use mvc\Database\DB;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "layout/head.php";
    ?>
    <title>Add Movie</title>
</head>
<body id="page-top">

<?php
include_once "layout/Sidebar.php";
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add movie for Cinema Management </h1>
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
                                <input type="text" class="form-control" name="moviename">
                            </div>
                            <div class="form-group">
                                <label for="">Categories: </label>
                                <select name="category_id[]" multiple="multiple" id="input1" class="form-control" ">
                                <?php
                                $db = new DB();
                                $listcate = $db->showCategory();
                                $db->closeDb();
                                foreach ($listcate as $category ){?>
                                    <option value="<?php echo $category->id?>"><?php echo $category->name?></option>
                                <?php } ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Image: </label>
                                <input type="file" class="form-control" name="image" >
                            </div>
                            <div class="form-group">
                                <label for="">Description: </label>
                                <textarea name="description" id="input" class="form-control" rows="3"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Time(minutes): </label>
                                <input type="number" class="form-control" name="time"  >
                            </div>
                            <div class="form-group" style="text-align: center;">
                                <button class="btn btn-danger"  style="width: 100px; background:dodgerblue "
                                name="btn_add">Add</button>
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
