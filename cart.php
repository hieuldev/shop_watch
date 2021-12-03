<?php
include "inc/header.php";

?>
<?php 
if(isset($_GET['cartid'])) {
  
        $cartid = $_GET['cartid'];
       $delcart = $ct ->del_product_cart($cartid);
}
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['submit']))
{
    $cartId=$_POST['cartId'];
    $quantity=$_POST['quantity'];
    $proId=$_POST['proId'];
    $update_quantity_cart=$ct->update_quantity_Cart($proId,$cartId, $quantity);
    if($quantity<=0)
    {
        $delcart = $ct ->del_product_cart($cartId);
    }
} ?>
<?php if(!isset($_GET['id']))
{
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'> ";
}?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Giỏ hàng của bạn
                </h2>
                <?php
                if(isset($update_quantity_cart))
                {
                    echo $update_quantity_cart;
                }
                if(isset($delcart))
                {
                   echo $delcart;
                }
                ?>
						<table class="tblone">
							<tr>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Hình ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng </th>
								<th width="20%">Tổng giá</th>
								<th width="10%">Khác</th>
							</tr>
                            <?php
                           
                            $get_product_cart=$ct->get_product_cart(); 
                            if($get_product_cart)
                            {
                            $subtotal=0;
                             $qty=0;   while($result=$get_product_cart->fetch_assoc())
                            {
                            ?>
							<tr>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $result['price']; ?></td>
								<td>
									<form action="" method="post">
                                        <input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
                                        <input type="hidden" name="proId" min="0" value="<?php echo $result['productId'] ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php $total=$result['price']* $result['quantity'];
                                    echo $total;?></td>
								<td><a href="?cartid=<?php echo $result['cartId']; ?>">Xóa</a></td>
							</tr>
							
							<?php  $qty=$qty+$result['quantity'];
                                 $subtotal +=$total;}}?>
						</table>
                <?php $check_cart = $ct->check_cart();
                            if($check_cart)
                            {{
                            ?>
						<table style="float:right;text-align:left;" width="40%">
                            
							<tr>
								<th>Tổng cộng : </th>
								<td><?php 
                                   
                                    echo $subtotal;
                                     Session::set('sum',$subtotal);
                                    Session::set('qty',$qty);
                                    ?>
                                       </td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Tổng tiền :</th>
								<td><?php 
                                    $vat=$subtotal*0.1;
                                    $gtotal=$subtotal+$vat;
                                    echo $gtotal;
                                    ?></td>
							</tr>
					   </table>
                <?php }}
                else
                {
                    echo 'Giỏ hàng của bạn trống';
                }
                ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include "inc/footer.php";

?>