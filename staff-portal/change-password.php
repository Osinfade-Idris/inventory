<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once ("../connection/query.php")?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Change Password - Skulinks</title>
</head>

<body>
<?php require_once ("navigation.php")?>


<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
			<div class="page-name">
					<h1><i class="fa fa-lock"></i> Change Password</h1>
			</div>
        </div>

        <div class="profile-details">
            <form action="../connection/staff-code.php?action=change_password"  enctype="multipart/form-data" method="post">
                                <div class="span"> OLD PASSWORD:</div>
                                <input id="old_password" name="old_password" type="password" class="text-field" placeholder=" ENTER OLD PASSWORD" title="ENTER OLD PASSWORD" value="" required>

                                <div class="span"> CREATE NEW PASSWORD:</div>
                                <input id="create_new_password" name="new_password" type="password" class="text-field" placeholder="CREATE NEW PASSWORD" title="CREATE NEW PASSWORD" value="" required>


                                <div class="span"> CONFIRM NEW PASSWORD:</div>
                                <input id="confirm_new_password" name="confirm_new_password" type="password" class="text-field" placeholder="CONFIRM NEW PASSWORD" title="CONFIRM NEW PASSWORD" value="" required>
                                                    
                                <button type="submit"  class="btn"> <i class="fa fa-exchange-alt"></i> CHANGE PASSWORD </button>
            </form>
        </div>








              
</div>

</body>
</html>