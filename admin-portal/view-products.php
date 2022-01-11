<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php 
$category_id=$_GET['category_id'];

$cat_query = mysqli_query ($conn,"SELECT category_name FROM `category_tab` WHERE category_id='$category_id'") or die ('cannot select staff table');
$cat_name=mysqli_fetch_array($cat_query);	
$product_cat=$cat_name['category_name'];	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Products- IVSM</title>
</head>
<body>

<?php require_once ("navigation.php")?>

<div class="body-div">
		  <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
      <div class="page-name-div">
        <div class="page-name">
            <h1><i class="fa fa-landmark"> </i> All <?php echo $product_cat?></h1>
        </div>
      </div>

      
      <div class="search-div">
        <input class="box" type="text" id="product_search_txt" placeholder="TYPE HERE TO SEARCH FOR A PRODUCT..." onkeyup="product_search('<?php echo $category_id?>')">	
      </div>
    

      <div class="product-details-div">	   	
<?php
	$productprofilequery = mysqli_query ($conn,"SELECT * FROM `product_tab` WHERE category_id='$category_id'") or die ('cannot select product');
	
	$count=0;
		while($productprofiledata=mysqli_fetch_array($productprofilequery)){
      $count++;
		        $product_id=$productprofiledata['product_id'];
		


            $product_pro_category_id=$productprofiledata['category_id'];
            ///// for category name
            $schoolcategoryquery = mysqli_query ($conn,"SELECT * FROM `category_tab` WHERE category_id = '$product_pro_category_id'") or die ('cannot select category_tab');
            $categorydata=mysqli_fetch_array($schoolcategoryquery);
            $product_pro_category_name=$categorydata['category_name'];
    
            $productpro_name=$productprofiledata['product_name'];	
            $productpro_details=$productprofiledata['product_details'];
            $productpro_quantity=$productprofiledata['product_quantity'];
            $productpro_price=$productprofiledata['product_price'];
            $productpro_picture=$productprofiledata['product_picture'];
?>
      <a href="product-profile.php?category_id=<?php echo $product_pro_category_id?>&product_id=<?php echo $product_id?>">
            <div class="product-details">
            <div class="div">

            <?php
							$query = mysqli_query ($conn,"SELECT COALESCE(
                sum(quantity) - (SELECT COALESCE(sum(cart_qty),0) FROM cart_tab 
                WHERE product_id='$product_id' AND order_status_id='S')
                ,0) FROM load_product_tab 
                WHERE product_id='$product_id'");

							$fetch=mysqli_fetch_array($query);
								$stock_remaining=$fetch[0];
								
							?>

            <div class="qty"><?php echo $stock_remaining?></div>
            <div class="pix-div"><img src="upload/product-picture/<?php echo $productpro_picture?>" alt="<?php echo $productpro_name?>"/></div>
              <div class="text">
                <h4><?php echo $productpro_name?></h4>
                <div class="details"><?php echo $productpro_details?></div> 
                  <div class="price">
                      <s>N</s><?php echo number_format($productpro_price) ?>            
                  </div>
              </div>
            </div>
          </div></a>


          <?php }?>

          
          <?php
		  	if ($count==0){?>
            <div class="search-alert-div">
              <i class="fa fa-stop"></i> No Product Found
              </div>     
              <?php }?>
          
		  </div>










</div>

</body>
</html>