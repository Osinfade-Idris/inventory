<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Stock- IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>


<div class="body-div">
	<?php require_once ("alert.php")?>
    <?php require_once ("header.php")?>
        
    <div class="page-name-div">
        <div class="page-name">
        <a href="add-stock.php"><button type="submit"><i class="fa fa-plus"></i> Add New Stock</button></a>
            <h1><i class="fa fa-history"> </i> Stock History</h1>  
        </div>
    </div>
        
    <div class="date-history-div">    
        <div class="date-div">
        FROM:
        <input id="" name="" type="date" class="text-field" placeholder="" title="PICK A DATE" value="" required>
        TO:
        <input id="" name="" type="date" class="text-field" placeholder="" title="PICK A DATE" value="" required>
        <button  title="Search"><i class="fa fa-search"> </i> Search</button>
        </div>
      
    </div>

    <div class="table-div">
<table  class="list-table">
    <tr class="title">
        <td width="6%">SN</td>
        <td width="10%">VOUCHER</td>
        <td width="14%">DENOMINATION</td>
        <td width="14%">TOTAL STOCK</td>
        <td width="14%">TOTAL SOLD</td>
        <td width="14%">QUANTITY REMAINING</td>
    </tr>
    <?php
    $voucher_id=$_GET['voucher_id'];
    $stockquery = mysqli_query ($conn,"SELECT DISTINCT voucher_id, denomination_id  FROM `load_stock_tab`   WHERE voucher_id='$voucher_id' ORDER BY `load_stock_tab`.`denomination_id` ASC") or die ('cannot select stock');
    $count=0;
	while($stockdata=mysqli_fetch_array($stockquery)){
        $count++;

        $stock_id=$stockdata['ls_id'];
        $voucher_id=$stockdata['voucher_id'];
        $denomination_id=$stockdata['denomination_id'];

        $qtyquery = mysqli_query ($conn,"SELECT sum(qty) FROM `load_stock_tab` WHERE voucher_id='$voucher_id' AND denomination_id='$denomination_id'") or die ('cannot select qty');
        $qtydata=mysqli_fetch_array($qtyquery);
        $totalqtystock=$qtydata['sum(qty)'];
        if($totalqtystock==''){$totalqtystock=0;}


        $vd_id_query = mysqli_query ($conn,"SELECT vd_id FROM `voucher_denomination_tab` WHERE voucher_id='$voucher_id' AND denomination_id='$denomination_id'") or die ('cannot select denomination');
        $vd_id_data=mysqli_fetch_array($vd_id_query);
        $vd_id=$vd_id_data['vd_id'];

        $voucherqtyquery = mysqli_query ($conn,"SELECT sum(order_qty) FROM `voucher_cart_tab` WHERE vd_id='$vd_id' AND order_status_id='S'") or die ('cannot select order qty');
        $voucherqtydata=mysqli_fetch_array($voucherqtyquery);
        $totalsold=$voucherqtydata['sum(order_qty)'];
        if($totalsold==''){$totalsold=0;}
        

        $stock_remaining= $totalqtystock - $totalsold;
        if($stock_remaining==''){$stock_remaining=0;}

        $staff_id=$stockdata['staff_id'];
        $date_entered=$stockdata['date_entered'];
        
		///// for staff name
        $staffquery = mysqli_query($conn,"SELECT * FROM `staff_tab` WHERE `user_id` = '$staff_id'") or die ('cannot select staff');
		$staffdata=mysqli_fetch_array($staffquery);
		$staff_first_name=$staffdata['first_name'];
		$staff_last_name=$staffdata['last_name'];
        $staff_full_name="$staff_first_name $staff_last_name";
        
        ///// for voucher name
        $voucherquery = mysqli_query($conn,"SELECT * FROM `voucher_tab` WHERE `voucher_id` = '$voucher_id'") or die ('cannot select voucher');
		$voucherdata=mysqli_fetch_array($voucherquery);
		$vouchername=$voucherdata['voucher_name'];
        
         ///// for denomination name
         $denominationquery = mysqli_query($conn,"SELECT * FROM `denomination_tab` WHERE `denomination_id` = '$denomination_id'") or die ('cannot select denomination');
         $denominationdata=mysqli_fetch_array($denominationquery);
         $denominationname=$denominationdata['denomination_name'];
		
    
?>

    <tr>
      <td><?php echo $count;?></td>
      <td><?php echo $vouchername;?></td>
      <td><?php echo $denominationname;?></td>
      <td> 
      <a href="stock-load-report-history.php?voucher_id=<?php echo $voucher_id?>&denomination_id=<?php echo $denomination_id?>">
      <button  class="action-btn total" title="Total Stock"><?php echo $totalqtystock?></button>
      </a>
      </td>
      <td> 
      <a href="stock-sold-report-history.php?vd_id=<?php echo $vd_id?>">
      <button  class="action-btn sold" title="Total Sold"><?php echo $totalsold?></button>
      </a>
      </td>
      <td> 
      <a href="">
      <button  class="action-btn remaining" title="Stock Remaining"><?php echo $stock_remaining?></button>
      </a>
      </td>
    </tr>
        <?php }?>
    <tr class="title">
    <td width="6%">SN</td>
        <td width="10%">VOUCHER</td>
        <td width="14%">DENOMINATION</td>
        <td width="14%">TOTAL STOCK</td>
        <td width="14%">TOTAL SOLD</td>
        <td width="14%">QUANTITY REMAINING</td>
        
    </tr>

</table>
    </div>
</div>

</body>
</html>



