<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Add New Product</title>
</head>
<body>
<?php require_once ("navigation.php")?>


<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        <div class="page-name-div">
	        <div class="page-name">
			<h1><i class="fa fa-school"></i> Add New Product</h1>
		</div>
        </div>

        <form action="../connection/code.php?action=product_reg"  enctype="multipart/form-data" method="post">
                <div class="profile-details">
                        <div class="span"> CATEGORY NAME:</div>
                        <select name="product_category_name" id="product_category_name" class="combo-field" required>
                                <option value="" selected>SELECT A PRODUCT CATEGORY</option>
                                        <?php
                                        $categoryquery = mysqli_query ($conn,"SELECT * FROM `category_tab`");
                                        while($categorydata=mysqli_fetch_array($categoryquery)){
                                        $category_id=$categorydata['category_id'];
                                        $category_name=$categorydata['category_name'];       
                                        ?>
                                <option value="<?php echo $category_id?>"><?php echo $category_name?></option>
                                        <?php }?>
                        </select>

                        <div class="span"> PRODUCT NAME:</div>
                        <input id="product_name" name="product_name" type="text" class="text-field" placeholder="Enter Product Name" title="LAST NAME" value="" required/>

                        <div class="span"> PRODUCT DETAILS:</div>
                        <textarea rows="7" input id="product_details" name="product_details" type="text" class="text-field" placeholder="Enter Product Details" title="PRODUCT DETAILS" value="" required></textarea>
                </div>

                <div class="profile-details">
                        <div class="span"> SELECT PRODUCT PICTURE:</div>
                        <input type="file" name="product_picture"  class="text-field" required/>           
                        
                        <div class="span">PRODUCT PRICE:</div>
                        <input id="product_price" name="product_price" class="text-field" placeholder="Enter Product Price" title="PRICE" value="" required/>

                        <div class="span"> STATUS:</div>
                        <select name="product_status" id="status" class="combo-field" required>
                                <option value="" selected>SELECT A STATUS</option>
                                        <?php
                                        $statusquery = mysqli_query ($conn,"SELECT * FROM `status_tab`");
                                        while($statusdata=mysqli_fetch_array($statusquery)){
                                        $status_id=$statusdata['status_id'];
                                        $status_name=$statusdata['status_name'];       
                                        ?>
                                <option value="<?php echo $status_id?>"><?php echo $status_name?></option>
                                        <?php }?>
                        </select>
                        
                        <button type="submit" class="btn"> SUBMIT <i class="fa fa-check"></i></button> 
                </div>
        </form>   
</div>
</body>
</html>



