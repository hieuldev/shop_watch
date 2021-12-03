<?php
include "inc/header.php";
?>
<?php
$news=$news->news_type();

if($news)
{
	while($result=$news->fetch_assoc()){
?>
<?php
?>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<h3><?php if($result['newsType']==0){echo 'Tin thường' ;}
			else if($result['newsType']==1){echo 'Tin mới' ;}
			else{echo 'Tin hot' ;}
			?></h3>
    		</div>
    		<div class="clear"></div>
		</div>
		
	      <div class="news">
		  <?php 
		$showNews=$cs->show_news($result['newsType']);
		if($showNews)
		{
			while($result_all=$showNews->fetch_assoc())
			{
		
		?>
				
					 <h2><a style="color:black;" href="newsdetails.php?id=<?php echo $result_all['newsID']?>" ><?php echo $result_all['newsTitle'] ?></a></h2>
					
				
			
	<?php }}?>
	</div>
	<?php }} ?>		
<?php
include "inc/footer.php";

?>