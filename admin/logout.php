<?php
//include constants.php
include('../config/constants.php');

//1.destroy the session 
session_destroy(); //unset $_SESSION['USER']

//2.redirect to login page
header('location:' .SITEURL.'admin/login.php');
?>