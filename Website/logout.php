<?php
// Include config file
require_once "includes/config.php";
session_start();
session_destroy();
header ("Location: login.php");

?>