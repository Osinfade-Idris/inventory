<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php $load_product_id=$_GET['lp_id'];?>

<?php
        /////// To fetch stock details into stock details page
        $loadprofilequery = mysqli_query ($conn,"SELECT * FROM `load_product_tab` WHERE lp_id = '$load_product_id'") or die ('cannot select lp');
        $loadprofiledata=mysqli_fetch_array($loadprofilequery);
       

        $qty=$loadprofiledata['quantity'];

        $lp_product_id=$loadprofiledata['product_id'];	    
        ///// for product name
        $productquery = mysqli_query($conn,"SELECT * FROM `product_tab` WHERE `product_id` = '$lp_product_id'") or die ('cannot select product');
		$productdata=mysqli_fetch_array($productquery);
		$lp_product_name=$productdata['product_name'];
        
    
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Load Details - IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>

<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
	<div class="page-name">
	        <h1><i class="fa fa-clipboard"></i> Product Details</h1>
	</div>
        </div>

        <div class="profile-div">
            <div class="title-div">
                <i class="fa fa-user-circle"></i>
                <span>PRODUCT DETAILS</span>  
        </div>
        </div>
        
        <form action="../connection/code.php?action=update_product_stock&lp_id=<?php echo $load_product_id?>"  enctype="multipart/form-data" method="post">
        <div class="profile-details">
                <div class="span"> PRODUCT NAME:</div>
                <input id="" name="" type="text" class="text-field" placeholder="PRODUCT NAME" title="Quantity" value="<?php echo $lp_product_name?>" readonly required/>
                
                <div class="span">Qty:</div>
                <input id="load_product_quantity" name="load_product_quantity" type="number" class="qty-field" placeholder="Qty" title="Quantity" value="<?php echo $qty?>"  required/>

                <button type="submit" class="btn"><i class="fa fa-clipboard"></i> UPDATE</button>          
            </form>
        </div>  


       
        
</div>

</body>
</html>