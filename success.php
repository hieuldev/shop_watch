<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>
 
<?php 
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       $customer_id = Session::get('customer_id');
       $insertOrder = $ct->insertOrder($customer_id);
       $delCart = $ct->del_all_data_cart();
       header('Location:success.php');
    }
 ?>
 

<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<h2 class="success_order">Đặt hàng thành công</h2>
<!--
            <?php
             $customer_id = Session::get('customer_id');
            $get_amount=$ct->getAmountPrice($customer_id);
            
                if($get_amount)
                {
                    $amount=0;
                    while($result=$get_amount->fetch_assoc())
                    {
                $price=$result['price'];
                 $amount+=$price;
                    }}
            ?>
            <p> Tổng số tiền bạn đã mua:<?php 
                $vat=$amount*0.1;
                $total=$vat+$amount;
                echo $total. 'VND';
                ?></p>
-->
            <p>Hãy xem lại chi tiết đơn hàng của bạn<a href="orderdetails.php">Chi tiết</a></p>
 		</div>
 	</div>
 	
 </div>
</form>
<?php 
	include 'inc/footer.php';
 ?>