<?PHP
session_start();
include_once "includes/config.php";
if (!isset($_SESSION['username'])) {
header ("Location: login.php");
}
$sqltran = NULL;
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['id'])){
        $sqltran = mysqli_query($link, "SELECT * FROM Presidents WHERE id = '".$_GET["id"]."'")or die(mysqli_error($link));
        $rowList = mysqli_fetch_array($sqltran);

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

    <title>Gleopedia</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <!-- Topbar -->
    <?php include_once "includes/sidemenu.php"?>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <!-- Topbar -->
            <?php include_once "includes/topbar.php"?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $rowList['Name'] ?></h6> 
                                    <a href="javascript:history.go(-1)"><button  type="button" class="btn btn-secondary">Back</button></a>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <form>
                                <fieldset disabled>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Office Date</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['OfficeDate'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Birth Date</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['BirthDate'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Political Party</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['PoliticalParty'] ?>">
                                    </div>
                                </fieldset>
                                </form>
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
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/datatables-demo.js"></script>


</body>

</html>