<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>



<?php
$product_id=$_GET['product_id'];
$category_id=$_GET['category_id'];

$productquery = mysqli_query ($conn,"SELECT product_name FROM `product_tab` WHERE product_id = '$product_id'");
	$productfetch=mysqli_fetch_array($productquery);
	$product_name=$productfetch['product_name'];
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Add New Category</title>
</head>
<body>
<?php require_once ("navigation.php")?>


<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        <div class="page-name-div">
	        <div class="page-name">
			<h1><i class="fa fa-mobile-alt"></i> LOAD <?php echo $product_name?></h1>
		</div>
        </div>


       
        <div class="profile-details">
                <form action="../connection/code.php?action=load_product&category_id=<?php echo $category_id?>&product_id=<?php echo $product_id?>"  enctype="multipart/form-data" method="post">
                <div class="span"> QUANTITY:</div>
                <input id="product_quantity" name="product_quantity" type="number" type="text" class="qty-field" placeholder="Enter Quantity" title="Quantity" value="" required/>
                <button type="submit" class="btn"> SUBMIT <i class="fa fa-check"></i></button>                
                </form> 
        </div>




        




                
</div>





</body>
</html>



