<div class="header-div">
	<div class="header-in">
		<div class="logo-div"><img src="images/logo2.png" alt="Inventory"/></div>
		<div class="men-div" onclick="_view_menu()"><i class="fa fa-bars"></i></div>

		<div class="pix-div" onclick="_expand_link('log')"><img src="upload/user-passport/<?php echo $passport?>" alt="PASSPORT"/>
			<div class="toggle"  id="log">
			<a href="user-profile.php?user_id=<?php echo $loguser_id?>"><div class="sub-link"><i class="fa fa-eye"></i> My Profile </div></a>
			<a href="../connection/code.php?action=logout"><div class="sub-link"><i class="fa fa-sign-out-alt"></i> Log-Out </div></a>
			</div>	
		</div>		
		
	</div>
</div>  
    
      
 

<div class="slide-back-div" onclick="_hide_menu()"></div>
<div class="flash-out-div"></div>