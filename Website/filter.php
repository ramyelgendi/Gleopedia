<?PHP
session_start();

#use Brick\PhoneNumber\PhoneNumber;
#use Brick\PhoneNumber\PhoneNumberParseException;

#try {
#    $number = PhoneNumber::parse('+333');
#}
#catch (PhoneNumberParseException $e) {
    // 'The string supplied is too short to be a phone number.'
#}

include_once "includes/config.php";

if (!isset($_SESSION['username'])) {
header ("Location: login.php");
}
$sqltran = NULL;
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['filter']) && $_GET["filter"] == "Legislature" ){
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.isDrivingSideRight, Co.CallingCode, Co.Timezone, Co.Continent, Co.Area,
        Co.WaterPercentage, Co.Legislature, Co.HDI, Co.President_Monarch, Co.PolCapital, Co.GeoCapital,
        Co.currency, Co.GDP_PPP, Co.GDP_Nominal, Co.Gini, Co.TotalCovidCases, Co.TotalCovidVaccinations,
        C.Name AS PolCapitalName, CC.Name AS GeoCapitalName, Presidents.Name AS PresName , Presidents.id AS PresID, C.id AS PolCapitalID, CC.id AS GeoCapitalID
        FROM Country Co 
        INNER JOIN City C ON Co.PolCapital = C.id 
        INNER JOIN City CC ON Co.GeoCapital = CC.id 
        INNER JOIN Presidents ON Presidents.id = Co.President_Monarch
        WHERE Co.Legislature LIKE '%".$_GET["search"]."%'

        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "Country" ){
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.isDrivingSideRight, Co.CallingCode, Co.Timezone, Co.Continent, Co.Area,
        Co.WaterPercentage, Co.Legislature, Co.HDI, Co.President_Monarch, Co.PolCapital, Co.GeoCapital,
        Co.currency, Co.GDP_PPP, Co.GDP_Nominal, Co.Gini, Co.TotalCovidCases, Co.TotalCovidVaccinations,
        C.Name AS PolCapitalName, CC.Name AS GeoCapitalName, Presidents.Name AS PresName , Presidents.id AS PresID, C.id AS PolCapitalID, CC.id AS GeoCapitalID
        FROM Country Co 
        INNER JOIN City C ON Co.PolCapital = C.id 
        INNER JOIN City CC ON Co.GeoCapital = CC.id 
        INNER JOIN Presidents ON Presidents.id = Co.President_Monarch
        WHERE Co.Name LIKE '%".$_GET["search"]."%'

        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "President" ){
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.isDrivingSideRight, Co.CallingCode, Co.Timezone, Co.Continent, Co.Area,
        Co.WaterPercentage, Co.Legislature, Co.HDI, Co.President_Monarch, Co.PolCapital, Co.GeoCapital,
        Co.currency, Co.GDP_PPP, Co.GDP_Nominal, Co.Gini, Co.TotalCovidCases, Co.TotalCovidVaccinations,
        C.Name AS PolCapitalName, CC.Name AS GeoCapitalName, Presidents.Name AS PresName , Presidents.id AS PresID, C.id AS PolCapitalID, CC.id AS GeoCapitalID
        FROM Country Co 
        INNER JOIN City C ON Co.PolCapital = C.id 
        INNER JOIN City CC ON Co.GeoCapital = CC.id 
        INNER JOIN Presidents ON Presidents.id = Co.President_Monarch
        WHERE Presidents.Name LIKE '%".$_GET["search"]."%'

        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "City" ){
        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.isDrivingSideRight, Co.CallingCode, Co.Timezone, Co.Continent, Co.Area,
        Co.WaterPercentage, Co.Legislature, Co.HDI, Co.President_Monarch, Co.PolCapital, Co.GeoCapital,
        Co.currency, Co.GDP_PPP, Co.GDP_Nominal, Co.Gini, Co.TotalCovidCases, Co.TotalCovidVaccinations,
        C.Name AS PolCapitalName, CC.Name AS GeoCapitalName, Presidents.Name AS PresName , Presidents.id AS PresID, C.id AS PolCapitalID, CC.id AS GeoCapitalID
        FROM Country Co 
        INNER JOIN City C ON Co.PolCapital = C.id 
        INNER JOIN City CC ON Co.GeoCapital = CC.id 
        INNER JOIN Presidents ON Presidents.id = Co.President_Monarch
        WHERE C.Name LIKE '%".$_GET["search"]."%' 
        AND CC.Name LIKE '%".$_GET["search"]."%' 

        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "Phone" ){

        $stack = array();
        $sqltran = mysqli_query($link, "SELECT Co.CallingCode AS Code, Co.Name FROM Country Co")or die(mysqli_error($link));

        while ($rowList = mysqli_fetch_array($sqltran)) { 
            if(strpos( $_GET["search"][0], $rowList["Code"]) !== false and strlen($rowList["Code"]) == 1){
                array_push($stack, "'".$rowList["Name"]."'");
            }
            else if(strpos(substr( $_GET["search"], 0, 2), $rowList["Code"]) !== false and strlen($rowList["Code"]) == 2){
                array_push($stack, "'".$rowList["Name"]."'");
            }
            else if(strpos(substr( $_GET["search"], 0, 3), $rowList["Code"]) !== false and strlen($rowList["Code"]) == 3){
                array_push($stack, "'".$rowList["Name"]."'");
            }
        }
        

        $stack = implode(',',$stack);  

        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.isDrivingSideRight, Co.CallingCode, Co.Timezone, Co.Continent, Co.Area,
        Co.WaterPercentage, Co.Legislature, Co.HDI, Co.President_Monarch, Co.PolCapital, Co.GeoCapital,
        Co.currency, Co.GDP_PPP, Co.GDP_Nominal, Co.Gini, Co.TotalCovidCases, Co.TotalCovidVaccinations,
        C.Name AS PolCapitalName, CC.Name AS GeoCapitalName, Presidents.Name AS PresName, Presidents.id AS PresID, C.id AS PolCapitalID, CC.id AS GeoCapitalID
        FROM Country Co 
        INNER JOIN City C ON Co.PolCapital = C.id 
        INNER JOIN City CC ON Co.GeoCapital = CC.id 
        INNER JOIN Presidents ON Presidents.id = Co.President_Monarch
        WHERE Co.Name IN (". $stack .")

        ")or die(mysqli_error($link));
    }
    if(isset($_GET['filter']) && $_GET["filter"] == "DrivingSide" ){
        if($_GET["search"]=="right"){
            $drive=1;
        }else if($_GET["search"]=="left"){
            $drive=NULL;
        }else{
            $drive=0;
        }

        $sqltran = mysqli_query($link, "SELECT Co.id AS id, Co.Name AS CountryName,
        Co.Population, Co.isDrivingSideRight, Co.CallingCode, Co.Timezone, Co.Continent, Co.Area,
        Co.WaterPercentage, Co.Legislature, Co.HDI, Co.President_Monarch, Co.PolCapital, Co.GeoCapital,
        Co.currency, Co.GDP_PPP, Co.GDP_Nominal, Co.Gini, Co.TotalCovidCases, Co.TotalCovidVaccinations,
        C.Name AS PolCapitalName, CC.Name AS GeoCapitalName, Presidents.Name AS PresName, Presidents.id AS PresID, C.id AS PolCapitalID, CC.id AS GeoCapitalID
        FROM Country Co 
        INNER JOIN City C ON Co.PolCapital = C.id 
        INNER JOIN City CC ON Co.GeoCapital = CC.id 
        INNER JOIN Presidents ON Presidents.id = Co.President_Monarch
        WHERE Co.isDrivingSideRight = '".$drive."' 

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
                                    <h6 class="m-0 font-weight-bold text-primary">Search By Filter</h6> 

                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                <form>
                                <div class="row justify-content-md-center mb-4">

                                <div class="col col-lg-8">
                                    <input type="text" class="form-control" id="search" name="search" aria-describedby="emailHelp" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                </div>
                                <div class="ol col-lg-4">
                                <select class="form-control" id="exampleFormControlSelect1" placeholder="Filter" name="filter">
                                        <option value="Country">Country</option>
                                        <option value="President">President/Monarch</option>
                                        <option value="City">City</option>
                                        <option value="Legislature">Legislature</option>
                                        <option value="Phone">Phone Number (Ex: 201007710528)</option>
                                        <option value="DrivingSide">Driving Side (right/left)</option>

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
                                                <th style="width: 30%;">Calling Code</th>
                                                <th style="width: 30%;">Continent</th>
                                                <th style="width: 30%;">Legislature</th>
                                                <th style="width: 30%;">President</th>
                                                <th style="width: 30%;">Political Capital</th>
                                                <th style="width: 30%;">Geographical Capital</th>
                                                <th style="width: 30%;">Driving Side</th>

                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        while ($rowList = mysqli_fetch_array($sqltran)) { 
                                            $current_id = $rowList["id"];?>
                                            <tr> 
                                            <td><a href="/Country.php?id=<?php echo $current_id ?>"><?php echo $rowList['CountryName'] ?></a></td>
                                                <td><?php echo $rowList['CallingCode'] ?></td>
                                                <td><?php echo $rowList['Continent'] ?></td>
                                                <td><?php echo $rowList['Legislature'] ?></td>
                                                <td><a href="/president.php?id=<?php echo $rowList['PresID'] ?>"><?php echo $rowList['PresName'] ?></a></td>
                                                <td><a href="/city.php?id=<?php echo $rowList['PolCapitalID'] ?>"><?php echo $rowList['PolCapitalName'] ?></a></td>
                                                <td><a href="/city.php?id=<?php echo $rowList['GeoCapitalID'] ?>"><?php echo $rowList['GeoCapitalName'] ?></a></td>
                                                <td><?php if($rowList['isDrivingSideRight'] ==1) {echo "Right";} else{echo "Left";} ?></td>

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