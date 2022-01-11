<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Product Category - IVSM</title>
</head>

<body>


<?php require_once ("navigation.php")?>
<div class="body-div">
		<?php require_once ("alert.php")?>
		<?php require_once ("header.php")?>

        <div class="page-name-div">
			<div class="page-name">
                    <h1><i class="fa fa-solar-panel"></i> Product Categories</h1>
			</div>
        </div>

	<div class="menu-div">

	<?php
	$count=0;
	$categoryquery = mysqli_query ($conn,"SELECT * FROM `category_tab`") or die ('cannot select category');
	$count++;
	while($categorydata=mysqli_fetch_array($categoryquery)){
         $category_id=$categorydata['category_id'];
         $category_name=$categorydata['category_name'];
     
     ?>
	<a href="view-products.php?category_id=<?php echo $category_id?>"><div class="category-link">
    <div class="icon-div"><i class="fa fa-mobile-alt"></i></div>
				<div class="detail">
					<h2><?php echo $category_name?></h2>
					
				</div>
			</div></a>
 <?php }?>
	</div>

	<?php
		  	if ($count==0){?>
            <div class="search-alert-div">
              <i class="fa fa-stop"></i> No Product Found
              </div>     
              <?php }?>
</div>



</body>
</html>