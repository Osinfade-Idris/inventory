<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php $product_id=$_GET['product_id'];?>

<?php
/////// To fetch user details into profile page
        $productprofilequery = mysqli_query ($conn,"SELECT * FROM `product_tab` WHERE product_id = '$product_id'") or die ('cannot select product');
        $productprofiledata=mysqli_fetch_array($productprofilequery);
        $productpro_name=$productprofiledata['product_name'];	
	$productpro_details=$productprofiledata['product_details'];
        $productpro_quantity=$productprofiledata['product_quantity'];
        $productpro_price=$productprofiledata['product_price'];
        $productpro_picture=$productprofiledata['product_picture']; 
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
	        <h1><i class="fa fa-eye"></i> Product Profile</h1>
	</div>
        </div>
        
        <div class="profile-details">
        
                <div class="profile-pix">                                        
                <img src="../admin-portal/upload/product-picture/<?php echo $productpro_picture?>" alt="<?php echo $productpro_name?> logo"/>                     
                </div>

                <div class="span"> PRODUCT NAME:</div>
                <input id="product_name"   type="text" class="text-field" placeholder="product_name" title="PRODUCT NAME" value="<?php echo $productpro_name?>" readonly required>  
        </div>


        <div class="profile-details">
                <div class="span"> PRODUCT DETAILS:</div>
                <textarea rows="7" input id="product_details"  type="text" class="text-field" placeholder="Enter Product Details" title="PRODUCT DETAILS" readonly required><?php echo $productpro_details?></textarea>
                
                <div class="span">PRODUCT PRICE:</div>
                <input id="product_price"   class="text-field" placeholder="Enter Product Price" title="PRICE" value="<?php echo $productpro_price?>" readonly required/>



                <div class="span">STOCK:</div>
                <?php 
              $load_product_tab_query = mysqli_query ($conn,"SELECT sum(quantity) from load_product_tab where product_id='$product_id'") or die ('cannot select staff table');
              $load_product_tab_count=mysqli_fetch_array($load_product_tab_query);	
              $stock_in_store=$load_product_tab_count['sum(quantity)'];	

              $cart_tab_query = mysqli_query ($conn,"SELECT sum(cart_qty) from cart_tab where product_id='$product_id' and order_status_id='S'") or die ('cannot select staff table');
              $cart_tab_count=mysqli_fetch_array($cart_tab_query);	
              $stock_sold=$cart_tab_count['sum(cart_qty)'];	

              $remaining_stock = ($stock_in_store - $stock_sold);

              if ($remaining_stock==''){$remaining_stock=0;}
                 ?>
                <input id="product_quantity"  class="text-field" placeholder="Enter Product Quantity" title="PRICE QUANTITY" value="<?php echo $remaining_stock?>" readonly required/>
               
               
               
               <?php
                $productquery = mysqli_query ($conn,"SELECT sum(cart_qty) FROM `cart_tab` WHERE order_id = '$order_id' AND product_id='$product_id'");
                $productfetch=mysqli_fetch_array($productquery);
                $product_qty=$productfetch[0];

                /////// To fetch present product cart quantity
                if ($product_qty>0){
                $product_qty=$product_qty;
                }else{
                        $product_qty=1;
                }     
                ?>        
                
                <form action="../connection/staff-code.php?action=add_to_cart&product_id=<?php echo $product_id?>" enctype="multipart/form-data" method="post">
                <div class="span">Qty:</div>
                <input id="qty" name="product_quantity" type="number" class="qty-field" placeholder="Qty" title="Quantity" value="<?php echo $product_qty?>"  required/>

                <button type="submit" class="btn"> ADD TO CART <i class="fa fa-cart-arrow-down"></i></button>
                </form>
        </div>


       
        
</div>

</body>
</html>