<?php

//include constrants.php file here
include('../config/constants.php');

//1.get the id of admin to delete$
 $id=$_GET['id'];

//2. create sqql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";

//execute thw query
$res= mysqli_query($conn,$sql);

//check whether the query execute successfully ot not 
if($res==true)
{
    //query executed successfully amd admin deleted
    //echo"Admin Deleted";
    //create session variable to display message
    $_SESSION['delete']=" <div class='success'>Admin Deleted Successsfully.</div>";

    //redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    //failed to delete admin\
    //echo "failed to delete admin";

    $_SESSION['delete']=" <div class='error'>Failed to Delete Admin.Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//3.redirect to manage the admiin page with message (success/error)

?>