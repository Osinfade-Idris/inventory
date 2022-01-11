<?php
session_start();			
if ($_POST && !empty($_POST['logusername'])) {
$_SESSION['logusername'] = $_POST['logusername'];
}
$logusername=$_SESSION['logusername'];
  
if ($_POST && !empty(md5(trim($_POST['logpassword'])))) {
$_SESSION['logpassword'] = md5(trim($_POST['logpassword']));
}
$logpassword=$_SESSION['logpassword'];

///// session user_id across the pages
$loguser_id = $_SESSION['user_id'];

//// for user registration
$reg_user_id=$_SESSION['reg_user_id'];

//// for brand profile
$_SESSION['brand_id'] = $brand_id;

//// for category
$category_id = $_SESSION['category_id'];


//// for product
$product_id = $_SESSION['product_id'];


////// to place order
$order_id=$_SESSION['order_id'];


 //// get search into session
 if ($_POST && !empty($_POST['txt_search'])) {
$_SESSION['txt_search'] = $_POST['txt_search'];
}
 $txt_search = $_SESSION['txt_search'];


////// for stock id
$stock_id=$_SESSION['stock_id'];



  //// get voucher denimination id into session
  $vd_id =$_SESSION['vd_id'] ; 


/// order history search
 if ($_POST && !empty($_POST['date_from'])) {
$_SESSION['date_from'] = $_POST['date_from'];
}
 $date_from = $_SESSION['date_from'];

 if ($_POST && !empty($_POST['date_to'])) {
$_SESSION['date_to'] = $_POST['date_to'];
}
 $date_to = $_SESSION['date_to'];







////// for transaction
$transaction_id=$_SESSION['transaction_id'];



////// for charge
$charge_id=$_SESSION['charge_id'];






?>









