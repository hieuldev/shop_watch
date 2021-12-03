<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
 ?>	
<?php $value=$_GET['search']; ?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Kết quả tìm kiếm</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      	$show_product = $product->show_product_by_search($value);
	      	if($show_product){
	      		while ($result = $show_product->fetch_assoc()) {
	      			      	
	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'], 50) ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VND" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
				}
				}
				 ?>
			</div>
			
        <div class="page">
          <?php
          $count;
            $show=$product->product_by_search($value);
            if($show)
            {
                while ($result = $show->fetch_assoc()) {
                $count=$result['COUNT(*)'];
                }   
            }
            if($count==0)
            {
                echo "Không tìm thấy kết quả";
            }
            else
            {
            
            $show_button=ceil($count/16);//ceil làm tròn
            $i=1;
            echo '<p>Trang</p>';
            for($i=1;$i<=$show_button;$i++)
            {
                echo '<a href="search.php?search='.$value.'&page='.$i.'">'.$i.'</a>';
            }}
            ?>  
        </div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
 ?>
