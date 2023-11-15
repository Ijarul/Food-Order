<?php 
//AUTHORIZATIO - CONTROL ACCESS
//TO CHECK WHETHER THE USER IS LOGGED IN OPT NOT

               if(!isset($_SESSION['user']))// if user session is not set
               {

                //user is not logged in
                //rediect to login page with message
                echo $_SESSION['no-login-message'] = "<div class='error text-center'> Please Login To Access Admin Panel.</div>";
                //redirect to login page
                header('location:' .SITEURL.'admin/login.php');
               }
  

?>
