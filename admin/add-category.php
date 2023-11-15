<?php  include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
         echo $_SESSION['add'];
         unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
         echo $_SESSION['upload'];
         unset($_SESSION['upload']);
        }


        ?>

        <br><br>

        <!-- add category starts from here -->
        <form action="" method ="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder=" Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- add category end  here -->

        <?php
        //check whether the submit button is clicked pr not
        if(isset($_POST['submit']))
        {
            //echo"CLICKED";

            //1.get the value fron category form
            $title=$_POST['title'];

            //for radio input , we need to checked wether the button is selected  or not
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else
            {
                //set the default value
                $featured="No";
            }

            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";
            }

            //check whether the image is selected or not and set the value for image accordingly
            //print_r($_FILES['image']);

            //die(); //break the code here

            if(isset($_FILES['image']['name']))
            {
                //only upload the image
                //to upload the image  we need the source path and destiantion path
                $image_name=$_FILES['image']['name'];

                //uploadthe image only if image is selected
                if($image_name!="")
                {
                
                //auto rename our image
                //get the extension of our image like jpg,png,gif etc e.g:"specialfood1.jpg"
                $ext=end(explode('.',$image_name));

                //rename the image now
                $image_name="Food_Category_".rand(000,999).'.'.$ext; //e.g:Food_Category_834.jpg

                $source_path=$_FILES['image']['tmp_name'];
                $destination_path= "../images/category/".$image_name;

                //finally upload the image
                $upload= move_uploaded_file($source_path,$destination_path);

                //check whether the image is uploaded or not
                //and if yje image is not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload']="<div class='error'>Failed To Upload Image.</div>";
                    //redirecting to managage category page
                    header('location:' .SITEURL.'admin/add-category.php');
                    //stop the process
                    die();

                }
            }
            }
            else
            {
                //do not upload the image and set the image_name value as blank
                $image_name="";
            }

            //2.create sql query to insert category into database            
            $sql="INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'";

            //3.execute the query and save in database
            $res=mysqli_query($conn,$sql);

            //4.check whether the query executed or not and data added or not
            if($res==true)
            {
                //query eecuted and category added
                $_SESSION['add']="<div class='success'>Category Added Successfuy.</div>";
                //redirecting to managage category page
                header('location:' .SITEURL.'admin/manage-category.php');
            }
            else
            {
                //failed to add category
                $_SESSION['add']="<div class='error'>Failed To Added Category.</div>";
                //redirecting to managage category page
                header('location:' .SITEURL.'admin/add-category.php');

            }
        }
        ?>
    </div>
</div>

<?php  include('partials/footer.php');?>