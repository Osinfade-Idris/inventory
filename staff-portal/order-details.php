<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>

<?php $order_id=$_GET['order_id'];?>


<?php
/////// To fetch order details into order details page
        $orderprofilequery = mysqli_query ($conn,"SELECT * FROM `order_tab` WHERE order_id = '$order_id'") or die ('cannot select order');
		$orderprofiledata=mysqli_fetch_array($orderprofilequery);
		
		$total_qty_goods=$orderprofiledata['total_qty'];
		$total_amount_goods=$orderprofiledata['total_amount'];
		$date_entered=$orderprofiledata['date_entered'];
		
		$staff_id=$orderprofiledata['staff_id'];
		///// for staff name
        $staffquery = mysqli_query($conn,"SELECT * FROM `staff_tab` WHERE `user_id` = '$staff_id'") or die ('cannot select staff');
		$staffdata=mysqli_fetch_array($staffquery);
		$staff_first_name=$staffdata['first_name'];
		$staff_last_name=$staffdata['last_name'];
		$staff_full_name="$staff_first_name $staff_last_name";
		

        $customer_id=$orderprofiledata['customer_id'];
        ///// for customer name
        $customerquery = mysqli_query ($conn,"SELECT * FROM `customer_tab` WHERE customer_id = '$customer_id'") or die ('cannot select customer');
		$customerdata=mysqli_fetch_array($customerquery);
		$customer_name=$customerdata['customer_name'];
		$customer_email=$customerdata['customer_email'];
		$customer_phone=$customerdata['customer_phone'];
        
        
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Order Details - IVSM </title>
</head>

<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
	<?php require_once ("alert.php")?>
	<?php require_once ("header.php")?>

	<div class="page-name-div">
		<div class="page-name">
		<a href="../admin-portal/receipt.php?order_id=<?php echo $order_id?>"><button type="submit" class="btn"><i class="fa fa-print"></i> PRINT RECEIPT</button></a>
			<h1><i class="fa fa-file-invoice"></i> Order Details</h1>	
		</div>	
	</div>


	<div class="order-details-div">
        <div class="span"> CUSTOMER NAME: <?php echo $customer_name?></div>       
        <div class="span"> EMAIL ADDRESS: <?php echo $customer_email?></div> 
		<div class="span"> PHONE NUMBER: <?php echo $customer_phone?></div> 
	</div>
    <div class="order-details-div">
		<div class="span">  INVOICE NUMBER: <?php echo $order_id?></div> 
		<div class="span">  ATTENDANT: <?php echo $staff_full_name?></div> 
		<div class="span"> DATE:  <?php echo $date_entered?></div>  
		
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




	









</div>

</body>
</html>