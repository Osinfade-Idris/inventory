<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once ("../connection/query.php")?>



<div class="side-nav-div" id="side-nav">
	<div class="div-in">
			<div class="pix-div"><img src="../admin-portal/upload/user-passport/<?php echo $passport?>" alt="<?php echo $first_name?> PASSPORT"/></div>
			<div class="name-div">
				<div class="name"><?php echo $fullname?></div>

				Last Login Date:
				<div class="login"> <?php echo $last_login_date?></div>
				<?php echo $phone_number?>
			</div>
			
			<a href="user-profile.php?user_id=<?php echo $loguser_id?>"><button type="submit" class="btn"><i class="fa fa-eye"></i> View profile</button></a>
	</div>

	<div class="div-in">
		<a href="index.php"><div class="link"><i class="fa fa-tachometer-alt"></i> Dashboard </div></a>

		<div class="link" onclick="_expand_link('ecom')" ><i class="fa fa-store-alt"></i> E-Commerce
			<div  class="toggle" id="ecom">
			<a href="product-category.php"><div class="sub-link"><i class="fa fa-solar-panel"></i> Products </div></a>
			<a href="order-history.php"><div class="sub-link"><i class="fa fa-history"></i> Order History </div></a>
            <br clear="all" />
            </div>
		</div>
		

		<div class="link" onclick="_expand_link('vms')"><i class="fa fa-chart-bar"></i> Voucher Management
			<div  class="toggle" id="vms">
			<a href="order-voucher.php"><div class="sub-link"><i class="fa fa-money-bill-alt"></i> Order Voucher</div></a>
			<a href="voucher-order-history.php"><div class="sub-link"><i class="fa fa-history"></i> Order History</div></a>
            <br clear="all" />
            </div>
		</div>
        
		<?php if($role_id=="A"){?>
		<a href="../admin-portal"><div class="link"><i class="fa fa-reply-all"></i> Admin Portal </div></a>
		<?php }?>
		
		<a href="../connection/code.php?action=logout"><div class="link"><i class="fa fa-sign-out-alt"></i> Log-Out </div></a>
	</div>


</div>