<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
<?php 
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $update_qty_pd = $ct->get_product_cart();
		if($update_qty_pd){						
            while ($result = $update_qty_pd->fetch_assoc()) 
            {
                $qty=$result['quantity'];
                $id=$result['productId'];
                $up=$product->update_qty_product($id,$qty);
            }}
      $customer_id = Session::get('customer_id');
      $insertOrder = $ct->insertOrder($customer_id);
       $delCart = $ct->del_all_data_cart();
        
header('Location:success.php');
    }
 ?>
  <?php 
	  $login_check = Session::get('customer_login');
	  if ($login_check==false) {
	  	header('Location:login.php');
	  }
	   ?>

<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		     <h3>Thanh toán</h3>
    		</div>
    		<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
			    	<h2>Giỏ hàng</h2>
			    	<?php 
			    	if (isset($update_quantity_Cart)) {
			    		echo $update_quantity_Cart;
			    	}
			    	 ?>
			    	<?php 
			    	if (isset($delcart)) {
			    		echo $delcart;
			    	}
			    	 ?>
			    	 <?php
			    	 if(isset($delcart)){
			    	 	echo $delcart;
			    	 }
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">Stt</th>
								<th width="15%">Tên sản phẩm</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								
							</tr>
							<?php 
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
								$i=0;
								while ($result = $get_product_cart->fetch_assoc()) {
									$i++;
								
							 ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								
								<td><?php echo $result['price'].' VND' ?></td>
								<td>
									<?php echo $result['quantity'] ?>
								</td>
								<td>
									<?php 
									$total = $result['price'] * $result['quantity'];
									echo $total.' VND';
									 ?>
								</td>
								
							</tr>
							<?php 

							$subtotal += $total;
							$qty = $qty + $result['quantity'];
								}
							}
							 ?>
	
						</table>
						<?php
							$check_cart = $ct->check_cart();
							if ($check_cart) {

							 ?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng giá : </th>
								<td>
								<?php echo $subtotal.' VND';

									  Session::set('sum',$subtotal);
									  Session::set('qty',$qty);
								?>
								</td>
							</tr>
							<tr>
								<th>Thuế : </th>
								<td>10% (<?php echo $vat = $subtotal * 0.1. ' VND';?>)</td>
							</tr>
							<tr>
								<th>Tổng cộng :</th>
								<td><?php 
								$vat = $subtotal * 0.1;
								$grandTotal = $subtotal + $vat;
								echo $grandTotal.' VND';
								 ?> </td>
							</tr>
					   </table>
					   <?php 
						}else {
							echo 'Giỏ hàng của bạn hiện đang rỗng ! Hãy quay lại để mua sắm !';
						}
					    ?>
					</div>
					

    		</div>
    		<div class="box_right">
    			<table class="tblone">
		    		<?php 
		    		$id = Session::get('customer_id');
		    		$get_customers = $cs->show_customers($id);
		    		if ($get_customers) {
		    			while ($result = $get_customers->fetch_assoc()) {
		    			
		    		 ?>
		    		<tr>
		    			<td>Tên</td>
		    			<td>:</td>
		    			<td><?php echo $result['name']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Thành Phố</td>
		    			<td>:</td>
		    			<td><?php echo $result['city']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Số điện thoại</td>
		    			<td>:</td>
		    			<td><?php echo $result['phone']; ?></td>
		    		</tr>
		    		<!-- <tr>
		    			<td>Country</td>
		    			<td>:</td>
		    			<td><?php echo $result['country']; ?></td>
		    		</tr> -->
		    		<tr>
		    			<td>Mã bưu điện</td>
		    			<td>:</td>
		    			<td><?php echo $result['zipcode']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Email</td>
		    			<td>:</td>
		    			<td><?php echo $result['email']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Địa chỉ</td>
		    			<td>:</td>
		    			<td><?php echo $result['address']; ?></td>
		    		</tr>
		            <tr>
		                <td colspan="3"><a href="editprofile.php">Cập nhật thông tin</a></td>
		               
		            </tr>
		    		
		    		<?php 
		    		}
		    		}
		    		 ?>
		    	</table>	

    		</div>
 		</div>
	 </div>
	<?php if(isset($_GET['online'])&&$_GET['online']=='true') {
	echo '<a style="background:gray" href="onlinepayment.php">Quay lại</a>';
}
	else
	{
		echo '<a style="background:gray" href="payment.php">Quay lại</a>';
	}
	?><center style="padding-bottom: 20px;"><a href="?orderid=order" class="a_order">Đặt hàng ngay</a></center>
 </div>
</form>
<?php 
	include 'inc/footer.php';
 ?>