<?php require_once("../connection/admin.php")?>
<?php require_once("../connection/session.php")?>
<?php require_once("../connection/query.php")?>
<?php require_once("../connection/staff-validation.php")?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>
<title>Add New Category</title>
</head>
<body>
<?php require_once ("navigation.php")?>

<div class="body-div">
        <?php require_once ("alert.php")?>
        <?php require_once ("header.php")?>
        <div class="page-name-div">
	        <div class="page-name">
			<h1><i class="fa fa-school"></i> Add New Category</h1>
		</div>
        </div>

        <div class="profile-details">
                <form action="../connection/code.php?action=category_reg"  enctype="multipart/form-data" method="post">
                        <div class="span"> CATEGORY NAME:</div>
                        <input id="category_name" name="category_name" type="text" class="text-field" placeholder="Enter Category Name" title="CATEGORY NAME" value="" required/>
                        <button type="submit" class="btn"> SUBMIT <i class="fa fa-check"></i></button>                
                </form> 
        </div>        
</div>
</body>
</html>



