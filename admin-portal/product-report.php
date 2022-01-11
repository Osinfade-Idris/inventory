<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Product Report- IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>
<div class="body-div">
	<?php require_once ("alert.php")?>
    <?php require_once ("header.php")?>
        
    <div class="page-name-div">
        <div class="page-name">
            <h1><i class="fa fa-history"> </i> Product Report</h1>  
        </div>
    </div>
        
 <br clear="all">


 <div class="table-div">
<table  class="list-table">
    <tr class="title">
        <td width="7%">SN</td>
        <td width="19%"> PRODUCT NAME</td>
        <td width="10%"> TOTAL STOCK</td>
        <td width="10%"> TOTAL SOLD</td>
        <td width="10%"> STOCK REMAINING</td>
    </tr>
    <?php
    $productquery = mysqli_query ($conn,"SELECT * FROM `product_tab`") or die ('cannot select product tab');
    $count=0;
	while($productdata=mysqli_fetch_array($productquery)){
        $count++;
    $product_id=$productdata['product_id'];
    $product_name=$productdata['product_name'];  
   
    $totalstockquery = mysqli_query ($conn,"SELECT sum(quantity) FROM `load_product_tab` WHERE product_id='$product_id'") or die ('cannot select qty');
    $totalstockdata=mysqli_fetch_array($totalstockquery);
    $totalstock=$totalstockdata['sum(quantity)']; 
    if($totalstock==''){$totalstock=0;}

    $totalsoldquery = mysqli_query ($conn,"SELECT sum(cart_qty) FROM `cart_tab` WHERE product_id='$product_id' AND order_status_id='S'") or die ('cannot select qty');
    $totalsolddata=mysqli_fetch_array($totalsoldquery);
    $totalsold=$totalsolddata['sum(cart_qty)']; 
    if($totalsold==''){$totalsold=0;}


    $stockremaining=$totalstock - $totalsold;
    if($stockremaining==''){$stockremaining=0;}
    ?>

    <tr>
      <td><?php echo $count;?></td>
      <td><?php echo $product_name;?></td>
  
      <td> 
      <a href="product-load-report-history.php?product_id=<?php echo $product_id?>">
      <button  class="action-btn total" title="Total Stock"><?php echo $totalstock?></button>
      </a>
      </td>
      <td> 
      <a href="product-sold-report-history.php?product_id=<?php echo $product_id?>">
      <button  class="action-btn sold" title="Total Sold"><?php echo $totalsold?></button>
      </a>
      </td>
      <td> 
      <a href="product-profile.php?product_id=<?php echo $product_id?>">
      <button  class="action-btn remaining" title="Stock Remaining"><?php echo $stockremaining?></button>
      </a>
      </td>

    </tr>
        <?php }?>
    <tr class="title">
        <td width="7%">SN</td>
        <td width="19%"> PRODUCT NAME</td>
        <td width="10%"> TOTAL STOCK</td>
        <td width="10%"> TOTAL SOLD</td>
        <td width="10%"> STOCK REMAINING</td>
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