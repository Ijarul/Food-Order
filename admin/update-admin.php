<?php include('partials/menu.php');?>


<div class="main-content">
    <div class= "wrapper">
        <h1>Update Admin</h1>
        
        <br><br>

        <?php
        //1.get the id of selected admin
        $id=$_GET['id'];

        //2.create the query to get the details
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        
        //execute the query
        $res=mysqli_query($conn,$sql);

        //check the whether the query is execute orr not
        if($res==true)
        {
          //check whether the data is avialable or not 
          $count=mysqli_num_rows($res);

          //check wherher we have admin data or not

          if($count)
          {
            //get the details

            //echo "admin available";
            $row=mysqli_fetch_assoc($res);

            $full_name=$row['full_name'];
            $username=$row['username'];
          }
          else
          {
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');

          }
        }
        ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td>Full Name</td>
                    <td><input tupe="text" name="full_name" value="<?php echo $full_name;?>"></td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td><input tupe="text" name="username" value="<?php echo $username;?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit"value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

// check whether the submit buttom is clicked or not
if(isset($_POST['submit']))
{
    //echo "button is clicked";
    //get all the value from the form
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username']; 

    //create a sql query to update admin
    $sql="UPDATE tbl_admin SET full_name='$full_name',username='$username' WHERE ID ='$id'";

    //execute the query
    $res=mysqli_query($conn,$sql);

    //check whether the query executed successfully or not
    if($res==true)
    {
        //query executen and admin updated
        $_SESSION['update']="<div class='success'>Admin Updated Successfully.</div>";

        //redirect to the manage admin page 
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to update admin
        $_SESSION['update']="<div class='error'>Failed to Delete Admin.</div>";

        //redirect to the manage admin page 
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
}
?>


<?php include('partials/footer.php');?>