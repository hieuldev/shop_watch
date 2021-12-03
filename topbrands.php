<?php
include "inc/header.php";
include "inc/slider.php";
?>
 <?php
$br=$br->show_topbrand();
$max=0;
if($br)
{
	while($result=$br->fetch_assoc()){
$getproductbybrand=$product->getproductbybrand($result['brandId']);
$result_pbb=$getproductbybrand->fetch_assoc();
if($max<=$result_pbb['COUNT(*)'])
{
	$max=$result_pbb['COUNT(*)'];
}
?>
<div class="main">
    	<div class="content_top">
    		<div class="heading">
    		<h3><?php echo $result['brandName'];?></h3>
    		</div>
    		<div class="clear"></div>
		</div>
		
	      <div class="section group">
		  <?php 
		$topBrand=$product->topBrand($result['brandId']);
		if($topBrand)
		{
			while($result_all=$topBrand->fetch_assoc())
			{
		
		?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?proid=<?php echo $result_all['productId'] ?>"><img src="admin/uploads/<?php echo $result_all['image'] ?>" alt="" /></a>
					 <h2><?php echo $result_all['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result_all['productName'],50 )?></p>
					 <?php
                     $get_promotion = $product->get_promotion($result_all['productId']);
	      	        if($get_promotion){
	      		       if ($result2 = $get_promotion->fetch_assoc())
                       {
                         echo'<p><strike><span class="price">';echo $fm->format_currency($result_all['price'])." "."VND"; echo'</span></strike></p>';    echo'<p><span class="price">';echo $fm->format_currency($result2['PromotionPrice'])." "."VND"; echo'</span></p>'; 
                        }
                        
                        }
                else
                        {
                            echo'<p><span class="price">';echo $fm->format_currency($result_all['price'])." "."VND"; echo'</span></p>'; 
                        }
                        ?>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_all['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				
			
	<?php }}?>
	</div>
	<?php }} 
	echo '<div class="page">';
         
	$product_button=ceil($max/4);//ceil làm tròn
	$i=1;
	echo '<p>Trang</p>';
	for($i=1;$i<=$product_button;$i++)
	{
		echo '<a href="topbrands.php?page='.$i.'">'.$i.'</a>';
	}
	 
echo  '</div>';
	?>	
<?php
include "inc/footer.php";

?>