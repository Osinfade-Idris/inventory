<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Add New Staff</title>
</head>
<body>
<?php require_once ("navigation.php")?>


<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        <div class="page-name-div">
	        <div class="page-name">
			<h1><i class="fa fa-school"></i> Add New Staff</h1>
		</div>
        </div>


        <form action="../connection/code.php?action=staff_reg"  enctype="multipart/form-data" method="post">
        <div class="profile-details">
                                                
                <div class="span"> FIRST NAME:</div>
                <input id="first_name" name="first_name" type="text" class="text-field" placeholder="Enter First Name" title="FIRST NAME" value="" required/>

                <div class="span"> LAST NAME:</div>
                <input id="last_name" name="last_name" type="text" class="text-field" placeholder="Enter Last Name" title="LAST NAME" value="" required/>

                <div class="span">  HOME ADDRESS:</div>
                <input id="address" name="address" type="text" class="text-field" placeholder="Enter Home Address" title="HOME ADDRESS" value="" required/>
                
                <div class="span">  EMAIL ADDRESS:</div>
                <input id="email" name="email_address" type="email" class="text-field" placeholder="Enter Email Address" title="EMAIL ADDRESS" value="" required/>

                <div class="span"> PHONE NUMBER:</div>
                <input id="phone_number" name="phone_number" type="text" class="text-field" placeholder="Enter Phone Number" title="PHONE NUMBER" value="" required/>
                
        </div>


        <div class="profile-details">
                

                <div class="span"> SELECT PASSPORT:</div>
                <input type="file" name="passport"  class="text-field" required/>           
                
                <div class="span"> ROLE:</div>
                <select name="role_id" id="role" class="combo-field" required>
                <option value="" selected>SELECT A ROLE</option>
                <?php
                $rolequery = mysqli_query ($conn,"SELECT * FROM `role_tab`");
                while($roledata=mysqli_fetch_array($rolequery)){
                $role_id=$roledata['role_id'];
                $role_name=$roledata['role_name'];       
                ?>
                <option value="<?php echo $role_id?>"><?php echo $role_name?></option>
                <?php }?>
                </select>

                <div class="span"> STATUS:</div>
                <select name="status_id" id="status" class="combo-field" required>
                <option value="" selected>SELECT A STATUS</option>
                <?php
                $statusquery = mysqli_query ($conn,"SELECT * FROM `status_tab`");
                while($statusdata=mysqli_fetch_array($statusquery)){
                $status_id=$statusdata['status_id'];
                $status_name=$statusdata['status_name'];       
                ?>
                <option value="<?php echo $status_id?>"><?php echo $status_name?></option>
                <?php }?>
                </select>

                <div class="span"> PASSWORD:</div>
                <input id="password" name="password" type="password" class="text-field" placeholder="Enter Password" title="PASSWORD" value="" required/>

                <div class="span"> CONFIRM PASSWORD:</div>
                <input id="password" name="confirm_password" type="password" class="text-field" placeholder="Confirm Your Password" title="PASSWORD" value="" required/>

                <button type="submit" class="btn"> SUBMIT <i class="fa fa-check"></i></button>
                                                                                    
                                       
                </form> 
        </div>




        




                
</div>





</body>
</html>



