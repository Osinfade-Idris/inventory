<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<?php $order_id=$_GET['order_id'];?>

<?php
/////// To fetch order details into receipt page
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
<title>Voucher Receipt - IVSM</title>
</head>

<body>


        <div class="receipt-div">
            <div class="header-div">
                <div class="logo-div"><img src="images/icon.png" alt="Inventory"/></div>
                <div class="text">SALES BAY</div>
            </div>
            <br clear="all">
            
            <div class="order">
                CUSTOMER NAME</br>
                <?php echo $customer_name?>
            </div>
            <div class="order">
                ITEMS PURCHASED<br>
                <?php
                    $cartquery = mysqli_query ($conn,"SELECT * FROM `voucher_cart_tab` WHERE order_id='$order_id' AND order_status_id='S'") or die ('cannot select cart');
                    while($cartdata=mysqli_fetch_array($cartquery)){
                    $vd_id=$cartdata['vd_id'];
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


                    $cart_qty=$cartdata['order_qty'];
                    $unit_price=$cartdata['unit_price'];
                    $sub_amount=$cartdata['sub_amount'];      
                ?>
                
                <?php echo $vouchername?> - <?php echo $denominationname?>: <?php echo $cart_qty?>:  <s>N</s><?php echo number_format($sub_amount);?><br>
                <?php }?>
            </div>

            <div class="order">
                TOTAL AMOUNT<br>
                NGN <?php echo number_format($total_amount_goods);?>
            </div>
            <div class="order">
                TRANSACTION APPROVED
            </div>
            <div class="order">
                DATE</br>
                <?php echo $date_entered?>

            </div>
            
            


           
          
        </div>




       
        
</div>

</body>
</html>