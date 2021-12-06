<?PHP
session_start();
include_once "includes/config.php";
if (!isset($_SESSION['username'])) {
header ("Location: login.php");
}
$sqltran = NULL;
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['filter']) && $_GET["filter"] == "GDP_PPP" ){
        $string = '';
        if($_GET["filter2"] != "Globally") {$string ="WHERE Co.Continent = '". $_GET["filter2"] ."' ";}
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.Continent, Co.Area, Co.GDP_PPP, Co.GDP_Nominal,(Co.GDP_Nominal/Co.Population) AS GDPCapita
        FROM Country Co ". $string."
        ORDER BY Co.GDP_PPP DESC 
        LIMIT 10
        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "GDP_Nominal" ){
        $string = '';
        if($_GET["filter2"] != "Globally") {$string ="WHERE Co.Continent = '". $_GET["filter2"] ."' ";}
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.Continent, Co.Area, Co.GDP_PPP, Co.GDP_Nominal,(Co.GDP_PPP/Co.Population) AS GDPCapita
        FROM Country Co ". $string."
        ORDER BY Co.GDP_Nominal DESC 
        LIMIT 10
        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "Area" ){
        $string = '';
        if($_GET["filter2"] != "Globally") {$string ="WHERE Co.Continent = '". $_GET["filter2"] ."' ";}
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.Continent, Co.Area, Co.GDP_PPP, Co.GDP_Nominal,(Co.GDP_PPP/Co.Population) AS GDPCapita
        FROM Country Co ". $string."
        ORDER BY Co.Area DESC 
        LIMIT 10
        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "Population" ){
        $string = '';
        if($_GET["filter2"] != "Globally") {$string ="WHERE Co.Continent = '". $_GET["filter2"] ."' ";}
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.Continent, Co.Area, Co.GDP_PPP, Co.GDP_Nominal,(Co.GDP_PPP/Co.Population) AS GDPCapita
        FROM Country Co ". $string."
        ORDER BY Co.Population DESC 
        LIMIT 10
        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "GDPCapita" ){
        $string = '';
        if($_GET["filter2"] != "Globally") {$string ="WHERE Co.Continent = '". $_GET["filter2"] ."' ";}
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.Continent, Co.Area, Co.GDP_PPP, Co.GDP_Nominal,(Co.GDP_PPP/Co.Population) AS GDPCapita
        FROM Country Co ". $string."
        ORDER BY GDPCapita DESC 
        LIMIT 10
        ")or die(mysqli_error($link));
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
                                    <h6 class="m-0 font-weight-bold text-primary">Retrieve Top 10 By Filter</h6> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <form>
                                <div class="row justify-content-md-center mb-4">

                                <div class="ol col-lg-6">
                                    <select class="form-control" id="exampleFormControlSelect1" placeholder="Filter" name="filter" value="<?php echo isset($_POST['filter']) ? $_POST['filter'] : '' ?>">
                                            <option value="GDP_PPP">GDP PPP</option>
                                            <option value="GDP_Nominal">GDP Nominal</option>
                                            <option value="Area">Area</option>
                                            <option value="Population">Population</option>
                                            <option value="GDPCapita">GDP Per Capita</option>

                                    </select>
                                </div>
                                <div class="ol col-lg-6">
                                    <select class="form-control" id="exampleFormControlSelect1" placeholder="Filter" name="filter2" value="<?php echo isset($_POST['filter2']) ? $_POST['filter2'] : '' ?>">
                                            <option value="Globally">Globally</option>
                                            <option value="Africa">Africa</option>
                                            <option value="Asia">Asia</option>
                                            <option value="Europe">Europe</option>
                                            <option value="North America">North America</option>
                                            <option value="South America">South America</option>
                                            <option value="Australia">Australia</option>

                                    </select>
                                </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                </div>
                            
                            </div>
                            <?php       if($sqltran != NULL){ ?>
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Countries</h6> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="width: 20%;">Name</th>
                                                <th style="width: 20%;">Population</th>
                                                <th style="width: 30%;">Continent</th>
                                                <th style="width: 30%;">Area</th>
                                                <th style="width: 30%;">GDP PPP</th>
                                                <th style="width: 30%;">GDP Nominal</th>
                                                <th style="width: 30%;">GDP Per Capita</th>

                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        while ($rowList = mysqli_fetch_array($sqltran)) { 
                                            $current_id = $rowList["id"];?>
                                            <tr> 
                                            <td><a href="/Country.php?id=<?php echo $current_id ?>"><?php echo $rowList['CountryName'] ?></a></td>
                                                <td><?php if(isset($_GET['filter']) && $_GET["filter"] == "Population" )echo $rowList['Population'] ?></td>
                                                <td><?php if(isset($_GET['filter']) && $_GET["filter"] == "Continent" )echo $rowList['Continent'] ?></td>
                                                <td><?php if(isset($_GET['filter']) && $_GET["filter"] == "Area" )echo $rowList['Area'] ?></td>
                                                <td><?php if(isset($_GET['filter']) && $_GET["filter"] == "GDP_PPP" )echo $rowList['GDP_PPP'] ?></td>
                                                <td><?php if(isset($_GET['filter']) && $_GET["filter"] == "GDP_Nominal" )echo $rowList['GDP_Nominal'] ?></td>
                                                <td><?php if(isset($_GET['filter']) && $_GET["filter"] == "GDPCapita" )echo $rowList['GDPCapita'] ?></td>

                                        <?php
                                    }
                                        ?> 
                                        </tbody>
                                    </table>
                                    </div> 
                                </div>
                            </div>

                            <?php } ?> 
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