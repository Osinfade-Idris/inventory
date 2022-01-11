<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Pending Staffs - IVSM </title>
</head>

<body>

<?php require_once ("navigation.php")?>







<div class="body-div">
	<?php require_once ("alert.php")?>
	<?php require_once ("header.php")?>


		<div class="page-name-div">
			<div class="page-name">
				<a href="register-staff.php"><button type="submit"><i class="fa fa-plus"></i> Add New Staff</button></a>
				<h1><i class="fa fa-users-cog"></i> Pending Staffs</h1>
				
			</div>
			
		</div>

		<div class="user-details-div">



		<?php
	$userprofilequery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE status_id='P'") or die ('cannot select staff');
	$count=0;
		while($userprofiledata=mysqli_fetch_array($userprofilequery)){
	$count++;
	$user_id=$userprofiledata['user_id'];
	$pro_first_name=$userprofiledata['first_name'];
	$pro_last_name=$userprofiledata['last_name'];
	$pro_address=$userprofiledata['address'];
	$pro_phone=$userprofiledata['phone_number'];
	$pro_email=$userprofiledata['email_address'];
	$pro_passport=$userprofiledata['passport'];
    $pro_role_id=$userprofiledata['role_id'];
        ///// for role name
    $rolequery = mysqli_query ($conn,"SELECT * FROM `role_tab` WHERE role_id = '$pro_role_id'") or die ('cannot select role');
	$roledata=mysqli_fetch_array($rolequery);
	$pro_role_name=$roledata['role_name'];
     
	$pro_status_id=$userprofiledata['status_id'];

        ///// for status name
    $statusquery = mysqli_query ($conn,"SELECT * FROM `status_tab` WHERE status_id = '$pro_status_id'") or die ('cannot select status_tab');
    $statusdata=mysqli_fetch_array($statusquery);
    $pro_status_name=$statusdata['status_name'];  
        
?>




			<a href="user-profile.php?user_id=<?php echo $user_id?>">
				<div class="details-div">
					<div class="pix-div"><img src="upload/user-passport/<?php echo $pro_passport?>" alt="<?php echo $pro_fullname?> PASSPORT"/></div>
						<div class="detail">
							<h2><?php echo $pro_first_name?> <?php echo $pro_last_name?></h2>
							<i class="fa fa-phone"></i> <?php echo $pro_phone?>  | <i class="fa fa-envelope"></i> <?php echo $pro_email?> 
						</div>
						<br clear="all">
				</div>
			</a>
			<?php }?>
			

		</div>


		<?php
		  	if ($count==0){?>
            <div class="search-alert-div">
              <i class="fa fa-stop"></i> No Pending Staff
            </div>     
        <?php }?>
</div>

</body>
</html>