<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Order Voucher - IVSM</title>
</head>

<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
	<?php require_once ("alert.php")?>
    <?php require_once ("header.php")?>
        
    <div class="page-name-div">
        <div class="page-name">
            <h1><i class="fa fa-money-bill-alt"> </i> Order Voucher</h1>  
        </div>
    </div>
    <br break="all">

    <div class="order-voucher-div">
      <form action="../connection/staff-code.php?action=add_to_voucher_cart" enctype="multipart/form-data" method="post">

        <select name="voucher_id" id="voucher_id_order" class="combo-field" required>
                <option value="" selected>SELECT A VOUCHER</option>
                <?php
                $voucherquery = mysqli_query ($conn,"SELECT * FROM `voucher_tab`");
                while($voucherdata=mysqli_fetch_array($voucherquery)){
                $voucher_id=$voucherdata['voucher_id'];
                $voucher_name=$voucherdata['voucher_name'];       
                ?>
                <option value="<?php echo $voucher_id?>"><?php echo $voucher_name?></option>
                <?php }?>
        </select>
        
        <select name="denomination_id" id="denomination_id_order" class="combo-field" required>
                <option value="" selected>SELECT A DENOMINATION</option>
                <?php
                $query = mysqli_query ($conn,"SELECT * FROM `denomination_tab`");
                while($data=mysqli_fetch_array($query)){
                $denomination_id=$data['denomination_id'];
                $denomination_name=$data['denomination_name'];
                ?>
                <option value="<?php echo $denomination_id?>"><?php echo $denomination_name?></option>
                <?php }?>
        </select>

      <input id="voucher_quantity" name="voucher_quantity" type="number" class="qty-field" placeholder="Qty" title="Quantity" value="<?php echo $voucher_qty?>"  required/>
      
      <button  class="add-to-cart-btn" title="ADD TO CART"><i class="fa fa-cart-arrow-down"> </i> ADD TO CART</button>
      
      </form>
    </div>



    <div class="table-div">
	<table  class="list-table">
    <tr class="title">
        <td width="12%">SN</td>
        <td width="12%">VOUCHER</td>
        <td width="16%">DENOMINATION</td>
        <td width="14%"><s>N</s> UNIT PRICE</td>
		<td width="13">QUANTITY</td>
		<td width="14%"><s>N</s> SUB AMOUNT</td>
        <td width="20%">ACTION</td>
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
	
    <td> 
      <a href="order-voucher.php">
      <button  class="action-btn edit" title="Edit Voucher"><i class="fa fa-edit"> </i></button>
	  </a>
	 
	  

      <form action="../connection/staff-code.php?action=delete_voucher_cart&vd_id=<?php echo $vd_id?>&order_id=<?php echo $order_id?>"  enctype="multipart/form-data" method="post">
      <button  class="action-btn delete" title="Delete Voucher"><i class="fa fa-trash"></i></button>
      </form>
      </td>
      
    </tr>
        <?php }?>
    <tr class="title">
		<td width="12%">SN</td>
        <td width="12%">VOUCHER</td>
        <td width="16%">DENOMINATION</td>
        <td width="14%"><s>N</s> UNIT PRICE</td>
		<td width="13">QUANTITY</td>
		<td width="14%"><s>N</s> SUB AMOUNT</td>
        <td width="20%">ACTION</td>
    </tr>

</table>
    </div>


	

	<?php
	$query = mysqli_query ($conn,"SELECT sum(sub_amount) FROM `voucher_cart_tab` WHERE order_id = '$order_id'");
	$fetch=mysqli_fetch_array($query);
	$total_amount=$fetch[0];
	if ($total_amount==''){$total_amount=0;}
	?>
	<div class="total-div">TOTAL AMOUNT OF VOUCHER: <span><s>N</s> <?php echo number_format($total_amount) ?></span></div>

	<div class="col-3">
	<form action="../connection/staff-code.php?action=place_voucher_order&order_id=<?php echo $order_id?>"  enctype="multipart/form-data" method="post">
		
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


        <select name="payment_type_id" id="payment_type_id" class="combo-field" required>
		<option value="" selected>SELECT ORDER TYPE</option>
		<?php
		$paymentquery = mysqli_query ($conn,"SELECT * FROM `payment_type_tab`");
		while($paymentdata=mysqli_fetch_array($paymentquery)){
		$payment_type_id=$paymentdata['payment_type_id'];
		$payment_type_name=$paymentdata['payment_type_name'];       
		?>
		<option value="<?php echo $payment_type_id?>"><?php echo $payment_type_name?></option>
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
