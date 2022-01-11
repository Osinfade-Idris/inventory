<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Order History- IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>


<div class="body-div">
	<?php require_once ("alert.php")?>
    <?php require_once ("header.php")?>
        
    <div class="page-name-div">
        <div class="page-name">
            <h1><i class="fa fa-history"> </i> Order History</h1>  
        </div>
    </div>
        
    <div class="date-history-div">
    <form method="post" enctype="multipart/form-data" action="order-history-search-result.php">   
        <div class="date-div">
        FROM:
        <input id="" name="date_from" type="date" class="text-field"  placeholder="" title="PICK A DATE" value="" required>
        TO:
        <input id="" name="date_to" type="date" class="text-field" placeholder="" title="PICK A DATE" value="" required>
        <button  title="Search"><i class="fa fa-search"> </i> Search</button>
        </div>
      </form>
    </div>

<div class="table-div">
    <table  class="list-table">
        <tr class="title">
            <td width="10%">SN</td>
            <td width="23%">STAFF</td>
            <td width="19%">ORDER ID</td>
            <td width="21%"><s>N</s> AMOUNT</td>
            <td width="14%">DATE</td>
            <td width="13%">ACTION</td>
        </tr>
        <?php
            $orderquery = mysqli_query ($conn,"SELECT * FROM `order_tab`") or die ('cannot select order');
            $count=0;
            while($orderdata=mysqli_fetch_array($orderquery)){
                $count++;
            $order_id=$orderdata['order_id'];
            $staff_id=$orderdata['staff_id'];
            $order_amount=$orderdata['total_amount'];
            $date_entered=$orderdata['date_entered'];

            ///// for staff name
            $staffquery = mysqli_query($conn,"SELECT * FROM `staff_tab` WHERE `user_id` = '$staff_id'") or die ('cannot select staff');
            $staffdata=mysqli_fetch_array($staffquery);
            $staff_first_name=$staffdata['first_name'];
            $staff_last_name=$staffdata['last_name'];
            $staff_full_name="$staff_first_name $staff_last_name";
            
        
        ?>
        <tr>
        <td><?php echo $count;?></td>
        <td><?php echo $staff_full_name;?></td>
        <td><?php echo $order_id;?></td>
        <td><?php echo number_format($order_amount);?></td>
        <td><?php echo $date_entered;?></td>
        <td> 
        <a href="order-details.php?order_id=<?php echo $order_id?>">
        <button  class="action-btn" title="View Order Details"><i class="fa fa-eye"> </i></button>
        </a>
        <a href="receipt.php?order_id=<?php echo $order_id?>">
        <button  class="action-btn print" title="Print Receipt"><i class="fa fa-print"> </i></button>
        </a>
        </td>
        </tr>
            <?php }?>
        <tr class="title">
            <td>SN</td>
            <td>STAFF</td>
            <td>ORDER ID</td>
            <td><s>N</s> AMOUNT</td>
            <td>DATE</td>
            <td>ACTION</td>
        </tr>

    </table>
</div>
            <?php
		  	if ($count==0){?>
            <div class="search-alert-div">
              <i class="fa fa-stop"></i> No Record Found
              </div>     
              <?php }?>
</div>

</body>
</html>