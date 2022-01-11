  <?php require_once('admin.php');?>
  <?php require_once('session.php');?>
  <?php $action=$_GET['action'];?>


<?php
  //// for change password
  if ($action=='change_password'){//// checkk 001
      $userquery = mysqli_query ($conn,"SELECT * FROM `staff_tab` WHERE `user_id` = '$loguser_id'") or die ('cannot select user');
        $userdata=mysqli_fetch_array($userquery);
        $db_password=$userdata['password'];
      
        if ($old_password!= $db_password){//// check 002
          ?>
          <script>
          alert('INCORRECT OLD PASSWORD!!!');
          window.parent(location="../staff-portal/change-password.php");
          </script>
          <?php
        }else{//else check 002
          if ($new_password!=$confirm_new_password){/// check 003
            ?>
          <script>
          alert('NEW PASSWORD AND CONFIRM PASSWORD IS NOT THE SAME');
          window.parent(location="../staff-portal/change-password.php");
          </script>
          <?php
          }else{//else check 003
            mysqli_query($conn,"UPDATE staff_tab SET `password`='$new_password' where `user_id` = '$loguser_id'");
            ?>
            <script>
            
            window.parent(location="../staff-portal/change-password-successful.php");
            </script>
            <?php
          }/// end check 003
        }/// end check 002
      }/// end check 001
?>






<?php
  //// for logout
  if ($action=='logout'){
	session_destroy();
	?>
		    <script>
        window.parent(location="../index.php");
        </script>
<?php
  }
?>






<?php
///// for user profile update
if ($action=='update_users_profile'){
  $loguser_id=$_GET['loguser_id'];

  $passport = $_FILES["passport"]["name"]; 
  ////////// check if email address is present in the database
  $emailquery = mysqli_query($conn, "SELECT email_address FROM staff_tab WHERE email_address = '$email_address' AND `user_id`!='$loguser_id'") or die('cannot select');
  $emailcount = mysqli_num_rows($emailquery);

if($emailcount>0){
  ?>
    <script>
          alert('THE EMAIL HAD ALREADY BEEN USED');
          window.parent(location="../staff-portal/user-profile.php?user_id=<?php echo $loguser_ids?>");
          </script>
    <?php
}else{/////
  if($passport==''){
    mysqli_query ($conn,"UPDATE `staff_tab` SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number', `address`='$address', email_address='$email_address' WHERE `user_id` = '$loguser_id'")or die ('cannot update');
  }else {//////////////////////////////

          $allowedExts = array("jpg", "jpeg", "JPEG", "JPG", "gif", "png");
          $extension = pathinfo($_FILES["passport"]["name"], PATHINFO_EXTENSION);
         if (in_array($extension, $allowedExts)){				 //////////array 
          $passport = date('Ymdis').$user_id.$passport;
          move_uploaded_file($_FILES["passport"]["tmp_name"], "../staff-portal/upload/user-passport/".$passport);
          }//////////////////end array

mysqli_query($conn, "UPDATE `staff_tab` SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number', `address`='$address', email_address='$email_address', passport='$passport' WHERE `user_id` = '$user_profile_id'")or die ('cannot update');
  }

  
    ?>
        <script>
          alert('UPDATE COMPLETE!!!');
          window.parent(location="../staff-portal/user-profile.php?user_id=<?php echo $loguser_id?>");
          </script>
    <?php
  }
}
?>














