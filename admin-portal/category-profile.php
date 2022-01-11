<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>
<?php $category_id=$_GET['category_id'];?>

<?php
        $categoryprofilequery = mysqli_query ($conn,"SELECT * FROM `category_tab` WHERE category_id = '$category_id'") or die ('cannot select category');
        $categoryprofiledata=mysqli_fetch_array($categoryprofilequery);
        $pro_categoryname=$categoryprofiledata['category_name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Category Profile - IVSM</title>
</head>
<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
                <div class="page-name">
                        <h1><i class="fa fa-eye"></i> Category Profile</h1>
                </div>
        </div>

        <form action="../connection/code.php?action=update_category_profile"  enctype="multipart/form-data" method="post">
                <div class="profile-details">
                        <div class="span"> CATEGORY NAME:</div>
                        <input  name="category_name" type="text" class="text-field" placeholder="category_name" title="CATEGORY NAME" value="<?php echo $pro_categoryname?>" required>
                
                        <button type="submit" class="btn"> UPDATE PROFILE <i class="fa fa-check"></i></button>
                </div>
        </form>
</div>

</body>
</html>