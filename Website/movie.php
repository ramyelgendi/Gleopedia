<?PHP

session_start();
if (!isset($_SESSION['userid'])) {
header ("Location: login.php");
}

include_once "includes/config.php";
    if(isset($_POST['save'])){

        if (empty($error_mesesage) & empty($_POST["name"])) { $error_mesesage = "Movie Name is required";    } else {    $name = $_POST["name"]; }
        if (empty($error_mesesage) & empty($_POST["description"])) { $error_mesesage = "Description Name is required";    } else {    $description = $_POST["description"]; }
        if (empty($error_mesesage) & empty($_POST["rating"])) { $error_mesesage = "Rating is required";    } else {    $rating = $_POST["rating"]; }

        if (empty($error_mesesage)){
        $sql = "SELECT id FROM movies WHERE name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);
            
            // Set param_name
            $param_name = trim($_POST["name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    if($_POST['OriginalName'] != $_POST['name'])
                        $error_mesesage = "This movie name already exists.";
                }
            } else{
                $error_mesesage = "Oops! Something went wrong. Please try again later.";
            }
            
        }
    }


        if(empty($error_mesesage)){
        if(isset($_POST['id'])){
            $new_id= $_POST['id'];
            $edit = mysqli_query($link,"UPDATE movies SET name='$name', description='$description', rating='$rating' WHERE id='$new_id'");
        }else{
            $USERCURRENT=$_SESSION["userid"];

            $edit = mysqli_query($link,"INSERT INTO movies (name,description,rating,createdby) VALUES ('$name','$description','$rating','$USERCURRENT')");
        }
        if($edit)
        {
            mysqli_close($link); // Close connection
            header("location:movies.php"); // redirects to all records page
            exit;
        }
        else {  $error_mesesage= mysqli_error($link); }  
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

    <title>Movies Admin - Movie Add/Edit</title>

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

                    <?php
                    if(isset($_GET['id'])) {
                        $id = $_GET['id']; // get id through query string
                    }else{
                        $id=null;
                    }
                            $sqltran = mysqli_query($link, "SELECT * FROM movies WHERE id = '$id' LIMIT 1")or die(mysqli_error($link));
                            $rowList = mysqli_fetch_array($sqltran);
                            ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        <div class="row">
                            <div class="d-flex col-sm">
                        <div class="align-self-center" >
                            <?php if(is_null($id)){ ?><h6 class="m-0 font-weight-bold text-primary">Add New Movie</h6><?php }else{ ?> <h6 class="m-0 font-weight-bold text-primary">Edit Movie</h6><?php } ?> </div>
                            </div>
                            <div class="col-sm">
                            <a class="btn btn-secondary float-right" href="movies.php" role="button">Back</a>
                            </div>
                        </div>

                            

                        </div>
                        <div class="card-body">
                        <?php if(!empty($error_mesesage)){ ?>    
                            <div class="col-lg mb-4">
                                <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Error: <?echo $error_mesesage ?>
                                       </div>
                                    </div>
                                </div>
                            <?php } ?>                                        
                        <form class="user" method="post" action="movie.php?id=<?echo $_GET['id']?>">
                        <?php if(!is_null($id)){ ?><input type="hidden" name="id" value="<?php echo $id ?>"/><?php } ?>
                        <input type="hidden" name="OriginalName" value="<?php echo isset($rowList['name']) ? $rowList['name'] : '' ?>"/>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="name">Movie Name</label>
                                        <input type="text" class="form-control form-control-user" name="name" value="<?php echo isset($rowList['name']) ? $rowList['name'] : '' ?>"
                                            placeholder="Movie Name">
                                    </div>
                                    <div class="col-sm-6">
                                    <label for="rating">Movie Rating</label>
                                        <input type="text" class="form-control form-control-user" name="rating" value="<?php echo isset($rowList['rating']) ? $rowList['rating'] : '' ?>"
                                            placeholder="Movie Rating">
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="description">Movie Description</label>
                                    <textarea rows="4" class="form-control" name="description" placeholder="Movie Description"><?php echo isset($rowList['description']) ? $rowList['description'] : '' ?></textarea>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Save" name="save">
                            </form>
                        </div>
                    </div>
                    <?php mysqli_close($link); ?> 

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