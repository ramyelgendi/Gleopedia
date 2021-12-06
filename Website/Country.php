<?PHP
session_start();
include_once "includes/config.php";
if (!isset($_SESSION['username'])) {
header ("Location: login.php");
}
$sqltran = NULL;
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['id'])){
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.isDrivingSideRight, Co.CallingCode, Co.Timezone, Co.Continent, Co.Area,
        Co.WaterPercentage, Co.Legislature, Co.HDI, Co.President_Monarch, Co.PolCapital, Co.GeoCapital,
        Co.currency, Co.GDP_PPP, Co.GDP_Nominal, Co.Gini, Co.TotalCovidCases, Co.TotalCovidVaccinations,
        C.Name AS PolCapitalName, CC.Name AS GeoCapitalName, Presidents.Name AS PresName, Presidents.id AS PresID, C.id AS PolCapitalID, CC.id AS GeoCapitalID
        FROM Country Co 
        INNER JOIN City C ON Co.PolCapital = C.id 
        INNER JOIN City CC ON Co.GeoCapital = CC.id 
        INNER JOIN Presidents ON Presidents.id = Co.President_Monarch
        WHERE Co.id = '".$_GET["id"]."'")or die(mysqli_error($link));
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
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $rowList['CountryName'] ?></h6> 
                                    <a href="javascript:history.go(-1)"><button  type="button" class="btn btn-secondary">Back</button></a>

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <form>
                                <fieldset disabled>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Population</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['Population'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Driving Side</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php if($rowList['isDrivingSideRight'] ==1) {echo "Right";} else{echo "Left";} ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Calling Code</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['CallingCode'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Timezone</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['Timezone'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Continent</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['Continent'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Population</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['Population'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Area</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['Area'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Water Percentage</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['WaterPercentage'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Legislature</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['Legislature'] ?>">
                                    </div>

                                    <div class="form-group">
                                    <label for="disabledTextInput">HDI</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['HDI'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">President</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['PresName'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Political Capital City</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['PolCapitalName'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Geographical Capital City</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['GeoCapitalName'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Currency</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['currency'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">GDP PPP</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['GDP_PPP'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">GDP Nominal</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['GDP_Nominal'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Gini</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['Gini'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Total Covid Cases</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['TotalCovidCases'] ?>">
                                    </div>
                                    <div class="form-group">
                                    <label for="disabledTextInput">Total Covid Vaccinations</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="<?php echo $rowList['TotalCovidVaccinations'] ?>">
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