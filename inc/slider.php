
<div class="header_bottom">
		<div class="header_bottom_left">
			<h2><b>Danh mục sản phẩm</b></h2>
			<div class="menu-category">
			<?php 
		
                    $getall_category=$cat->show_category_fontend();
                    if($getall_category)
                    {foreach($getall_category as $result_allcat)
                    {
                    ?>
					<ul>
				      <li id="<?php echo $result_allcat['_id']?>" ><a href="productbycat.php?catid=<?php echo $result_allcat['_id']?>">
                          <?php echo $result_allcat['catName']; ?></a></li>
				      
    				</ul>
		<?php }} ?>
			</div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
                        <?php 
						$get_slider = $product->show_slider();
						if ($get_slider) {
							foreach ( $get_slider as $result_slider) {
								# code...
							
						 ?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>"/></li>
						<?php 
						}
						}
						 ?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
		</div>
		<div class="flashnews">
			<?php
			$show_img_news=$news->show_flashnews();
			if($show_img_news)
			{foreach($show_img_news as $result){
			?>
		<a href="newsdetails.php?id=<?php echo $result['newsID'] ?>"><img src="admin/uploads/<?php echo $result['newsImg']?>" title="<?php echo $result['newsTitle'] ?>" /></a>
			<?php }}?>
		</div>
	  <div class="clear"></div>
  </div>	
  <script>
  <?php 
		
		$getall_category=$cat->show_category_fontend();
		if($getall_category)
		{while($result_allcat= $getall_category->fetch_assoc())
		{
		?>
	  $(document).ready(function(){
		  $('#<?php echo $result_allcat['catId']?>').mouseover(function(){
			$('#<?php echo $result_allcat['catId']?>').css('background','#544b9e');
		  }).mouseout(function(){
			$('#<?php echo $result_allcat['catId']?>').css('background','#4267b2');
		  })

})
	 
	  <?php }} ?>
  </script>
 