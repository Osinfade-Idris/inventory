<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Categories - IVSM</title>
</head>
<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
	<?php require_once ("alert.php")?>
	<?php require_once ("header.php")?>

	<div class="page-name-div">
		<div class="page-name">
			<a href="add-category.php"><button type="submit"><i class="fa fa-plus"></i> Add Category</button></a>
			<h1><i class="fa fa-landmark"></i> All Categories</h1>
		</div>	
	</div>

	<div class="user-details-div">
		<?php
			$categoryprofilequery = mysqli_query ($conn,"SELECT * FROM `category_tab`") or die ('cannot select category');
			$count=0;
			while($categoryprofiledata=mysqli_fetch_array($categoryprofilequery)){
				$count++;
			$category_id=$categoryprofiledata['category_id'];
			$category_name=$categoryprofiledata['category_name'];
		?>
			<a href="category-profile.php?category_id=<?php echo $category_id?>">
			<div class="details-div">
					<div class="detail">
						<h2><?php echo $category_name?></h2>	 
					</div>
				<br clear="all">
			</div></a>
		<?php }?>
	</div>

	<?php
		if ($count==0){?>
		<div class="search-alert-div">
		<i class="fa fa-stop"></i> No Category Found
		</div>     
    <?php }?>
</div>
</body>
</html>