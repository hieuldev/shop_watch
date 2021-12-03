<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/news.php';?>

<?php require_once '../helpers/format.php'; ?>
<?php
$news= new news();
if(!isset($_GET['newsID']) || $_GET['newsID'] == NULL){
	// echo "<script> window.location = 'catlist.php' </script>";
	
}else {
	$id = $_GET['newsID']; // Lấy catid trên host
	$delnews = $news -> del_news($id); // hàm check delete Name khi submit lên
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Tất cả sản phẩm</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tiêu đề</th>
					<th>Hình ảnh</th>
					<th>Nội dung</th>
					<th>Loại tin tức</th>
					
					<th>Xử lý</th>
				</tr>
			</thead>
			<tbody>
			<?php 
							$newsList = $news -> news_showlist();
							if($newsList){
								$i = 0;
								while($result = $newsList -> fetch_assoc()){
									$i++;
								
						?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['newsTitle'] ?></td>
					<td><img src="uploads/<?php echo $result['newsImg'] ?>" width="80"></td>
					
					<td>
						<?php echo $result['newsContent'] ?>

					</td>
					
					<td><?php 
						if($result['newsType']==0){
							echo 'Tin thường';
						}else if($result['newsType']==1){
							echo 'Tin mới';
						}
						else {
							echo 'Tin hot';
						}

					?></td>
							<td><a href="newsedit.php?newsID=<?php echo $result['newsID'] ?>">Sửa</a> || <a href="?newsID=<?php echo $result['newsID'] ?>">Xóa</a></td>		
					<?php }}?>
				</tr>
			
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
