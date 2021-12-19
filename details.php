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
    		$result_details = $product->get_details($id);
    		if ($result_details) {
    			
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
                    //  $result2 = $product->get_promotion($id);
	      		    //    if ($result2)
                    //    {
                    //      echo'<p>Giá: <span>';echo $result2['PromotionPrice']." "."VND";; echo'</span></p>'; 
                    //     }
                        
                    // else
                    //     {
                            echo'<p>Giá: <span>';echo $result_details['price']." "."VND";; echo'</span></p>'; 
                        // }
                        ?>
						
						<p>Loại hàng: <span><?php echo $result_details['cat'];?></span></p>
						<p>Thương hiệu:<span><?php echo $result_details['brand'];?></span></p>
					</div>
				<div class="add-cart">
                    
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Mua ngay"/>
                       
					</form>	
                    
                    <?php 
						//if (isset($insertCart)) {
						//	echo '<span style="color:red; font-size:18px;">Sản phẩm đã được bạn thêm vào giỏ hàng</span>';
						//}
					 ?>	 
                </div>
                    <div class="add-cart">
                        <div class="button_details">
					<form action="" method="post">
						
                        <input type="hidden"  name="productid" value="<?php echo $result_details['_id'] ?>"/>
					</form>	
                        <form action="" method="post">
						
                        <input type="hidden"  name="productid" value="<?php echo $result_details['_id'] ?>"/>
                         </form>	
			</div>
                    </div>
			<div class="product-desc">
			<h2>Chi tiết sản phẩm</h2>
			<?php echo $result_details['product_desc'];?>
	    </div>
				
	</div>
            <?php 
}
            ?>
                    
 		</div>
            <div class="rightsidebar span_3_of_1">
					<h2>Loại hàng</h2>
                    <?php 
                    $getall_category=$cat->show_category_fontend();
                    if($getall_category)
                    {foreach($getall_category as $result_allcat)
                    {
                    ?>
					<ul>
				      <li><a href="productbycat.php?catid=<?php echo $result_allcat['_id']; ?>">
                          <?php echo $result_allcat['catName']; ?></a></li>
				      
    				</ul>
    	<?php }} ?>
 				</div>
				
 	</div>
        
	<?php
include "inc/footer.php";

?>