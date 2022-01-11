<?php if($role_id!="A"){
	   session_destroy();
	?>
		<script>
        alert('INVALID LINK');
        window.parent(location="../index.php");
        </script>
          <?php
    
      }////////////end else for check 1
   
?>