<?php
  //// for adding product to cart
  if ($action=='add_to_cart'){ 
   
    $product_id=$_GET['product_id'];

        /// get current master_value from matser_tab for cart
        $cartquery = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id = 'CART' FOR UPDATE");
        $cartsel=mysqli_fetch_array($cartquery);
        $cart_master_value=$cartsel['master_value'];
        $cart_master_value=$cart_master_value+1;

        ////// get cart_id
        $cart_id='CART'.$cart_master_value; 
       
        ///// update master_value in master_tab for cart
        mysqli_query ($conn,"UPDATE `master_tab` SET master_value='$cart_master_value' WHERE master_id = 'CART'");
        
        if ($order_id==''){
        /// get current master_value from matser_tab for order
          $orderquery = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id = 'ORDER' FOR UPDATE");
          $ordersel=mysqli_fetch_array($orderquery);
          $order_master_value=$ordersel['master_value'];
          $order_master_value=$order_master_value+1;

          ////// get order_id
          $order_id='ORDER'.$order_master_value; 
          $_SESSION['order_id']=$order_id;

                  ///// update master_value in master_tab for order
          mysqli_query ($conn,"UPDATE `master_tab` SET master_value='$order_master_value' WHERE master_id = 'ORDER'");
        }  

          /// get current  product_price  from product tab 
          $productpricequery = mysqli_query ($conn,"SELECT product_price FROM `product_tab` WHERE product_id = '$product_id'");
          $productpricesel=mysqli_fetch_array($productpricequery);
          $product_price=$productpricesel['product_price'];

          $sub_amount=($product_quantity*$product_price);



          $cartquery = mysqli_query ($conn,"SELECT * FROM `cart_tab` WHERE order_id = '$order_id' AND product_id='$product_id'");
          $cartcount=mysqli_num_rows($cartquery);

        if($cartcount>0){
          ////// insert into cart_tab
          mysqli_query($conn,"UPDATE cart_tab  SET cart_qty='$product_quantity', unit_price='$product_price', sub_amount='$sub_amount'
          WHERE order_id = '$order_id' AND product_id='$product_id'") or die ('Cannot update cart');
        }else{
          ////// insert into cart_tab
          mysqli_query($conn,"INSERT INTO cart_tab VALUES ('', '$cart_id', '$order_id', '$product_id', '$product_quantity', '$product_price', '$sub_amount', '$loguser_id', 'P', NOW())") or die ('Cannot add to cart');
     }     
     ?>
            <script>
            window.parent(location="../staff-portal/product-category.php");  
            </script>
          <?php
            }///end check 3
          
         
?>








<?php
  //// for deleting cart
  if ($action=='delete_cart'){
    $order_id=$_GET['order_id'];
    $product_id=$_GET['product_id'];

  ////// delete from cart_tab
  mysqli_query($conn,"DELETE FROM `cart_tab` WHERE `product_id` = '$product_id' AND `order_id`='$order_id'") or die ('Cannot delete from cart');
	?>
		    <script>
        window.parent(location="../staff-portal/cart-list.php?order_id=<?php echo $order_id?>");
        </script>
<?php
  }
?>






<?php
  //// for deleting voucher from voucher cart
  if ($action=='delete_voucher_cart'){
    $vd_id=$_GET['vd_id'];
    $order_id=$_GET['order_id'];

  ////// delete from voucher cart_tab
  mysqli_query($conn,"DELETE FROM `voucher_cart_tab` WHERE `vd_id` = '$vd_id' AND `order_id`='$order_id'") or die ('Cannot delete from cart');
	?>
		    <script>
        window.parent(location="../staff-portal/order-voucher.php?order_id=<?php echo $order_id?>");
        </script>
<?php
  }
?>









<?php
  //// for placing order
  if ($action=='place_order'){ /// check 1
    $order_id=$_GET['order_id'];

        $cartquery = mysqli_query ($conn,"SELECT sum(cart_qty),sum(sub_amount),staff_id FROM `cart_tab` WHERE order_id='$order_id'") or die ('cannot select order details');
        $cartdata=mysqli_fetch_array($cartquery);

          $total_qty=$cartdata['sum(cart_qty)'];
          $total_amount=$cartdata['sum(sub_amount)'];
          $staff_id=$cartdata['staff_id'];


          $otp = rand(111111,999999);

            ////////// check if customer phone number is present in the database
          $customerquery = mysqli_query($conn, "SELECT customer_phone FROM customer_tab WHERE customer_phone = '$customer_phone'") or die('cannot select customer');
          $customercount = mysqli_num_rows($customerquery);
          if($customercount>0){

         /////do nothing
            ////// insert into customer_tab
            $customerquery = mysqli_query ($conn,"SELECT customer_id FROM `customer_tab` WHERE customer_phone = '$customer_phone'");
            $customersel=mysqli_fetch_array($customerquery);
            $customer_id=$customersel['customer_id'];

            mysqli_query($conn,"UPDATE customer_tab SET customer_name='$customer_name', customer_email='$customer_email' WHERE customer_phone='$customer_phone'") or die ('Cannot update');



          }else{


            /// get current master_value from matser_tab for customer
          $customerquery = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id = 'CUSTOMER' FOR UPDATE");
          $customersel=mysqli_fetch_array($customerquery);
          $master_value=$customersel['master_value'];
          $master_value=$master_value+1;

          ////// get customer_id
          $customer_id='CUSTOMER'.$master_value; 

          ///// update master_value in master_tab for customer
          mysqli_query ($conn,"UPDATE `master_tab` SET master_value='$master_value' WHERE master_id = 'CUSTOMER'");

             
            ////// insert into customer_tab
            mysqli_query($conn,"INSERT INTO customer_tab VALUES ('', '$customer_id', '$customer_name', '$customer_phone', '$customer_email', NOW())") or die ('Cannot insert customer');
          }
            ////// insert into order_tab
            mysqli_query($conn,"INSERT INTO order_tab VALUES ('', '$order_id', '$total_qty', '$total_amount', '$payment_method_id', '$otp', '$staff_id', '$customer_id', NOW())") or die ('Cannot insert into order tab');

            //////////////update cart tab to be succsessful
            mysqli_query($conn,"UPDATE cart_tab SET order_status_id='S' WHERE order_id='$order_id'") or die ('Cannot update');
          
          ?>
          
            <script>
            window.parent(location="../staff-portal/order-successful.php");  
            </script>
            <?php
            
            }///end check 3
?>














<?php
  //// for adding voucher to cart
  if ($action=='add_to_voucher_cart'){ 
   
        /// get current master_value from matser_tab for cart
        $cartquery = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id = 'VOUCHER_CART' FOR UPDATE");
        $cartsel=mysqli_fetch_array($cartquery);
        $cart_master_value=$cartsel['master_value'];
        $cart_master_value=$cart_master_value+1;

        ////// get voucher_cart_id
        $vc_id='VOUCHER_CART'.$cart_master_value;
       
        ///// update master_value in master_tab for cart
        mysqli_query ($conn,"UPDATE `master_tab` SET master_value='$cart_master_value' WHERE master_id = 'VOUCHER_CART'");
        
        if ($order_id==''){
        /// get current master_value from matser_tab for order
          $orderquery = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id = 'ORDER' FOR UPDATE");
          $ordersel=mysqli_fetch_array($orderquery);
          $order_master_value=$ordersel['master_value'];
          $order_master_value=$order_master_value+1;

          ////// get order_id
          $order_id='ORDER'.$order_master_value; 
          $_SESSION['order_id']=$order_id;

                  ///// update master_value in master_tab for order
          mysqli_query ($conn,"UPDATE `master_tab` SET master_value='$order_master_value' WHERE master_id = 'ORDER'");
        }  

          /// get current  product_price & vd_id  from voucher denomination tab 
          $productpricequery = mysqli_query ($conn,"SELECT * FROM `voucher_denomination_tab` WHERE voucher_id ='$voucher_id' AND denomination_id ='$denomination_id'") or die('Cannot select unit price');
          $productpricesel=mysqli_fetch_array($productpricequery);
          $vd_id=$productpricesel['vd_id'];
          $product_price=$productpricesel['unit_price'];

          $sub_amount=($voucher_quantity*$product_price);

          $cartquery = mysqli_query ($conn,"SELECT * FROM `voucher_cart_tab` WHERE order_id = '$order_id' AND vd_id='$vd_id'");
          $cartcount=mysqli_num_rows($cartquery);


        if($cartcount>0){
          ////// insert into voucher_cart_tab
          mysqli_query($conn,"UPDATE voucher_cart_tab  SET order_qty='$voucher_quantity', unit_price='$product_price', sub_amount='$sub_amount'
          WHERE order_id = '$order_id' AND vd_id='$vd_id'") or die ('Cannot update voucher cart');
        }else{
          ////// insert into voucher_cart_tab
          mysqli_query($conn,"INSERT INTO voucher_cart_tab VALUES ('', '$vc_id', '$order_id', '$vd_id', '$voucher_quantity', '$product_price', '$sub_amount', '$loguser_id', 'P', NOW())") or die ('Cannot add to voucher cart');
     }     
     ?>
            <script>
            window.parent(location="../staff-portal/order-voucher.php");  
            </script>
          <?php
            }///end check 3
          
         
?>




















<?php
  //// for placing order
  if ($action=='place_voucher_order'){ /// check 1
    $order_id=$_GET['order_id'];

        $cartquery = mysqli_query ($conn,"SELECT sum(order_qty),sum(sub_amount),staff_id FROM `voucher_cart_tab` WHERE order_id='$order_id'") or die ('cannot select order details');
        $cartdata=mysqli_fetch_array($cartquery);

          $total_qty=$cartdata['sum(order_qty)'];
          $total_amount=$cartdata['sum(sub_amount)'];
          $staff_id=$cartdata['staff_id'];


          $otp = rand(111111,999999);

          
        ////////// check if customer phone number is present in the database
        $customerquery = mysqli_query($conn, "SELECT customer_phone FROM customer_tab WHERE customer_phone = '$customer_phone'") or die('cannot select customer');
        $customercount = mysqli_num_rows($customerquery);
        if($customercount>0){

        /////do nothing
        ////// insert into customer_tab
        $customerquery = mysqli_query ($conn,"SELECT customer_id FROM `customer_tab` WHERE customer_phone = '$customer_phone'");
        $customersel=mysqli_fetch_array($customerquery);
        $customer_id=$customersel['customer_id'];

         /////do nothing

            mysqli_query($conn,"UPDATE customer_tab SET customer_name='$customer_name', customer_email='$customer_email' WHERE customer_phone='$customer_phone'") or die ('Cannot update');
          }else{

              /// get current master_value from matser_tab for customer
          $customerquery = mysqli_query ($conn,"SELECT * FROM `master_tab` WHERE master_id = 'CUSTOMER' FOR UPDATE");
          $customersel=mysqli_fetch_array($customerquery);
          $master_value=$customersel['master_value'];
          $master_value=$master_value+1;

          ////// get customer_id
          $customer_id='CUSTOMER'.$master_value; 

          ///// update master_value in master_tab for customer
          mysqli_query ($conn,"UPDATE `master_tab` SET master_value='$master_value' WHERE master_id = 'CUSTOMER'");


             
            ////// insert into customer_tab
            mysqli_query($conn,"INSERT INTO customer_tab VALUES ('', '$customer_id', '$customer_name', '$customer_phone', '$customer_email', NOW())") or die ('Cannot insert customer');
          }
            ////// insert into order_tab
            mysqli_query($conn,"INSERT INTO order_voucher_tab VALUES ('', '$order_id', '$total_qty', '$total_amount', '$payment_method_id', '$otp', '$payment_type_id', '$staff_id', '$customer_id', NOW())") or die ('Cannot insert into order tab');

            //////////////update cart tab to be succsessful
            mysqli_query($conn,"UPDATE voucher_cart_tab SET order_status_id='S' WHERE order_id='$order_id'") or die ('Cannot update');
          
          ?>
          
            <script>
            window.parent(location="../staff-portal/voucher-order-successful.php");  
            </script>
            <?php
            
            }///end check 3
            
         
?>
