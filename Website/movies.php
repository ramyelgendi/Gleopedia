<?PHP

session_start();
if (!isset($_SESSION['userid'])) {
header ("Location: login.php");
}

include_once "includes/config.php";

if(isset($_POST['login'])){
    echo "WASSAP NIGGAS";
    $id = $current_id; // get id through query string

$del = mysqli_query($link,"delete from movies where id = '$id'"); // delete query

if($del)
{
    mysqli_close($link); // Close connection
    header("location:movies.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Movies Admin - Movies</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        form {
            display: inline;
        }
    </style>

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include_once "includes/sidemenu.php"?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once "includes/topbar.php"?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <div class="row">
                            <div class="d-flex col-sm">
                        <div class="align-self-center" ><h6 class="m-0 font-weight-bold text-primary">List of Movies</h6> </div>
                            </div>
                            <div class="col-sm">
                            <a class="btn btn-primary float-right" href="movie.php" role="button">Add New Movie</a>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%;">Movie Name</th>
                                            <th style="width: 40%;">Description</th>
                                            <th style="width: 20%;">Rating</th>
                                            <th style="width: 10%;"></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    <?php
                                    $sqltran = mysqli_query($link, "SELECT * FROM movies ")or die(mysqli_error($link));
                                    while ($rowList = mysqli_fetch_array($sqltran)) { 
                                        $current_id = $rowList["id"];?>
                                         <tr> <td><?php echo $rowList['name'] ?></td>
                                               <td><?php echo $rowList['description'] ?></td>
                                            <td><?php echo $rowList['rating'] ?></td>
                                            <td class="text-center"> 
                                            <a href="movie.php?id=<?php echo $rowList['id'] ?>" class="btn btn-sm btn-info btn-circle"><i class="fas fa-pen"></i></a>
                                            <form class="user" method="post" action="delete.php"><input type="hidden" name="delete" value="<?php echo $rowList['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger btn-circle"> <i class="fas fa-trash"></i></button>
                                            </form>
                                            </td></tr>
                                    <?php
                                    }
                                    mysqli_close($link);
                                    ?> 

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once "includes/footer.php" ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>