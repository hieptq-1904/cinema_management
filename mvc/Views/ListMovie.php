<?php
    require_once 'mvc/Controllers/ListMovie.php';
    require_once ('mvc/Database/DB.php');
    use mvc\Database\DB;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "layout/head.php";
    ?>
    <link href="../cinema_management/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>List Movie</title>
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
    <div>
        <a href="addmovie" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Add Movie</a>
    </div>
    <span style="color: green"><?php
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'][0];
            unset($_SESSION['message']);
        }
        ?></span>
    <span style="color: red"><?php
        if(isset($_SESSION['errors'])){
            echo $_SESSION['errors'][0];
            unset($_SESSION['errors']);
        }
        ?></span>
    <hr>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Movie</h6>
        </div>
        <div class="card-body">
            <form action="deletemovie" method="post">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="35%">Movie Name</th>
                            <th width="25%">Image</th>
                            <th width="10%">Time</th>
                            <th width="25%">Option</th>
                        </tr>
                        </thead
                        <tbody>
                        <?php
                        $db= new DB();
                        $listmovie = $db->showMovie();
                        $db->closeDb();
                        $no = 1;

                        foreach ($listmovie as $movie){
                            echo '<tr>
                                <td>'.($no++).'</td>
                                <td>'.$movie->movie_name.'</td>
                                <td> <img src="public/image/'.$movie->image.'" width="80px"> </td>
                                <td>'.$movie->time.'</td>
                                <td><a href="detailmovie?id='.$movie->id.'" class="btn " style=" background: #1cc88a; color: white " >Detail</a>
                                    <a href="editmovie?id='.$movie->id.'" class="btn " style="background: #1c294e; color: white ">Edit</a>
                                    <button name="btn_delete" value="'.$movie->id.'" class="btn " type="submit"  style="background: red; color: white ">Delete</button>
                                </td>
                            </tr>';
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </form>

        </div>
    </div>

</div>
<?php
include_once "layout/footer.php";
?>

<?php
include_once "layout/script.php";
?>
</body>
</html>
