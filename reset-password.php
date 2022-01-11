<?php require_once ("connection/admin.php")?>
<?php require_once ("connection/session.php")?>
<?php $reset_email=$_GET['reset_email'];?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>

<title>Reset Password - IVSM</title>
</head>
<body>
         
<div class="home-div">
    <div class="inner-div">
        <div class="left-div">
                <h1>Inventory And Sales Management System</h1>
                <hr>
                <a href="index.php"><div class="logo-div"><img src="images/logo.png" alt="SIVM LOGO"/></div></a>      
        </div>
              
        <div class="right-div">
                <a href="index.php"><div class="logo-div"><img src="images/logo2.png" alt="SIVM LOGO II"/></div><br clear="all" /></a>

                <div class="login signin">
                        <h2><i class="fa fa-lock"></i> Reset Password<br clear="all" /><hr><br clear="all" /></h2>

                        <div class="btn-div"> An OTP has been sent to <span> <?php echo $reset_email?> </span></div>

                        <form action="connection/code.php?action=otp_reset&reset_email=<?php echo $reset_email?>"  enctype="multipart/form-data" method="post">
                        <input type="text" id="" name="otp" placeholder="Enter OTP" required>
  
                        <input type="password" id="password" name="password" placeholder="Enter New Password" required>  
                
                        <input type="password" id="password" name="confirm_password" placeholder="Confirm New Password" required>
                   
                        <button type="submit"><i class="fa fa-check"></i> Reset</button>
                        </form>
                </div>
                         
                                     
                <div class="footer-div">
                        Inventory And Sales Management System<br>
                        <span>Developed By: Manuvi Technologies</span>
                </div>
        </div>
    </div>
</div>
</body>
</html>