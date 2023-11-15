<?php include("partials/menu.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php 
             if(isset($_SESSION['add']))//checking whether the session is set or not
             {
              echo $_SESSION['add'];//DISPALYING SESSION MESSAGE
              unset($_SESSION['add']);//REMOVING SESSION MESSAGE
             }
             ?>
        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:  </td>
                <td>
                    <input type="text"name="full_name" placeholder="Enter Your Name">
                </td>
            </tr>

            <tr>
                <td>Username:  </td>
                <td>
                    <input type="text"name="username" placeholder="Your username">
                </td>
            </tr>

            <tr>
                <td>Password:  </td>
                <td>
                    <input type="password"name="password" placeholder="Enter Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php");?>
<?php 

//Process tje value from form and save it in Database
//checked whether the submit buttom is clicked or not

if(isset($_POST['submit']))
{
    //button clicked
    //1.gwt the data from form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']); //md5 for encrypting our password

    //2.SQL Query to save data into databae
    $sql="INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'";

    
   
 //3.EXECUTING QUERY AND SAVING DATA INTO DATABASE
    $res=mysqli_query($conn,$sql) or die(mysqli_error());
   
    //CHECKED WHETHER THE QUERY IS EXECUTED DATA IS INSEERTED OR NOT AND DISPLAY APPROPRIATE  MESSAGE

    if($res==TRUE)
    {
        //data inserted
        //echo"Data Inserted";
        //create a variable to display a message
        $_SESSION['add'] ="Admin Added Successfully";

        //redirect pages TO MANAGE ADMIN
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Inserted data
        //echo"Fail to Insert Data";
        //create a variable to display a message
        $_SESSION['add'] ="Failed to Add Admin";

        //redirect pages TO MANAGE ADMIN
        header("location:".SITEURL.'admin/add-admin.php');
    }
}

?>