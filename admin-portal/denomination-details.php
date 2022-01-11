<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php $vd_id=$_GET['vd_id'];?>

<?php
        /////// To fetch stock details into stock details page
        $stockprofilequery = mysqli_query ($conn,"SELECT * FROM `voucher_denomination_tab` WHERE vd_id = '$vd_id'") or die ('cannot select voucher denomination');
        $stockprofiledata=mysqli_fetch_array($stockprofilequery);
       

        $unit_price=$stockprofiledata['unit_price'];
        $voucher_pro_id=$stockprofiledata['voucher_id'];	    
        ///// for voucher name
        $voucherprofilequery = mysqli_query($conn,"SELECT * FROM `voucher_tab` WHERE `voucher_id` = '$voucher_pro_id'") or die ('cannot select voucher');
		$voucherprofiledata=mysqli_fetch_array($voucherprofilequery);
		$voucher_pro_name=$voucherprofiledata['voucher_name'];
        
        $denomination_pro_id=$stockprofiledata['denomination_id'];
         ///// for denomination name
         $denominationprofilequery = mysqli_query($conn,"SELECT * FROM `denomination_tab` WHERE denomination_id = '$denomination_pro_id'") or die ('cannot select denomination');
         $denominationprofiledata=mysqli_fetch_array($denominationprofilequery);
         $denomination_pro_name=$denominationprofiledata['denomination_name'];
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Denomination Details - IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>

<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
	<div class="page-name">
	        <h1><i class="fa fa-poll"></i> Denomination Details</h1>
	</div>
        </div>

 
        
        <form action="../connection/code.php?action=update_denomination&vd_id=<?php echo $vd_id?>"  enctype="multipart/form-data" method="post">
        <div class="profile-details">
                <div class="span"> VOUCHER NAME:</div>
                <select name="voucher_id" id="voucher_id" class="combo-field" required>
                <option value="<?php echo $voucher_pro_id?>" selected><?php echo $voucher_pro_name?></option>
                </select>

                <div class="span">  VOUCHER DENOMINATION:</div>
                <select name="denomination_id" id="denomination_id" class="combo-field" required>
                <option value="<?php echo $denomination_pro_id?>" selected><?php echo $denomination_pro_name?></option>
                </select>

                <div class="span">Unit Price:</div>
                <input id="stock_price" name="stock_price" type="text" class="text-field" placeholder="Price" title="Unit Price" value="<?php echo $unit_price?>"  required/>

                <button type="submit" class="btn"><i class="fa fa-clipboard"></i> CHANGE PRICE</button>          
            </form>
        </div>   
        
</div>

</body>
</html>