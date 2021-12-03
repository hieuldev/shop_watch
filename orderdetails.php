<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>

<?php 
	$login_check = Session::get('customer_login');
	  if ($login_check==false) {
	  	header('Location:login.php');
	  }
 ?>
 <?php
	if(isset($_GET['confirmid'])){
     	$id = $_GET['confirmid'];
     	
     	$shifted_confirm = $ct->confirm($id);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Chi tiết đơn hàng của bạn</h2>

						<table class="tblone">
							<tr>
								<th width="0%">STT</th>
								<th width="25%">Tên sản phẩm</th>
								<th width="15%">Giá</th>
								<th width="15%">Số lượng</th>
                                <th width="15%">Thành tiền</th>
								<th width="15%">Ngày</th>
								<th width="15%">Trạng thái</th>
								<th width="15%">Xử lý</th>
							</tr>
							<?php
							$customer_id = Session::get('customer_id');  
							$get_cart_ordered = $ct->get_cart_ordered($customer_id);
							if($get_cart_ordered){
								$i=0;
								$qty = 0;
								while ($result = $get_cart_ordered->fetch_assoc()) {
								$i++;
							 ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['ProductName'] ?></td>
<!--								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="100px"/></td>-->
								<td><?php echo $result['Price'].' VND' ?></td>
								<td><?php echo $result['Quantity'] ?></td>
                                <td><?php echo $result['TotalPrice'] ?></td>
								<td><?php echo $fm->formatDate($result['date_order'])  ?></td>
								<td>
								<?php 
									if ($result['StatusId'] == '0') {
										echo "Đang chờ xử lý";
									}elseif($result['StatusId'] == 1) {
								?>
								<span>Đã gửi hàng</span>
								
								<?php

									}elseif($result['StatusId']==2){
										echo 'Đã nhận';
									}
								 ?>	

								</td>
								<?php 
								if ($result['StatusId'] == '0') {
								 ?>

								<td><?php echo 'N/A'; ?></td>

								 <?php 
								 }elseif($result['StatusId']==1) {
								 ?>	
								 <td>
								 	<a href="?confirmid=<?php echo $result['id'] ?>">Xác nhận</a>
								 </td>
								 <?php 
								}else{
								  ?>
								  
								<td><?php echo 'Đã nhận'; ?></td>
								<?php 
								}
								 ?>
							</tr>
							<?php 							
								}
							}
							 ?>
	
						</table>
						
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php 
	include 'inc/footer.php';
 ?>
