<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>

<?php $order_id=$_GET['order_id'];?>


<?php
/////// To fetch order details into voucher order details page
        $orderprofilequery = mysqli_query ($conn,"SELECT * FROM `order_voucher_tab` WHERE order_id = '$order_id'") or die ('cannot select order');
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
<title>Voucher Order Details - IVSM </title>
</head>

<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
	<?php require_once ("alert.php")?>
	<?php require_once ("header.php")?>

	<div class="page-name-div">
		<div class="page-name">
		<a href="../admin-portal/voucher-receipt.php?order_id=<?php echo $order_id?>"><button type="submit" class="btn"><i class="fa fa-print"></i> PRINT RECEIPT</button></a>
			<h1><i class="fa fa-file-invoice"></i> Voucher Order Details</h1>	
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
		<br clear="all">
	</div>

	<div class="table-div">
    <table  class="list-table">
    <tr class="title">
        <td width="12%">SN</td>
        <td width="12%">VOUCHER</td>
        <td width="16%">DENOMINATION</td>
        <td width="14%"><s>N</s> UNIT PRICE</td>
		<td width="13%">QUANTITY</td>
		<td width="18%"><s>N</s> SUB AMOUNT</td>
    </tr>
    <?php
    $stockquery = mysqli_query ($conn,"SELECT * FROM `voucher_cart_tab` WHERE order_id='$order_id'") or die ('cannot select voucher cart tab');
    $count=0;
	while($stockdata=mysqli_fetch_array($stockquery)){
		$count++;
		
		$vc_id=$stockdata['vc_id'];
        $vd_id=$stockdata['vd_id'];
		$unit_price=$stockdata['unit_price'];
		$sub_amount=$stockdata['sub_amount'];
		$order_qty=$stockdata['order_qty'];
        $date_entered=$stockdata['date_entered']; 

		///// for voucher name
		$voucherquery = mysqli_query($conn,"SELECT voucher_id FROM `voucher_denomination_tab` WHERE `vd_id` = '$vd_id'") or die ('cannot select voucher id');
		$voucherdata=mysqli_fetch_array($voucherquery);
		$voucher_id=$voucherdata['voucher_id'];

        $voucherquery = mysqli_query($conn,"SELECT * FROM `voucher_tab` WHERE `voucher_id` = '$voucher_id'") or die ('cannot select voucher');
		$voucherdata=mysqli_fetch_array($voucherquery);
		$vouchername=$voucherdata['voucher_name'];
        
		 ///// for denomination name
		 $denominationquery = mysqli_query($conn,"SELECT denomination_id FROM `voucher_denomination_tab` WHERE `vd_id` = '$vd_id'") or die ('cannot select denomination id');
         $denominationdata=mysqli_fetch_array($denominationquery);
         $denomination_id=$denominationdata['denomination_id'];

         $denominationquery = mysqli_query($conn,"SELECT * FROM `denomination_tab` WHERE `denomination_id` = '$denomination_id'") or die ('cannot select denomination');
         $denominationdata=mysqli_fetch_array($denominationquery);
         $denominationname=$denominationdata['denomination_name'];
?>
    <tr>
    <td><?php echo $count;?></td>
	<td><?php echo $vouchername;?></td>
	<td><?php echo $denominationname;?></td>
	<td><?php echo $unit_price;?></td>
	<td><?php echo $order_qty;?></td>
	<td><?php echo $sub_amount;?></td>    
    </tr>
        <?php }?>
    <tr class="title">
        <td width="12%">SN</td>
        <td width="12%">VOUCHER</td>
        <td width="16%">DENOMINATION</td>
        <td width="14%"><s>N</s> UNIT PRICE</td>
		<td width="13%">QUANTITY</td>
		<td width="18%"><s>N</s> SUB AMOUNT</td>   
    </tr>

</table>
	</div>
	

	<?php
	$query = mysqli_query ($conn,"SELECT sum(sub_amount) FROM `voucher_cart_tab` WHERE order_id = '$order_id'");
	$fetch=mysqli_fetch_array($query);
	$total_amount=$fetch[0];
	if ($total_amount==''){$total_amount=0;}
	?>
	<div class="total-div">TOTAL AMOUNT OF GOODS: <span><s>N</s><?php echo number_format($total_amount) ?></span></div>




	









</div>

</body>
</html>