<?php

include "includes/config.php"; // Using database connection file here

$id = $_POST['delete']; // get id through query string

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
?>