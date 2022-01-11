<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<?php session_destroy(); session_unset();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Password Change Successful - IVSM</title>
</head>

<body>
<?php require_once ("navigation.php")?>
<div class="body-div">
<?php require_once ("alert.php")?>
<?php require_once ("header.php")?>
        
        <div class="page-name-div">
			<div class="page-name">
				<h1><i class="fa fa-lock"></i> Password Change Successful</h1>
			</div>
        </div>
        <form action="../connection/code.php?action=logout" enctype="multipart/form-data" method="post">
                <div class="registration-success-div">
                                <div class="success-div">        
                                <div class="btn-div"><span>Your Password Has Been Successfully Changed</span> You are advised to log-out</div>
                                <button type="submit" ><i class="fa fa-check"></i> OK</button>  
                        </div> 
                </div> 
        </form>             
</div>
</body>
</html>