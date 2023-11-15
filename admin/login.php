
<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Login-Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class ="text-center">login</h1>
             <br><br>

             <?php 
               if(isset($_SESSION['login']))
               {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
               }

               if(isset($_SESSION['no-login-message']))
               {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
               }
  
             ?>
             <br><br>
            <!-- login form start from here-->
            <form action="" method="POST" class ="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
            </form>
            <!-- login form start from here-->

            <p class ="text-center">Created By - <a href="www.IjarulHaqueAnsari.com">Ijarul Haque Ansari</a> </p>
        </div>
    </body>
</html>

<?php 
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1.get the data from login form
     $username=$_POST['username'];
     $password=md5($_POST['password']);

     //sql to check whether tp check usernaME and password exists or not
     $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

     //3.execute the query
     $res=mysqli_query($conn,$sql);

     //count rows to check whether the user exists or not
     $count=mysqli_num_rows($res);

     if($count==1)  
     {
       //user present and login successfully
       $_SESSION['login']="<div class='success'> Login Successfully.</div>";

       $_SESSION['user']=$username; // TO CHECK WHETHER THE USER IS LOGIN OR NOT AND LOGOUT WILL UNSET IT

       //redirect to home page
       header('location:' .SITEURL.'admin/');
     }
     else
     {
        //user not present and login failed
        $_SESSION['login']="<div class='error text-center'>Username or Password Did Not Match.</div>";
          //redirect to home page
       header('location:' .SITEURL.'admin/login.php');
     }

}

?>