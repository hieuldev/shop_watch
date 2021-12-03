<?php
include "inc/header.php";
include "inc/slider.php";
?>
<?php
if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo "<script> window.location = '404.php' </script>";
        
    }else {
        $id = $_GET['catid']; // Lấy catid trên host
    }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
             <?php $name_cat=$cat->get_name_by_cat($id);
              if($name_cat)
              {
                  while($result=$name_cat->fetch_assoc())
                  {
              
              ?>
    		<div class="heading">
    		<h3>Danh mục sản phẩm:<?php echo $result['catName']; ?> </h3>
    		</div>
            <?php }}?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
              <?php $productbycat=$cat->get_product_by_cat($id);
              if($productbycat)
              {
                  while($result=$productbycat->fetch_assoc())
                  {
              
              ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="admin/uploads/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'])?></p>
					 <?php
                     $get_promotion = $product->get_promotion($result['productId']);
	      	        if($get_promotion){
	      		       if ($result2 = $get_promotion->fetch_assoc())
                       {
                         echo'<p><strike><span class="price">';echo $fm->format_currency($result['price'])." "."VND"; echo'</span></strike></p>';    echo'<p><span class="price">';echo $fm->format_currency($result2['PromotionPrice'])." "."VND"; echo'</span></p>'; 
                        }                      
                        }
                      else
                        {
                            echo'<p><span class="price">';echo $fm->format_currency($result['price'])." "."VND"; echo'</span></p>'; 
                        }
                        ?>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				
	<?php }}
              else
              {
               echo "Không có danh mục sản phẩm";   
              }?>
	
    </div>
 </div>
 <div class="page">
          <?php
            $pbc=$cat->select_product_by_cat($id);
            $pbc_count;
            $pbc=$cat->select_product_by_cat($id);
            if($pbc)
            {
                while($result=$pbc->fetch_assoc())
                {
                    $pbc_count=$result['COUNT(*)'];
                }
            }
            if($pbc_count==0)
            {
                echo '';
            }
            else
            {
            $pbc_button=ceil($pbc_count/8);//ceil làm tròn
            $i=1;
            echo '<p>Trang</p>';
            for($i=1;$i<=$pbc_button;$i++)
            {
                echo '<a href="productbycat.php?page='.$i.'&catid='.$id.'">'.$i.'</a>';
            }}
            ?>  
        </div>
<?php
include "inc/footer.php";

?>