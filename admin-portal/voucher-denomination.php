<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Voucher Denomination- IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>


<div class="body-div">
	<?php require_once ("alert.php")?>
    <?php require_once ("header.php")?>
        
    <div class="page-name-div">
        <div class="page-name">
        <a href="add-denomination.php"><button type="submit"><i class="fa fa-plus"></i> Add Denomination</button></a>
            <h1><i class="fa fa-poll"> </i> Voucher Denomination</h1>  
        </div>
    </div>
        <br break="all">
        <div class="table-div">
<table  class="list-table">
    <tr class="title">
        <td width="10%">SN</td>
        <td width="10%">VOUCHER</td>
        <td width="14%">DENOMINATION</td>
        <td width="14%"><s>N</s> UNIT PRICE</td>
        <td width="25">STAFF</td>
        <td width="19">DATE</td>
        <td width="8%">ACTION</td>
    </tr>
    <?php
    $stockquery = mysqli_query ($conn,"SELECT * FROM `voucher_denomination_tab`") or die ('cannot select voucher denomination tab');
    $count=0;
	while($stockdata=mysqli_fetch_array($stockquery)){
        $count++;
        $vd_id=$stockdata['vd_id'];
        $voucher_id=$stockdata['voucher_id'];
        $denomination_id=$stockdata['denomination_id'];
        $unit_price=$stockdata['unit_price'];
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
      <td><?php echo $unit_price;?></td>
      <td><?php echo $staff_full_name;?></td>
      <td><?php echo $date_entered;?></td>
      <td> 
      <a href="denomination-details.php?vd_id=<?php echo $vd_id?>">
      <button  class="action-btn" title="Edit"><i class="fa fa-edit"> </i></button>
      </a>
      </td>
    </tr>
        <?php }?>
    <tr class="title">
        <td width="10%">SN</td>
        <td width="10%">VOUCHER</td>
        <td width="14%">DENOMINATION</td>
        <td width="14%"><s>N</s> UNIT PRICE</td>
        <td width="25">STAFF</td>
        <td width="19">DATE</td>
        <td width="8%">ACTION</td>
    </tr>

</table>
    </div>
</div>

</body>
</html>
