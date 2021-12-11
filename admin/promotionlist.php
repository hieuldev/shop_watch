<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';  ?>
<?php

    $promotion = new product();     
    if(!isset($_GET['delid']) || $_GET['delid'] == NULL){
        // echo "<script> window.location = 'catlist.php' </script>";
        
    }else {
        $id = $_GET['delid']; // Lấy catid trên host
        $delpromotion = $promotion -> del_promotion($id); // hàm check delete Name khi submit lên
    }
 ?> 

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách khuyến mãi</h2>
                <div><a href="promotionadd.php">Thêm mới</a></div>
                <div class="block">  
                <?php 
                    if(isset($delpromotion)){
                        echo $delpromotion;
                    }
                 ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Ngày bắt đầu</th>
							<th>Mã sản phẩm</th>
                            <th>Giá</th>
                            <th>Ngày kết thúc</th>
							<th>Xử lý</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$list_promotion = $promotion -> show_promotion();
							if($list_promotion){
								$i = 0;
								foreach($list_promotion as $result){
									$i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['PromotionDate']; ?></td>
							<td><?php echo $result['product']; ?></td>
                            <td><?php echo $result['PromotionPrice']; ?></td>
                            <td><?php echo $result['expiredTimeout']; ?></td>
							<td><a onclick = "return confirm('Bạn chắc chắn muốn xóa ?')" href="?delid=<?php echo $result['_id'] ?>">Xóa</a></td>
						</tr>
						<?php 
							}
						}
						 ?>
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

