<?PHP
session_start();
include_once "includes/config.php";
if (!isset($_SESSION['username'])) {
header ("Location: login.php");
}
$sqltran1 = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,Co.TotalCovidCases, Co.TotalCovidVaccinations  
FROM Country Co  WHERE Co.TotalCovidCases>1 ORDER BY Co.TotalCovidCases ASC LIMIT 5 ")or die(mysqli_error($link));

$sqltran2 = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,Co.TotalCovidCases, Co.TotalCovidVaccinations  
FROM Country Co  WHERE Co.TotalCovidCases>1  ORDER BY Co.TotalCovidCases DESC LIMIT 5 ")or die(mysqli_error($link));
    
$sqltran3 = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,Co.TotalCovidCases, Co.TotalCovidVaccinations  
FROM Country Co  WHERE Co.TotalCovidCases>1  ORDER BY Co.TotalCovidVaccinations ASC LIMIT 5 ")or die(mysqli_error($link));

$sqltran4 = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,Co.TotalCovidCases, Co.TotalCovidVaccinations  
FROM Country Co  WHERE Co.TotalCovidCases>1  ORDER BY Co.TotalCovidVaccinations DESC LIMIT 5 ")or die(mysqli_error($link));
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
                            <?php       if($sqltran1 != NULL){ ?>
                                <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Bottom 5 Countries By Covid Cases</h6> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 20%;">Name</th>
                                                <th style="width: 30%;">Total Covid Cases</th>

                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        while ($rowList = mysqli_fetch_array($sqltran1)) { 
                                            $current_id = $rowList["id"];?>
                                            <tr> 
                                            <td><a href="/Country.php?id=<?php echo $current_id ?>"><?php echo $rowList['CountryName'] ?></a></td>
                                                <td><?php echo $rowList['TotalCovidCases'] ?></td>

                                        <?php
                                    }
                                        ?> 
                                        </tbody>
                                    </table>
                                    </div> 
                                </div>
                            </div>
                                </div>

                            <?php } ?> 
                            <?php       if($sqltran2 != NULL){ ?>
                                <div class="col-xl-6 col-lg-6">

                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Countries By Covid Cases</h6> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 20%;">Name</th>
                                                <th style="width: 30%;">Total Covid Cases</th>

                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        while ($rowList = mysqli_fetch_array($sqltran2)) { 
                                            $current_id = $rowList["id"];?>
                                            <tr> 
                                            <td><a href="/Country.php?id=<?php echo $current_id ?>"><?php echo $rowList['CountryName'] ?></a></td>
                                                <td><?php echo $rowList['TotalCovidCases'] ?></td>

                                        <?php
                                    }
                                        ?> 
                                        </tbody>
                                    </table>
                                    </div> 
                                </div>
                            </div>
                                </div>
                            <?php } ?> 
                            <?php       if($sqltran3 != NULL){ ?>
                                <div class="col-xl-6 col-lg-6">

                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Bottom 5 Countries By Covid Vaccinations</h6> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 20%;">Name</th>
                                                <th style="width: 30%;">Total Covid Vaccinations</th>

                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        while ($rowList = mysqli_fetch_array($sqltran3)) { 
                                            $current_id = $rowList["id"];?>
                                            <tr> 
                                            <td><a href="/Country.php?id=<?php echo $current_id ?>"><?php echo $rowList['CountryName'] ?></a></td>
                                                <td><?php echo $rowList['TotalCovidVaccinations'] ?></td>

                                        <?php
                                    }
                                        ?> 
                                        </tbody>
                                    </table>
                                    </div> 
                                </div>
                            </div>
                                </div>
                            <?php } ?> 
                            <?php       if($sqltran1 != NULL){ ?>
                                <div class="col-xl-6 col-lg-6">

                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Countries By Covid Vaccinations</h6> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 20%;">Name</th>
                                                <th style="width: 30%;">Total Covid Vaccinations</th>

                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        while ($rowList = mysqli_fetch_array($sqltran4)) { 
                                            $current_id = $rowList["id"];?>
                                            <tr> 
                                            <td><a href="/Country.php?id=<?php echo $current_id ?>"><?php echo $rowList['CountryName'] ?></a></td>
                                                <td><?php echo $rowList['TotalCovidVaccinations'] ?></td>

                                        <?php
                                    }
                                        ?> 
                                        </tbody>
                                    </table>
                                    </div> 
                                </div>
                            </div>
                                </div>
                            <?php } ?> 

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