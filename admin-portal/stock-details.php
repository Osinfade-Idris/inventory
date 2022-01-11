<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php $stock_id=$_GET['ls_id'];?>

<?php
        /////// To fetch stock details into stock details page
        $stockprofilequery = mysqli_query ($conn,"SELECT * FROM `load_stock_tab` WHERE ls_id = '$stock_id'") or die ('cannot select stock');
        $stockprofiledata=mysqli_fetch_array($stockprofilequery);
       

        $qty=$stockprofiledata['qty'];
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
<title>Stock Details - IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>

<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
	<div class="page-name">
	        <h1><i class="fa fa-clipboard"></i> Stock Details</h1>
	</div>
        </div>

        <div class="profile-div">
            <div class="title-div">
                <i class="fa fa-user-circle"></i>
                <span>STOCK DETAILS</span>  
        </div>
        </div>
        
        <form action="../connection/code.php?action=update_stock&ls_id=<?php echo $stock_id?>"  enctype="multipart/form-data" method="post">
        <div class="profile-details">
                <div class="span"> VOUCHER NAME:</div>
                <select name="voucher_id" id="voucher_id" class="combo-field" required>
                <option value="<?php echo $voucher_pro_id?>" selected><?php echo $voucher_pro_name?></option>
                <?php
                $voucherquery = mysqli_query ($conn,"SELECT * FROM `voucher_tab`");
                while($voucherdata=mysqli_fetch_array($voucherquery)){
                $voucher_id=$voucherdata['voucher_id'];
                $voucher_name=$voucherdata['voucher_name'];       
                ?>
                <option value="<?php echo $voucher_id?>"><?php echo $voucher_name?></option>
                <?php }?>
                </select>

                <div class="span">  VOUCHER DENOMINATION:</div>
                <select name="denomination_id" id="denomination_id" class="combo-field" required>
                <option value="<?php echo $denomination_pro_id?>" selected><?php echo $denomination_pro_name?></option>
                <?php
                $denominationquery = mysqli_query ($conn,"SELECT * FROM `denomination_tab`");
                while($denominationdata=mysqli_fetch_array($denominationquery)){
                $denomination_id=$denominationdata['denomination_id'];
                $denomination_name=$denominationdata['denomination_name'];       
                ?>
                <option value="<?php echo $denomination_id?>"><?php echo $denomination_name?></option>
                <?php }?>
                </select>

                <div class="span">Qty:</div>
                <input id="stock_quantity" name="stock_quantity" type="number" class="qty-field" placeholder="Qty" title="Quantity" value="<?php echo $qty?>"  required/>

                <button type="submit" class="btn"><i class="fa fa-clipboard"></i> UPDATE</button>          
            </form>
        </div>  


       
        
</div>

</body>
</html>