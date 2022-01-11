<?php
///////call all data in staff_tab
if($loguser_id==''){
	?>
	<script>
	alert('SESSION EXPIRED');
	window.parent(location="../index.php");
	</script>

<?php
}else{

$userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE user_id = '$loguser_id'") or die ('cannot select staff');
$user_count=mysqli_num_rows($userquery);
if ($user_count>0){
	//// do nothing
	$userdata=mysqli_fetch_array($userquery);


		
	$first_name=$userdata['first_name'];
	$last_name=$userdata['last_name'];
	$address=$userdata['address'];
	$phone_number=$userdata['phone_number'];
	$email_address=$userdata['email_address'];
	$role_id=$userdata['role_id'];
	$status_id=$userdata['status_id'];
	$passport=$userdata['passport'];
	$last_login_date=$userdata['last_login_date'];

	$last_login_date_nav=date("M jS, Y", strtotime($last_login_date));

	$fullname=ucwords(strtolower("$first_name $last_name"));
	

}else{
	?>
	<script>
	window.parent(location="../index.php");
	</script>

<?php	
}

}
?>





<?php
$query = mysqli_query ($conn,"SELECT sum(cart_qty) FROM `cart_tab` WHERE order_id = '$order_id'");
	$fetch=mysqli_fetch_array($query);
	$total_order_qty=$fetch[0];
	if ($total_order_qty==''){$total_order_qty=0;}
?>











