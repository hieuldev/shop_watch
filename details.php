<?php
include "inc/header.php";
?>
<?php
 if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script> window.location = '404.php' </script>";
        
   }else {
      $id = $_GET['proid']; // Lấy productid trên host
   } 
$customer_id=Session::get('customer_id');
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['compare']))
{
    $productid=$_POST['productid'];
    $insertCompare=$product->insertCompare($productid,$customer_id);
}
$customer_id=Session::get('customer_id');
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['wishlist']))
{
    $productid=$_POST['productid'];
    $insertWishlist=$product->insertWishlist($productid,$customer_id);
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $quantity = $_POST['quantity'];
        $insertCart = $ct -> add_to_cart($id, $quantity); // hàm check catName khi submit lên
    }  

?>
 <div class="main">
    <div class="content">
    	<div class="section group">
		<?php 
    		$get_product_details = $product->get_details($id);
    		if ($get_product_details) {
    			while ($result_details = $get_product_details->fetch_assoc()) {
    				# code...
    			
    		 ?>
            
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'];?></h2> 
					<p><?php echo $fm->textShorten($result_details['product_desc'],150);?></p>					
					<div class="price">
                        <?php
                     $get_promotion = $product->get_promotion($id);
	      	        if($get_promotion){
	      		       if ($result2 = $get_promotion->fetch_assoc())
                       {
                         echo'<p>Giá: <span>';echo $result2['PromotionPrice']." "."VND";; echo'</span></p>'; 
                        }
                        
                        }
                    else
                        {
                            echo'<p>Giá: <span>';echo $result_details['price']." "."VND";; echo'</span></p>'; 
                        }
                        ?>
						
						<p>Loại hàng: <span><?php echo $result_details['catName'];?></span></p>
						<p>Thương hiệu:<span><?php echo $result_details['brandName'];?></span></p>
					</div>
				<div class="add-cart">
                    
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Mua ngay"/>
                       
					</form>	
                    
                    <?php 
						if (isset($insertCart)) {
							echo '<span style="color:red; font-size:18px;">Sản phẩm đã được bạn thêm vào giỏ hàng</span>';
						}
					 ?>	 
                </div>
                <?php if(isset($insertCompare))
                        {
                            echo $insertCompare;
                        }?>
                        <?php if(isset($insertWishlist))
                        {
                            echo $insertWishlist;
                        }?>
                    <div class="add-cart">
                        <div class="button_details">
					<form action="" method="post">
						
                        <input type="hidden"  name="productid" value="<?php echo $result_details['productId'] ?>"/>
                         <?php 
	  $login_check = Session::get('customer_login');
//if($login_check){
//          echo '<input type="submit" class="buysubmit" name="compare" value="So sánh sản phẩm"/>';
           
//      }
//                    else
//                    {
//                        echo '';
//                    }?>
                       
					</form>	
                        <form action="" method="post">
						
                        <input type="hidden"  name="productid" value="<?php echo $result_details['productId'] ?>"/>
                         <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check){
          
           echo '<input type="submit" class="buysubmit" name="wishlist" value="Thêm vào danh sách yêu thích "/>';
      }
                    else
                    {
                        echo '';
                    }?>
                       
					</form>	
			</div>
                    </div>
			<div class="product-desc">
			<h2>Chi tiết sản phẩm</h2>
			<?php echo $result_details['product_desc'];?>
	    </div>
				
	</div>
            <?php 
                }}
            ?>
                    
 		</div>
            <div class="rightsidebar span_3_of_1">
					<h2>Loại hàng</h2>
                    <?php 
                    $getall_category=$cat->show_category_fontend();
                    if($getall_category)
                    {while($result_allcat= $getall_category->fetch_assoc())
                    {
                    ?>
					<ul>
				      <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId']; ?>">
                          <?php echo $result_allcat['catName']; ?></a></li>
				      
    				</ul>
    	<?php }} ?>
 				</div>
				
 	</div>
        
	<?php
include "inc/footer.php";

?>