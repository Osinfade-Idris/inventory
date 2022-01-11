<?php require_once ("connection/admin.php")?>
<?php require_once ("connection/session.php")?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php require_once ("reference.php")?>

<title>Home - ISVM</title>
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
                        <h2><i class="fa fa-user-circle"></i> Administrative Log-In<br clear="all" /><hr><br clear="all" /></h2>
                        
                                
                        <form action="connection/code.php?action=login"  enctype="multipart/form-data" method="post">
                        <div class="title"><i class="fa fa-envelope"></i> Email Address</div>
                        <input type="text" id="username" name="logusername" placeholder="Enter Your Email Address" required>

                        <div class="title"><i class="fa fa-lock"></i> Password</div>
                        <input type="password" id="password" name="logpassword" placeholder="Enter Your Password" required>
                        <div class="btn-div" onClick="_reset_password_page()">Forgot Password? <span>RESET PASSWORD HERE</span></div>                        <button type="submit"><i class="fa fa-check"></i> Log-in</button>

                        </form>
                </div>
                
                
                
                
                
                <div class="login reset">
                        <h2><i class="fa fa-unlock"></i> Reset Password <br clear="all" /><hr><br clear="all" /></h2>
                        
                        <form action="connection/code.php?action=reset_password" enctype="multipart/form-data" method="post">
                        <div class="title"><i class="fa fa-envelope"></i> Email Address</div>
                        <input type="text" id="" name="reset_email" placeholder="Enter Your Email Address" required>

                        <div class="btn-div" onClick="_login_page()">Click Here To <span>LOG-IN</span></div>             
                       <button type="submit"><i class="fa fa-check"></i> Proceed</button>

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