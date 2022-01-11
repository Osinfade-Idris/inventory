<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);

//connection to database  
$conn = mysqli_connect("localhost", "root", "")or die("Unable to connect to MySQL");
mysqli_select_db($conn,"ivsm");
///////////////////////////////////////////////////////////////////////////////////////


//all variable declaration

// for staff registration and update
$first_name=strtoupper(trim($_POST['first_name']));
$last_name=strtoupper(trim($_POST['last_name']));
$address=strtoupper(trim($_POST['address']));
$phone_number=(trim($_POST['phone_number']));
$email_address=(trim($_POST['email_address']));
$passport=(trim($_POST['passport']));
$role_id=strtoupper(trim($_POST['role_id']));
$status_id=strtoupper(trim($_POST['status_id']));
$password=md5(trim($_POST['password']));
$confirm_password=md5(trim($_POST['confirm_password']));





//// for user login
$logusername=strtoupper(trim($_POST['logusername']));
$logpassword=md5(trim($_POST['logpassword']));


//// for reset email
$reset_email=(trim($_POST['reset_email']));
$otp=strtoupper(trim($_POST['otp']));



/// Change Password
$old_password=md5(trim($_POST['old_password']));
$new_password=md5(trim($_POST['new_password']));
$confirm_new_password=md5(trim($_POST['confirm_new_password']));




////// for category registration and update
$category_name=strtoupper(trim($_POST['category_name']));



// for product registration and update
$product_category_name=strtoupper(trim($_POST['product_category_name']));
$product_name=strtoupper(trim($_POST['product_name']));
$product_details=strtoupper(trim($_POST['product_details']));
$product_price=strtoupper(trim($_POST['product_price']));
$product_picture=trim($_POST['product_picture']);
$product_status=strtoupper(trim($_POST['product_status']));


/// For Payment
$payment_method_id=strtoupper(trim($_POST['payment_method_id']));
$payment_type_id=strtoupper(trim($_POST['payment_type_id']));


/// Customer Registration
$customer_name=strtoupper(trim($_POST['customer_name']));
$customer_phone=(trim($_POST['customer_phone']));
$customer_email=(trim($_POST['customer_email']));


/// Search 
$txt_search=strtoupper(trim($_POST['txt_search']));



/// Stock Adding And Adding Denomination
$voucher_id=strtoupper(trim($_POST['voucher_id']));
$denomination_id=strtoupper(trim($_POST['denomination_id']));
$stock_quantity=strtoupper(trim($_POST['stock_quantity']));
$stock_price=strtoupper(trim($_POST['stock_price']));


/// order history search

$date_from=strtoupper(trim($_POST['date_from']));
$date_to=strtoupper(trim($_POST['date_to']));


////////////////for loading of product
$product_quantity=strtoupper(trim($_POST['product_quantity']));


////////////////for loading of voucher
$voucher_quantity=strtoupper(trim($_POST['voucher_quantity']));

////////////////for updating loading of product
$load_product_quantity=strtoupper(trim($_POST['load_product_quantity']));


////////////////for money transfer
$account_number=strtoupper(trim($_POST['account_number']));
$account_name=strtoupper(trim($_POST['account_name']));
$bank_id=strtoupper(trim($_POST['bank_id']));
$deposit_amount=strtoupper(trim($_POST['deposit_amount']));
$name_of_depositor=strtoupper(trim($_POST['name_of_depositor']));
$transfer_phone_number=strtoupper(trim($_POST['transfer_phone_number']));
$email_transfer=(trim($_POST['email_transfer']));



////////////////for money transfer
$minimum_amount=strtoupper(trim($_POST['minimum_amount']));
$maximum_amount=strtoupper(trim($_POST['maximum_amount']));
$charge=strtoupper(trim($_POST['charge']));









?>










