<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>




<?php
	$orderquery = mysqli_query ($conn,"SELECT * FROM `order_voucher_tab` WHERE order_id = '$order_id'") or die ('cannot select order');
	$orderdata=mysqli_fetch_array($orderquery);	
        $order_staff_id=$orderdata['staff_id'];	
            ////for staff name
        $orderstaffquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE `user_id` = '$order_staff_id'") or die ('cannot select staff');
        $orderstaffdata=mysqli_fetch_array($orderstaffquery);

        $staff_first_name=$orderstaffdata['first_name'];
        $staff_last_name=$orderstaffdata['last_name'];


        $order_total_amount=$orderdata['total_amount'];
        
        $_SESSION['order_id']='';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Order Success - IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>



<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
			<div class="page-name">
					<h1><i class="fa fa-check"></i> Order Successful</h1>
			</div>
        </div>

        <div class="registration-success-div">
                <div class="success-div">


                <div class="btn-div"><span> <?php echo $staff_first_name?> <?php echo $staff_last_name?> </span> Has Processed An Order Of <span> <s>N</s> <?php echo number_format($order_total_amount) ?>  </span>and Ready For Delivery</div>
                <form action="../staff-portal/index.php" enctype="multipart/form-data" method="post">
                <button type="submit"><i class="fa fa-check"></i> OK</button>
                </form>
                </div>



        </div>




              
</div>

</body>
</html>