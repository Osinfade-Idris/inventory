<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>

<?php
/////// To fetch master counts
	$master_product_query = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id='PRODUCT'") or die ('cannot select product table');
	$master_product_data=mysqli_fetch_array($master_product_query);	
	$product_count=$master_product_data['master_value'];
        
	$query = mysqli_query ($conn,"SELECT * FROM `order_tab` WHERE  staff_id='$loguser_id'") or die ('cannot select order table');
	$count=mysqli_num_rows($query);

	$query2 = mysqli_query ($conn,"SELECT * FROM `order_voucher_tab` WHERE  staff_id='$loguser_id'") or die ('cannot select order voucher table');
	$count2=mysqli_num_rows($query2);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Staff Portal - IVSM</title>
</head>
<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
		<?php require_once ("alert.php")?>
		<?php require_once ("header.php")?>



		<div class="dash-board-top-div">
		<div class="left-div">
			<div class="user-desc">
				<div class="pix-div"><img src="../admin-portal/upload/user-passport/<?php echo $passport?>" alt="<?php echo $fullname?> PASSPORT"/></div>

				<div class="detail">
					Welcome Back!
					<h1><?php echo $fullname?></h1>
					<span><i class="fa fa-phone"></i> <?php echo $phone_number?> </span> | <span id="env"><i class="fa fa-envelope"></i> <?php echo $email_address?> </span>
				</div>
			</div>
		</div>

		<div class="right-div">
			<div class="user-desc">
				Current Time</br>	
				<h2 id="datetime"><?php echo date("h:i:s") ?> <span> <?php echo date("A") ?> </span> </h2>
				<?php $date =  date("l, dS F, Y") ;
				echo $date
				?>  
			</div>
			<br clear="all">
		</div>
	
	</div>



	<div class="menu-div">

			<a href="product-category.php"><div class="menu-link" id="box-1">
			<div class="icon-div"><i class="fa fa-truck"></i></div>
				<div class="detail">
				<h2><?php echo $product_count?></h2>
				Products
				</div>
			</div></a>
	
			<a href="order-history.php"><div class="menu-link" id="box-4">
				<div class="icon-div"><i class="fa fa-chart-bar"></i></div>
				<div class="detail">
				<h2><?php echo $count?></h2>
				Order History
				</div>
			</div></a>

			<a href="order-voucher.php"><div class="menu-link" id="box-3">
			<div class="icon-div"><i class="fa fa-money-bill-alt"></i></div>
				<div class="detail">
				<h2></h2>
				Order Voucher
				</div>
			</div></a>

			<a href="voucher-order-history.php"><div class="menu-link" id="box-2">
			<div class="icon-div"><i class="fa fa-chart-line"></i></div>
				<div class="detail">
				<h2><?php echo $count2?></h2>
				Voucher History
				</div>
			</div></a>

	</div>
</div>



</body>
</html>