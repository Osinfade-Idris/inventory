<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php
/////// To fetch master counts
	$master_user_query = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id='STAFF'") or die ('cannot select staff table');
	$master_user_data=mysqli_fetch_array($master_user_query);	
	$user_count=$master_user_data['master_value'];	
	
	$master_category_query = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id='CATEGORY'") or die ('cannot select category table');
	$master_category_data=mysqli_fetch_array($master_category_query);	
	$category_count=$master_category_data['master_value'];	

	$master_product_query = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id='PRODUCT'") or die ('cannot select product table');
	$master_product_data=mysqli_fetch_array($master_product_query);	
	$product_count=$master_product_data['master_value'];

	$query = mysqli_query ($conn,"SELECT * FROM `order_tab`") or die ('cannot select order table');
	$count=mysqli_num_rows($query);
	
	$credit_query = mysqli_query ($conn,"SELECT * FROM `order_voucher_tab` WHERE payment_type_id='002'") or die ('cannot select order table');
	$credit_count=mysqli_num_rows($credit_query);    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Admin Portal - IVSM</title>
</head>

<body>
<?php require_once ("navigation.php")?>
<div class="body-div">
		<?php require_once ("alert.php")?>
		<?php require_once ("header.php")?>

	<div class="dash-board-top-div">
		<div class="left-div">
			<div class="user-desc">
				<div class="pix-div"><img src="upload/user-passport/<?php echo $passport?>" alt="<?php echo $fullname?> PASSPORT"/></div>

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
				<h2 id="datetime"><?php echo date("h:i:s") ?> <span> <?php echo date("A") ?> </span></h2>
				<?php $date =  date("l, dS F, Y") ;
				echo $date
				?>  
			</div>
			<br clear="all">
		</div>
	
	</div>


	
	<div class="vms-title"><i class="fa fa-store-alt"></i> E-COMMERCE</div>
	<div class="menu-div">
		
			<a href="all-staffs.php"><div class="menu-link" id="box-3">
				<div class="icon-div"><i class="fa fa-users"></i></div>
				<div class="detail">
					<h2><?php echo $user_count?></h2>
					ALL STAFFS
				</div>
			</div></a>

			<a href="category.php"><div class="menu-link">
				<div class="icon-div"><i class="fa fa-warehouse"></i></div>
				<div class="detail">
					<h2><?php echo $category_count?></h2>
					CATEGORIES
				</div>
			</div></a>

			<a href="product-category.php"><div class="menu-link" id="box-1">
			<div class="icon-div"><i class="fa fa-truck"></i></div>
				<div class="detail">
				<h2><?php echo $product_count?></h2>
				PRODUCTS
				</div>			
			</div></a>
	
			<a href="order-history.php"><div class="menu-link" id="box-4">
				<div class="icon-div"><i class="fa fa-chart-bar"></i></div>
				<div class="detail">
				<h2><?php echo $count?></h2>
				ORDER HISTORY				
				</div>
			</div></a>
	</div>
	<br clear="all">

	<div class="vms-title"><i class="fa fa-chart-bar"></i> VOUCHER MANAGEMENT SYSTEM</div>
	<div class="voucher-management-div">	
			<div class="menu-div" id="vms-div">
					<a href="add-stock.php"><div class="menu-link" id="box-3">
						<div class="icon-div"><i class="fa fa-clipboard"></i></div>
						<div class="detail">		
							LOAD STOCK
						</div>
					</div></a>

					<a href="voucher-denomination.php"><div class="menu-link"  id="box-2">
						<div class="icon-div"><i class="fa fa-poll"></i></div>
						<div class="detail">
							VOUCHER</br> DENOMINATION
						</div>
					</div></a>

					<a href=""><div class="menu-link" id="box-1">
						<div class="icon-div"><i class="fa fa-money-bill-alt"></i></div>
						<div class="detail">
						CREDIT ORDERS </br>
						<h2><?php echo $credit_count?> </h2>
						</div>
					</div></a>

					<a href="voucher-order-history.php"><div class="menu-link">
						<div class="icon-div"><i class="fa fa-chart-line"></i></div>
						<div class="detail">				
							VOUCHER REPORT
						</div>
					</div></a>
			</div>

			<div class="menu-div" id="stat-div">
					<a href="view-stock.php?voucher_id=001"><div class="menu-link" id="box-3">
						<div class="detail">			
							MTN
							<?php
							$query = mysqli_query ($conn,"SELECT sum(c.qty)-
							(
							SELECT  sum(a.order_qty) 
							FROM voucher_cart_tab a, `voucher_denomination_tab` b
							WHERE a.vd_id=b.vd_id AND a.order_status_id='S'AND b.voucher_id='001'
							) 
							FROM 
							`load_stock_tab` c WHERE c.voucher_id='001'");
								$fetch=mysqli_fetch_array($query);
								$stock_remaining=$fetch[0];
								if ($stock_remaining==''){$stock_remaining=0;}
							?>
						<button type="submit" class="btn"><?php echo $stock_remaining;?></button>
						</div>
					</div></a>

					<a href="view-stock.php?voucher_id=002"><div class="menu-link" id="box-2">	
						<div class="detail">		
							GLO
							<?php
							$query = mysqli_query ($conn,"SELECT sum(c.qty)-
							(
							SELECT  sum(a.order_qty) 
							FROM voucher_cart_tab a, `voucher_denomination_tab` b
							WHERE a.vd_id=b.vd_id AND a.order_status_id='S'AND b.voucher_id='002'
							) 
							FROM 
							`load_stock_tab` c WHERE c.voucher_id='002'");
								$fetch=mysqli_fetch_array($query);
								$stock_remaining=$fetch[0];
								if ($stock_remaining==''){$stock_remaining=0;}
							?>
							<button type="submit" class="btn"><?php echo $stock_remaining;?></button>
						</div>
					</div></a>

					<a href="view-stock.php?voucher_id=003"><div class="menu-link">
						<div class="detail">				
							AIRTEL
							<?php
							$query = mysqli_query ($conn,"SELECT sum(c.qty)-
							(
							SELECT  sum(a.order_qty) 
							FROM voucher_cart_tab a, `voucher_denomination_tab` b
							WHERE a.vd_id=b.vd_id AND a.order_status_id='S'AND b.voucher_id='003'
							) 
							FROM 
							`load_stock_tab` c WHERE c.voucher_id='003'");
								$fetch=mysqli_fetch_array($query);
								$stock_remaining=$fetch[0];
								if ($stock_remaining==''){$stock_remaining=0;}
							?>
							<button type="submit" class="btn"><?php echo $stock_remaining;?></button>
						</div>
					</div></a>

					<a href="view-stock.php?voucher_id=004"><div class="menu-link" id="box-1">
						<div class="detail">
							9 MOBILE
							<?php
							$query = mysqli_query ($conn,"SELECT sum(c.qty)-
							(
							SELECT  sum(a.order_qty) 
							FROM voucher_cart_tab a, `voucher_denomination_tab` b
							WHERE a.vd_id=b.vd_id AND a.order_status_id='S'AND b.voucher_id='004'
							) 
							FROM 
							`load_stock_tab` c WHERE c.voucher_id='004'");
								$fetch=mysqli_fetch_array($query);
								$stock_remaining=$fetch[0];
								if ($stock_remaining==''){$stock_remaining=0;}
							?>
							<button type="submit" class="btn"><?php echo $stock_remaining;?></button>
						</div>
					</div></a>

					
			</div>
			
		

	</div>

</div>






</body>
</html>