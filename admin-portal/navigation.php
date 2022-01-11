<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php
/////// To fetch staff counts
$userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE status_id='A'") or die ('cannot select user');
$active=mysqli_num_rows($userquery);
if ($active==''){$active=0;}

$userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE status_id='S'") or die ('cannot select user');
$suspend=mysqli_num_rows($userquery);
if ($suspend==''){$suspend=0;}

$userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE status_id='P'") or die ('cannot select user');
$pending=mysqli_num_rows($userquery);
if ($pending==''){$pending=0;}
?>

<div class="side-nav-div" id="side-nav">
	<div class="div-in">
			<div class="pix-div"><img src="upload/user-passport/<?php echo $passport?>" alt="<?php echo $full_name?> PASSPORT"/></div>
			<div class="name-div">
				<div class="name"><?php echo $fullname?> </div>
				
				Last Login Date:
				<div class="login"> <?php echo $last_login_date?></div>
				
				<?php echo $phone_number?>
			</div>
			
			<a href="user-profile.php?user_id=<?php echo $loguser_id?>"><button type="submit" class="btn"><i class="fa fa-eye"></i> View profile</button></a>
	</div>

	<div class="div-in">
		<a href="index.php"><div class="link"><i class="fa fa-tachometer-alt"></i> Dashboard </div></a>

		<div class="link" onclick="_expand_link('staff')" ><i class="fa fa-users"></i> Staffs
			<div  class="toggle" id="staff">
			<a href="active-staffs.php"><div class="sub-link"><i class="fa fa-user-check"></i> Active Staffs (<?php echo $active?>)</div></a>
			<a href="suspended-staffs.php"><div class="sub-link"><i class="fa fa-user-slash"></i> Suspended Staffs (<?php echo $suspend?>)</div></a>
			<a href="pending-staffs.php"><div class="sub-link"><i class="fa fa-users-cog"></i> Pending Staffs (<?php echo $pending?>)</div></a>
			<br clear="all" />
            </div>
        </div>
		<div class="link" onclick="_expand_link('ecom')" ><i class="fa fa-store-alt"></i> E-Commerce
			<div  class="toggle" id="ecom">
				<a href="category.php"><div class="sub-link"><i class="fa fa-landmark"></i> Categories</div></a>
				<a href="product-category.php"><div class="sub-link"><i class="fa fa-solar-panel"></i> Products </div></a>
				<a href="product-report.php"><div class="sub-link"><i class="fa fa-solar-panel"></i> Product Report</div></a>
				<a href="order-history.php"><div class="sub-link"><i class="fa fa-history"></i> Order History </div></a>
            <br clear="all" />
            </div>
        </div>

		<div class="link" onclick="_expand_link('vms')"><i class="fa fa-chart-bar"></i> Voucher Management
			<div  class="toggle" id="vms">
				<a href="add-stock.php"><div class="sub-link"><i class="fa fa-clipboard"></i> Load Stock</div></a>
				<a href="voucher-denomination.php"><div class="sub-link"><i class="fa fa-poll"></i> Denomination </div></a>
				<a href="voucher-order-history.php"><div class="sub-link"><i class="fa fa-history"></i> Voucher Report</div></a>
            <br clear="all" />
            </div>
		</div>
        
		<a href="../staff-portal"><div class="link"><i class="fa fa-reply-all"></i> Staff Portal </div></a>
		<a href="../connection/code.php?action=logout"><div class="link"><i class="fa fa-sign-out-alt"></i> Log-Out </div></a>
	</div>


</div>