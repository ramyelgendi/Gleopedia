<?php
// Include config file
require_once "includes/config.php";
session_start();
if (isset($_SESSION['username'])) {
    header ("Location: index.php");
    }
// Define variables and initialize with empty values
$firstname = $lastname = $email = $password = $confirmpassword = $error_mesesage = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($error_mesesage) & empty($_POST["birthDate"])) { $error_mesesage = "Birth Date is required";    } else {    $birthDate = $_POST["birthDate"]; }
    if (empty($error_mesesage) & empty($_POST["gender"])) { $error_mesesage = "Gender is required";} else {    $gender = $_POST["gender"]; }
    if (empty($error_mesesage) & empty($_POST["username"])) { $error_mesesage = "Username is required";} else {    $username = $_POST["username"]; }

    if(empty($error_mesesage)){
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $error_mesesage = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
    
    // Validate password

    if(empty($error_mesesage)){
        if(empty($_POST["password"])){
            $error_mesesage = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $error_mesesage = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }
    }
    // Validate confirm password
    if(empty($error_mesesage) & empty($_POST["confirmpassword"])){
        $error_mesesage = "Please confirm password.";     
    } else{
        $confirmpassword = trim($_POST["confirmpassword"]);
        if(empty($error_mesesage) && ($password != $confirmpassword)){
            $error_mesesage = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($error_mesesage)){
        #$dateOfBirth = "17-10-1999";
        $birthDate = date('Y-m-d', strtotime(str_replace('-', '/', $birthDate)));
        $param_age = date_diff(date_create($birthDate), date_create(date("Y-m-d H:i:s")));
        
        // Prepare an insert statement
        $param_age = 21;
        $sql = "INSERT INTO Users (Username, Password,Gender,BirthDate,Age) VALUES ('".$username."', '".password_hash($password, PASSWORD_DEFAULT)."', '".$gender."', '".$birthDate."','".$param_age."')";

        if(mysqli_query($link, $sql)){
            header("location: login.php");
        } else{
            $error_mesesage = "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    
    // Close connection
    mysqli_close($link);

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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg"> <!-- 12 Columns (960px max) -->
                        <div class="p-5">   <!-- Padding 5 -->
                            <div class="text-center"> 
                                <h1 class="h3 text-gray-900 ">Gleopedia</h1> 
                                <h1 class="h5 text-gray-900 mb-4">Create New Account</h1> 
                        </div>

                         <?php if(!empty($error_mesesage)){ ?>    
                            <div class="col-lg mb-4">
                                <div class="card bg-danger text-white shadow">
                                        <div class="card-body">
                                            Error: <?echo $error_mesesage ?>
                                       </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <form class="user" action="register.php" method="post">
                                <div class="form-group">
                                <label for="exampleFormControlSelect1">Username</label>
                                    <input type="text" class="form-control" name="username" 
                                    value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" placeholder="Username">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleFormControlSelect1">Gender</label>
                                    <select class="form-control" id="exampleFormControlSelect1" placeholder="Gender" name="gender" value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : '' ?>">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                    <label for="exampleFormControlSelect1">Birth Date</label>

                                    <input id="datepicker" class="form-control" placeholder="Birth Date" name="birthDate" value="<?php echo isset($_POST['birthDate']) ? $_POST['birthDate'] : '' ?>"/>
                                    <script>
                                        $('#datepicker').datepicker({
                                            uiLibrary: 'bootstrap4'
                                        });
                                    </script>
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleFormControlSelect1">Password</label>

                                        <input type="password" class="form-control" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"
                                            name="password" placeholder="Password">

                                            
                                    </div>
                                    <div class="col-sm-6">
                                    <label for="exampleFormControlSelect1">Confirm Password</label>

                                        <input type="password" class="form-control"
                                            name="confirmpassword" placeholder="Repeat Password" value="<?php echo isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '' ?>">
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account" >
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
     <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>