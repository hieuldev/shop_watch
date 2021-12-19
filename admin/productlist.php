<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php';  ?>
<?php include '../classes/cart.php';  ?>
<?php include '../classes/brand.php';  ?>
<?php include '../classes/product.php';  ?>
<?php require_once '../helpers/format.php'; ?>
<?php
$pd = new product();
$fm = new Format();
if (!isset($_GET['productid']) || $_GET['productid'] == NULL) {
	// echo "<script> window.location = 'catlist.php' </script>";

} else {
	$id = $_GET['productid']; // Lấy catid trên host
	$delProduct = $pd->del_product($id); // hàm check delete Name khi submit lên
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Tất cả sản phẩm</h2>
		<div class="block">
			<form>
				<label>Tìm sản phẩm</label>
				<input name="search" type="text" />
				<select id="select" name="brand">
                            <option>Chọn thương hiệu</option>
                            <?php 
                            $brand = new brand();
                            $brandlist = $brand->show_brand();
                            if($brandlist){
                               foreach($brandlist as $result){
                             ?>
                            <option value=" <?php echo $result['brandName'] ?> "> <?php echo $result['brandName'] ?> </option>
                            
                            <?php 
                            }
                             }
                             ?>
                        </select>
						<select id="select" name="cate">
                            <option>Chọn chuyên mục</option>
                            <?php 
                            $cat = new category();
                            $catlist = $cat->show_category();
                            if($catlist){
                            foreach($catlist as $result){
                             ?>
                            <option value=" <?php echo $result['catName'] ?> "> <?php echo $result['catName'] ?> </option>
                            
                            <?php 
                            }
                             }
                             ?>
                        </select>
				<input type="submit" />
			</form>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Code</th>
						<th>Tên sản phẩm</th>
						<th>Nhập hàng</th>
						<th>Số lượng nhập</th>
						<th>Đã bán</th>
						<th>Tồn</th>
						<th>Giá</th>
						<th>Image</th>
						<th>Danh mục</th>
						<th>Thương hiệu</th>

						<th>Loại</th>
						<th>Xử lý</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(isset($_GET['search'])&&isset($_GET['brand'])&&isset($_GET['cate']))
					{
						$search=$_GET['search'];
						$brand=$_GET['brand'];
						$cate=$_GET['cate'];
					}
					else
					{
$search="";
$brand="";
$cate="";
					}

					$pdlist = $pd->show_product($search,$brand,$cate);
					$i = 0;


					if ($pdlist) {
						foreach ($pdlist as $result) {
							$i++;


					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['product_code'] ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><a href="productmorequantity.php?productid=<?php echo $result['_id'] ?>">Nhập hàng</a></td>
								<td>
									<?php echo $result['productQuantity'] ?>

								</td>
								<td>
									<?php echo $result['product_soldout'] ?>

								</td>
								<td>
									<?php echo $result['product_remain'] ?>

								</td>
								<td><?php echo $result['price'] ?></td>
								<td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
								<td><?php echo $result['cat'] ?></td>
								<td><?php echo $result['brand'] ?></td>

								<td><?php
									if ($result['type'] == 0) {
										echo 'Không nổi bật';
									} else {
										echo 'Nổi bật';
									}

									?></td>

								<td><a href="productedit.php?productid=<?php echo $result['_id'] ?>">Sửa</a> || <a onclick="return confirm('Bạn chắc chắn muốn xóa ?')" href="?productid=<?php echo $result['_id'] ?>">Xóa</a></td>
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
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>