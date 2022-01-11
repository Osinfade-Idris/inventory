<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Invoice - IVSM </title>
</head>

<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
	<?php require_once ("alert.php")?>
	<?php require_once ("header.php")?>

	<div class="page-name-div">
		<div class="page-name">
			<h1><i class="fa fa-file-invoice"></i> Invoice E-COMMERCE</h1>
		</div>	
	</div>

	<div class="cart-details-div">	

	<?php
	$cartquery = mysqli_query ($conn,"SELECT * FROM `cart_tab` WHERE order_id='$order_id'") or die ('cannot select cart');
	while($cartdata=mysqli_fetch_array($cartquery)){
		$product_id=$cartdata['product_id'];
		///// for product name and product picture
		$productquery = mysqli_query ($conn,"SELECT * FROM `product_tab` WHERE product_id = '$product_id'") or die ('cannot select role');
		$productdata=mysqli_fetch_array($productquery);
		$product_name=$productdata['product_name'];
		$product_picture=$productdata['product_picture'];


		$cart_qty=$cartdata['cart_qty'];
		$unit_price=$cartdata['unit_price'];
		$sub_amount=$cartdata['sub_amount'];
	?>

		<div class="details-div">
				<div class="pix-div"><img src="../admin-portal/upload/product-picture/<?php echo $product_picture?>" alt=" PASSPORT"/></div>
				<div class="detail">
					<h2><?php echo $product_name?></h2>
					<span>Unit Price: <s>N</s><?php echo number_format($unit_price) ?></span> | <span>Qty: <?php echo $cart_qty?></span>
					<h3>Sub Amount: <span><s>N</s><?php echo number_format($sub_amount) ?></span></h3>
					<a href="product-profile.php?product_id=<?php echo $product_id?>"><button type="submit" class="btn-2"><i class="fa fa-edit"></i> Edit</button></a>
					
					
					<form action="../connection/staff-code.php?action=delete_cart&product_id=<?php echo $product_id?>&order_id=<?php echo $order_id?>"  enctype="multipart/form-data" method="post">
					<button type="submit" ><i class="fa fa-trash"></i> Delete</button>
					</form>
					<br clear="all">
				</div>
		</div>
				<?php }?>
			
			
		
		
	</div>

	

	<?php
	$query = mysqli_query ($conn,"SELECT sum(sub_amount) FROM `cart_tab` WHERE order_id = '$order_id'");
	$fetch=mysqli_fetch_array($query);
	$total_amount=$fetch[0];
	if ($total_amount==''){$total_amount=0;}
	?>
	<div class="total-div">TOTAL AMOUNT OF GOODS: <span><s>N</s><?php echo number_format($total_amount) ?></span></div>

	<div class="col-3">
	<form action="../connection/staff-code.php?action=place_order&order_id=<?php echo $order_id?>"  enctype="multipart/form-data" method="post">
		
		<select name="payment_method_id" id="payment_method_id" class="combo-field" required>
		<option value="" selected>SELECT A PAYMENT METHOD</option>
		<?php
		$paymentmethodquery = mysqli_query ($conn,"SELECT * FROM `payment_method_tab`");
		while($paymentmethoddata=mysqli_fetch_array($paymentmethodquery)){
		$payment_method_id=$paymentmethoddata['payment_method_id'];
		$payment_method_name=$paymentmethoddata['payment_method_name'];       
		?>
		<option value="<?php echo $payment_method_id?>"><?php echo $payment_method_name?></option>
		<?php }?>
		</select>

		<input id="customer_name" name="customer_name" type="text" class="text-field" placeholder="INPUT CUSTOMER NAME" title="FULL NAME" value="<?php echo $pro_email?>" required>
		<input id="customer_phone" name="customer_phone" type="text" class="text-field" placeholder="INPUT CUSTOMER PHONE NUMBER" title="PHONE NUMBER" value="<?php echo $pro_email?>" required>
		<input id="customer_email" name="customer_email" type="email" class="text-field" placeholder="INPUT CUSTOMER EMAIL" title="EMAIL ADDRESS" value="<?php echo $pro_email?>" required>
		
		
		<button type="submit" ><i class="fa fa-cart-arrow-down"></i> PLACE ORDER</button>
	</form>
	</div>

	
</div>

</body>
</html>