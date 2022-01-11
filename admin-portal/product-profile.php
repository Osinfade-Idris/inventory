<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php 
$product_id=$_GET['product_id'];?>

<?php
/////// To fetch user details into profile page
        $productprofilequery = mysqli_query ($conn,"SELECT * FROM `product_tab` WHERE product_id = '$product_id'") or die ('cannot select product');
        $productprofiledata=mysqli_fetch_array($productprofilequery);


        $product_pro_category_id=$productprofiledata['category_id'];
		///// for category name
        $productcategoryquery = mysqli_query ($conn,"SELECT * FROM `category_tab` WHERE category_id = '$product_pro_category_id'") or die ('cannot select category_tab');
        $productcategorydata=mysqli_fetch_array($productcategoryquery);
        $product_pro_category_name=$productcategorydata['category_name'];

        $productpro_name=$productprofiledata['product_name'];	
	$productpro_details=$productprofiledata['product_details'];

        $productpro_price=$productprofiledata['product_price'];

        
	$productpro_status_id=$productprofiledata['product_status'];
        ///// for status name
        $productstatusquery = mysqli_query ($conn,"SELECT * FROM `status_tab` WHERE status_id = '$productpro_status_id'") or die ('cannot select status_tab');
        $productstatusdata=mysqli_fetch_array($productstatusquery);
        $productpro_status_name=$productstatusdata['status_name'];

        $productpro_picture=$productprofiledata['product_picture'];
        
?>


<?php
		$query = mysqli_query ($conn,"SELECT COALESCE(
                sum(quantity) - (SELECT COALESCE(sum(cart_qty),0) FROM cart_tab 
                WHERE product_id='$product_id' AND order_status_id='S')
                ,0) FROM load_product_tab 
                WHERE product_id='$product_id'");
                $fetch=mysqli_fetch_array($query);
		$stock_remaining=$fetch[0];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Product Profile - IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>

<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
	<div class="page-name">
             
                <a href="load-product.php?category_id=<?php echo $product_pro_category_id?>&product_id=<?php echo $product_id?>">
                <button type="submit">(<?php echo $stock_remaining?>) -- <i class="fa fa-plus"></i> Load Stock</button></a>
	        <h1><i class="fa fa-eye"></i> Product Profile</h1>
	</div>
        </div>
        
        <div class="profile-details">
        <form action="../connection/code.php?action=update_product_profile&product_id=<?php echo $product_id?>"  enctype="multipart/form-data" method="post">
                <div class="profile-pix">                                        
                <img src="upload/product-picture/<?php echo $productpro_picture?>" alt="<?php echo $productpro_name?> logo"/>                     
                </div>
                <div class="span"> CHANGE PRODUCT PICTURE:</div>
		<input type="file" name="product_picture"  class="picture-field">

                <div class="span"> PRODUCT NAME:</div>
                <input id="product_name"  name="product_name" type="text" class="text-field" placeholder="product_name" title="PRODUCT NAME" value="<?php echo $productpro_name?>" required>  
        </div>


        <div class="profile-details">
                <div class="span"> PRODUCT DETAILS:</div>
                <textarea rows="7" input id="product_details" name="product_details" type="text" class="text-field" placeholder="Enter Product Details" title="PRODUCT DETAILS" required><?php echo $productpro_details?></textarea>
                
                <div class="span">PRODUCT PRICE:</div>
                <input id="product_price"  name="product_price" class="text-field" placeholder="Enter Product Price" title="PRICE" value="<?php echo $productpro_price?>" required/>


                <div class="span"> STATUS:</div>
                <select name="product_status" id="product_status" class="combo-field" required>
                <option value="<?php echo $productpro_status_id?>"><?php echo $productpro_status_name?></option>
                <?php
                $statusquery = mysqli_query ($conn,"SELECT * FROM `status_tab`");
                while($statusdata=mysqli_fetch_array($statusquery)){
                $status_id=$statusdata['status_id'];
                $status_name=$statusdata['status_name'];       
                ?>
                <option value="<?php echo $status_id?>"><?php echo $status_name?></option>
                <?php }?>
                </select>
                
                <button type="submit" class="btn"> UPDATE PRODUCT <i class="fa fa-check"></i></button>
        </form>
        </div>


       
        
</div>

</body>
</html>