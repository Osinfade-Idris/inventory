<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Staff Registration Success - IVSM</title>
</head>

<body>

<?php require_once ("navigation.php")?>



<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        
        <div class="page-name-div">
			<div class="page-name">
					<h1><i class="fa fa-check"></i> Staff Registration Successful</h1>
			</div>
        </div>

        <div class="registration-success-div">
                <div class="success-div">


                <div class="btn-div"><span> <?php echo $first_name?> <?php echo $last_name?> </span> Has Been Successfully Registered</div>
                <form action="../connection/code.php?action=logout" enctype="multipart/form-data" method="post">
                <button type="submit"><i class="fa fa-check"></i> OK</button>
                </form>
                </div>



        </div>




              
</div>

</body>
</html>