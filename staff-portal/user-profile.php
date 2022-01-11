<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>


<?php
/////// To fetch user details into profile page
        $userprofilequery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE user_id = '$loguser_id'") or die ('cannot select staff');
        $userprofiledata=mysqli_fetch_array($userprofilequery);
        $pro_first_name=$userprofiledata['first_name'];
	$pro_last_name=$userprofiledata['last_name'];
        $pro_phone=$userprofiledata['phone_number'];
        $pro_address=$userprofiledata['address'];
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>My Profile - IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>

<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
	<div class="page-name">
	        <h1><i class="fa fa-eye"></i> My Profile</h1>
	</div>
        </div>

        <div class="profile-div">
            <div class="title-div">
                <i class="fa fa-user-circle"></i>
                <span>PERSONAL DETAILS</span>     
                    
                <a href="change-password.php"><button type="submit" class="btn"><i class="fa fa-lock"></i> CHANGE PASSWORD</button></a>
            </div>
        </div>
        
        <div class="profile-details">
        <form action="../connection/staff-code.php?action=update_users_profile&loguser_id=<?php echo $loguser_id?>"  enctype="multipart/form-data" method="post">
                <div class="profile-pix">                                        
                <img src="../admin-portal/upload/user-passport/<?php echo $pro_passport?>" alt="<?php echo $pro_fullname?> logo"/>                     
                </div>
                <div class="span"> CHANGE YOUR PROFILE PICTURE:</div>
		<input type="file" name="passport" size="" class="picture-field">
        

      
                <div class="span"> FIRST NAME:</div>
                <input id="first_name"  name="first_name" type="text" class="text-field" placeholder="first_name" title="FIRST NAME" value="<?php echo $pro_first_name?>" required>
                
                <div class="span"> LAST NAME:</div>
                <input id="last_name"  name="last_name" type="text" class="text-field" placeholder="last_name" title="LAST NAME" value="<?php echo $pro_last_name?>" required>
        </div>


        <div class="profile-details">
                 <div class="span">  ADDRESS:</div>
                <input id="address" name="address" type="text" class="text-field" placeholder="address" title="ADDRESS" value="<?php echo $pro_address?>" required>

                <div class="span"> PHONE NUMBER:</div>
                <input id="phone_number" name="phone_number" type="text" class="text-field" placeholder="phone_number" title="PHONE NUMBER" value="<?php echo $pro_phone?>" required>

                <div class="span"> EMAIL:</div>
                <input id="email" name="email_address" type="text" class="text-field" placeholder="email" title="EMAIL" value="<?php echo $pro_email?>" required>

                
                
                <button type="submit" class="btn"> UPDATE PROFILE <i class="fa fa-check"></i></button>
        </form>
        </div>


        
</div>

</body>
</html>