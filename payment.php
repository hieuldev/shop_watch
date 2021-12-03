<?php 
	include 'inc/header.php';
 ?>
 <?php 
	  $login_check = Session::get('customer_login');
	  if ($login_check==false) {
	  	header('Location:login.php');
	  }
	   ?>
<?php 
	
 ?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		<div class="heading">
    		<h3>Trang thanh toán</h3>
    		</div>
            
    		<div class="clear"></div>
            <div class="wrapper_method">
             <h3 class="payment">Chọn phương thức thanh toán</h3><br>
                <a href="onlinepayment.php">Thanh toán online</a>
               <a href="offlinepayment.php">Thanh toán bằng tiền mặt</a><br><br><br><br>
                <a style="background:gray" href="cart.php">Quay lại</a>
                </div>
    	</div>
    	
    	</div>	
 	</div>

<?php 
	include 'inc/footer.php';
 ?>