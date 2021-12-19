<?php 
	include 'inc/header.php';
	//include 'inc/slider.php';
 ?>	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản phẩm nối bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      	$product_featheread = $product->getproduct_featheread();
	      	if($product_featheread){
	      		foreach ($product_featheread as $result) {
	      			      	
	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['_id'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p>
                     <?php
                    //  $result2 = $product->get_promotion($result['productName']);
	      	        // if($result2){
	      		      
                    //        echo'<p><strike><span class="price">';echo $fm->format_currency($result['price'])." "."VND"; 
					// 	   echo'</span></strike></p>';  
					// 	 echo'<p><span class="price">';echo $fm->format_currency($result2['PromotionPrice'])." "."VND"; echo'</span></p>';                     
                    //     }
                    // else
                    //     {
                            echo'<p><span class="price">';echo $fm->format_currency($result['price'])." "."VND"; echo'</span></p>'; 
                        // }
                        // ?>
                    
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['_id'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
				}
				}
				 ?>
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản phẩm mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
			<?php 
	      	$product_new = $product->getproduct_new();
	      	if($product_new){
	      		while ($result_new = $product_new->fetch_assoc()) {
	      			      	
	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php"><img src="admin/uploads/<?php echo $result_new['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_new['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_new['product_desc'], 50) ?></p>
					 <?php
                     $get_promotion1 = $product->get_promotion($result_new['productId']);
	      	        if($get_promotion1){
	      		       if ($result3 = $get_promotion1->fetch_assoc())
                       {
                         echo'<p><strike><span class="price">';echo $fm->format_currency($result_new['price'])." "."VND"; echo'</span></strike></p>';    echo'<p><span class="price">';echo $fm->format_currency($result3['PromotionPrice'])." "."VND"; echo'</span></p>'; 
                        }
                        
                        }
                    else
                        {
                            echo'<p><span class="price">';echo $fm->format_currency($result_new['price'])." "."VND"; echo'</span></p>'; 
                        }
                        ?>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
			<?php 
				}
				}
			?>
			</div>
        <div class="page">
          <?php
            $product_all=$product->get_all_product();
            $product_count=mysqli_num_rows($product_all);
            $product_button=ceil($product_count/8);//ceil làm tròn
            $i=1;
            echo '<p>Trang</p>';
            for($i=1;$i<=$product_button;$i++)
            {
                echo '<a href="index.php?page='.$i.'">'.$i.'</a>';
            }
            ?>  
        </div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
 ?>
