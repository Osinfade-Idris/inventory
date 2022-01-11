<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Add Stock</title>
</head>
<body>
<?php require_once ("navigation.php")?>


<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        <div class="page-name-div">
	        <div class="page-name">
			<h1><i class="fa fa-clipboard"></i> Add New Stock</h1>
		</div>
        </div>

        <form action="../connection/code.php?action=add_stock"  enctype="multipart/form-data" method="post">
                <div class="profile-details">
                        <div class="span"> VOUCHER NAME:</div>
                        <select name="voucher_id" id="voucher_id" class="combo-field" required>
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

                        <div class="span">  VOUCHER DENOMINATION:</div>
                        <select name="denomination_id" id="denomination_id" class="combo-field" required>
                                <option value="" selected>SELECT A DENOMINATION</option>
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
                        <input id="stock_quantity" name="stock_quantity" type="number" class="qty-field" placeholder="Qty" title="Quantity" value="<?php echo $product_qty?>"  required/>

                        <button type="submit" class="btn"> ADD STOCK <i class="fa fa-check"></i></button>          
                </div>  
        </form>              
</div>
</body>
</html>



